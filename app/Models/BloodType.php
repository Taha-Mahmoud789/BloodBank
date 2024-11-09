<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
class BloodType extends Model
{
    use HasFactory, Notifiable , HasApiTokens;

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $guarded = [];

    public function clients():BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'blood_type_clients');
    }

}
