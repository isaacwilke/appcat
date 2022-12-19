<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Corcel\Model\User as Corcel;

class UserWhiskey extends Corcel 
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $connection = 'whiskey';
    protected $table ="users";

}
