<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Occassions extends Model
{
    protected $table = 'occassions';
    
    protected $fillable = ['name'];
}