<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use HasFactory, Notifiable , HasApiTokens;
    protected $table = 'contacts';
    public $timestamps = true;
    protected $guarded = [];
    public function client():belongsTo
    {
        return $this->belongsTo(client::class);
    }
}
