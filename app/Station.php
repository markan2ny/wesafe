<?php

namespace App;

use App\Location;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public function getLocations() {

        return $this->hasMany(Location::class);
    }
}
