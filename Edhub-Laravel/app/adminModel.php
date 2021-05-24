<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminModel extends Model
{
    protected $table = 'customer';
    protected $filable=['firstname', 'lastname', 'tel', 'email', 'password', 'type' ,'jobs', 'status' , 'bio', 'website', 'img'];
    public $timestamps = false;

}
