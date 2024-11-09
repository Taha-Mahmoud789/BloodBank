<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class BloodTypeClint extends Model 
{
    use HasFactory, Notifiable , HasApiTokens;
    protected $table = 'blood_type_clients';
    public $timestamps = true;
    protected $guarded = [];

}