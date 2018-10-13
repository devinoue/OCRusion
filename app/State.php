<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'target_dir';
}
