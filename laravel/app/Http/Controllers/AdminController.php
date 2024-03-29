<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function check_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $admin = admin::where([
            'username' => $request->username,
            'password' => sha1($request->password)
        ])->count();

        if ($admin > 0) {
            $adminData = admin::where([
                'username' => $request->username,
                'password' => sha1($request->password)
            ])->get();

            session(['adminData' => $adminData]);
            if ($request->has('rememberme')) {
                Cookie::queue('adminuser', $request->username, 1440);
                Cookie::queue('adminpwd', $request->password, 1440);
            } else {
                Cookie::queue(Cookie::forget('adminuser'));
                Cookie::queue(Cookie::forget('adminpwd'));
            }
            return redirect('/');
        } else {
            return view('layouts.login')->with('msg', 'Invalid username/Password!!');
        }
    }

    function logout()
    {
        session()->forget(['adminData']);
        return redirect('/login');
    }
}
