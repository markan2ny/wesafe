<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $fillable = ['barangay', 'complete_address', 'mobile'];
}
