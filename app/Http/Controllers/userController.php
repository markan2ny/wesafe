<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:user');
    }



    public function index() {

        return view('user.main');
    }

    public function police() {
        return view('user.police');
    }
    public function ambulance() {
        return view('user.ambulance');
    }
    public function sos() {
        return view('user.sos');
    }
    public function firefighter() {
        return view('user.firefighter');
    }
}
