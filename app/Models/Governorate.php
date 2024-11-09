<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Governorate extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'governorates';
    public $timestamps = true;
    protected $guarded = [];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function clients()
    {
        return $this->hasManyThrough(client::class, City::class);
    }

    public function client_governorates(): BelongsToMany
    {
        return $this->belongsToMany(client::class, 'client_governorates', 'governorate_id', 'client_id');
    }

}
