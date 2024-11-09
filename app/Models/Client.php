<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;



use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Client extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $table = 'clients';
    public $timestamps = true;
    protected $guarded = [];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bloodTypes():belongsToMany
    {
        return $this->belongsToMany(BloodType::class, 'blood_type_clients','client_id','blood_type_id');
    }
    public function bloodType(): BelongsTo
    {
        return $this->belongsTo(BloodType::class);
    }
    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function posts():BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'client_posts','client_id','post_id')->withPivot('is_favourite');
    }

    public function governorates():BelongsToMany
    {
        return $this->belongsToMany(Governorate::class, 'client_governorates','client_id','governorate_id');
    }

    public function notification():BelongsToMany
    {
        return $this->belongsToMany(Notification::class);
    }

    public function contacts():hasMany
    {
        return $this->hasMany(contact::class);
    }

    /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
}
