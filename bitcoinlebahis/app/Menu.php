<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $table = 'menu';
    public $timestamps = false;
    protected $fillable = ['name', 'url', 'lavel', 'sort'];
}
