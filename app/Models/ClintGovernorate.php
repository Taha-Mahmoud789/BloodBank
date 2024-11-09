<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class ClintGovernorate extends Model
{
    use HasFactory, Notifiable , HasApiTokens;
    protected $table = 'client_governorates';
    public $timestamps = true;
    protected $guarded = [];

}
