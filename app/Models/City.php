<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
class City extends Model
{
    use HasFactory, Notifiable , HasApiTokens;
    protected $table = 'cities';
    public $timestamps = true;
    protected $guarded = [ ];

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }

    public function client():HasMany
    {
        return $this->hasMany(Client::class);
    }
    public function donations():HasMany
    {
        return $this->hasMany(DonationRequest::class);
    }

}
