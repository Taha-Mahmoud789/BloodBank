<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
class Notification extends Model
{
    use HasFactory, Notifiable , HasApiTokens;
    protected $table = 'notifications';
    public $timestamps = true;
    protected $guarded = [];

    public function donationRequest():BelongsTo
    {
        return $this->belongsTo(DonationRequest::class);
    }

    public function clients():BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'client_notifications')->withPivot('is_read');
    }

}
