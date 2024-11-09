<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
class DonationRequest extends Model
{
    use HasFactory, Notifiable , HasApiTokens;
    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $guarded = [];
    public function client():BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function city():BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function bloodType():BelongsTo
    {
        return $this->belongsTo(BloodType::class);
    }


    public function notifications():hasMany
    {
        return $this->hasMany(notification::class);
    }

}
