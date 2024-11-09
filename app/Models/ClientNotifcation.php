<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class ClientNotifcation extends Model
{
    use HasFactory, Notifiable , HasApiTokens;
    protected $table = 'client_notifications';
    public $timestamps = true;
    protected $guarded = [];

}
