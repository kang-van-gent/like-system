<?php

namespace App\Jobs;

use Exception;
use App\Models\farm;
use App\Models\history;
use App\Models\caseTable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProcessFarmJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $historyId;
    protected $facebook;
    protected $amount;
    protected $apiUrl;
    protected $type;

    /**
     * Create a new job instance.
     */
    public function __construct($historyId, $facebook, $amount, $apiUrl, $type)
    {
        //
        $this->historyId = $historyId;
        $this->facebook = $facebook;
        $this->amount = $amount;
        $this->apiUrl = $apiUrl;
        $this->type = $type;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $afarm = DB::SELECT("SELECT id,uid,token,status,facebook_id.type FROM farm where status = 'alive' and type='$this->type' and facebook_id not like '%$this->facebook%' or facebook_id is Null");
        $success = 0;
        $failed = 0;
        $upHis = history::find($this->historyId);

        // 1 : 1 s 1400 : 1400s 
        for ($i = 0; $success < $this->amount; $i++) {

            try {
                $data = [
                    'method' => 'post',
                    'variables' => [
                        'input' => [
                            'is_tracking_encrypted' => false,
                            'page_id' => $this->facebook,
                            'source' => null,
                            'tracking' => null,
                            'actor_id' => $afarm[$i]->uid,
                            'client_mutation_id' => '1'
                        ],
                        'scale' => 1
                    ],
                    'doc_id' => '6716077648448761',
                    'access_token' => $afarm[$i]->token
                ];

                // Make the API POST request
                $response = Http::post($this->apiUrl, $data);

                if (isset($response['error'])) {
                    throw new Exception('token died.');
                }
                $upHis->success = $success + 1;
                $upHis->save();
                $upFarm = farm::find($afarm[$i]->id);
                $upFarm->facebook_id = $afarm[$i]->facebook_id . '-' . $this->facebook;
                $upFarm->save();
                $success++;
            } catch (\Exception $e) {
                //throw $th;
                $upHis->failed = $failed + 1;
                $failed++;
                $upHis->save();

                // Update farm cause it may be token is dead
                $farm = farm::find($afarm[$i]->id);
                $farm->status = 'dead';
                $farm->save();
                continue;
            }
        }


        $upHis->status = 'Done';
        $upHis->save();
    }
}
