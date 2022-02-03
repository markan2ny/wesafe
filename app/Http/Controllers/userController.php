<?php

namespace App\Http\Controllers;

use App\Station;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $stations = Station::with('getLocations')->get()->where('station_name', 'police');
        return view('user.police',compact('stations'));
    }
    public function ambulance() {
        $stations = Station::with('getLocations')->get()->where('station_name', 'ambulance');
        return view('user.ambulance',compact('stations'));
    }
    public function sos() {
        $stations = Station::with('getLocations')->get()->where('station_name', 'emergency');
        return view('user.sos',compact('stations'));
    }
    public function firefighter() {

        $stations = Station::with('getLocations')->get()->where('station_name', 'fire');
        return view('user.firefighter', compact('stations'));
    }
    public function fetch($id) {

        $barangay = \App\Location::with('getBarangays')->get()->find($id);

        return response()->json($barangay);
    }

}
