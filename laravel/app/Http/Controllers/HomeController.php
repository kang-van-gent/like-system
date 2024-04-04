<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessFarmJob;
use App\Models\farm;
use App\Models\history;
use App\Models\services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\TryCatch;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!session('adminData')) {
            return redirect('/login');
        }

        $history = history::all();
        $services = services::all();
        return view('layouts.index', ['history' => $history, 'services' => $services]);
        // return view('layouts.index');
    }

    /**
     * Create new sapi services.
     */
    public function newServices(Request $request)
    {
        $service = new services();
        $service->name = $request->name;
        $service->apiUrl = $request->apiUrl;
        $service->save();

        return redirect('/')->with('success', 'Service has been added.');
    }

    /**
     * Insert new facebook farms.
     */
    public function newFarm(Request $request)
    {

        $text = $request->facebookFarm;
        echo "Input Text: " . $text . "<br>";

        $textArray = explode('|||', $text);

        if (end($textArray) === "") {
            array_pop($textArray);
        }

        for ($i = 0; $i < count($textArray); $i++) {
            $textArray[$i] = str_replace(array("\r\n", '""'), '', $textArray[$i]);
            $record = explode('|', $textArray[$i]);
            $uid = $record[0];
            $token = $record[1];
            $cookie = $record[2];

            $farm = new farm();
            $farm->uid = $uid;
            $farm->token = $token;
            $farm->cookie = $cookie;
            $farm->status = "alive";
            $farm->type = $request->type;
            $farm->save();
        }

        return redirect('/')->with('success', 'farm has been added.');
        // return redirect('/', ['record' => $record]);
    }

    /**
     * Show the form for creating a new resource. CREATE
     */
    public function services(Request $request)
    {
        // history 
        $afarm = DB::SELECT("SELECT id,uid,token,status,facebook_id FROM farm where status = 'alive' and facebook_id not like '%$request->facebook%' or facebook_id is Null");

        if (count($afarm) > 0) {

            if ($request->amount > count($afarm)) {
                return redirect('/')->with('msg', 'this facebook account is only ' + count($afarm) + ' availables ,Continue with ' + count($afarm) + ' ?');
            } else {


                $success = 0;
                $failed = 0;

                // Create history
                $history = new history();
                $history->facebookID = $request->facebook;
                $history->facebookUrl = $request->facebook;
                $history->amount = $request->amount;
                $history->status = 'on going..';
                $history->success = 0;
                $history->failed = 0;
                $history->save();

                ProcessFarmJob::dispatch($history->id, $request->facebook, $request->amount, $request->apiUrl);


                return redirect('/')->with('error', 'Success');
            }
        } else {
            return redirect('/')->with('error', 'Sorry this profile is already maximum value.');
        }
    }
}
