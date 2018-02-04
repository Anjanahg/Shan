<?php

namespace App;




use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['fullname', 'email', 'password', 'mobileno', 'Lplace','address','areaId'];
}
