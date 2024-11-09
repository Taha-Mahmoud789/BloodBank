<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use App\Traits\FilterTrait;
class Post extends Model
{
    use FilterTrait;
    use HasFactory, Notifiable , HasApiTokens;

    /**
     * @var mixed|string
     */

    protected $table = 'posts';
    public $timestamps = true;
    protected $guarded = [];
    public function category():BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function clients():BelongsToMany
    {
        return $this->belongsToMany(Client::class,'client_posts')->withPivot('is_favourite');
    }

}
