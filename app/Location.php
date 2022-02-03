<?php

namespace App;

use App\Barangay;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['location'];


    public function getBarangays() {
        return $this->hasMany(Barangay::class);
    }
    public function getStation() {
        
        return $this->belongsTo(Station::class, 'station_id', 'id');
    }
}
