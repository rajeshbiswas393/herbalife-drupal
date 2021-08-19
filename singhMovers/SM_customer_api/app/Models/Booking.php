<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Booking extends Authenticatable
{
    use HasFactory, Notifiable;
    
    /**
     * The table associated with the model .
     *
     * @var String
     */
    protected $table = 'booking';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
 
        'page_url',
        'name' ,
        'email' ,
        'phone' ,
        'user_id',
        'pickup' ,
        'delivery' ,
        'requesttype' ,
        'date' ,
        'time' ,
        'relocationtype' ,
        'size' ,
        'bedroom' ,
        'specialitem' ,
        'items' ,
        'detail' ,
        'querydate',
        'ip' ,
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
 /*   protected $casts = [
        'email_verified_at' => 'datetime',
    ];
  */  
}
