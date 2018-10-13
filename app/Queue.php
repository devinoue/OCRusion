<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $primaryKey = 'target_dir';
    public $incrementing = false;
    
}
