<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

/**
 * Class Post
 *
 * @property integer    $id
 * @property string     $title
 * @property integer    $user_id
 * @property string     $body
 * @property integer    $rating
 * @property integer    $year_rate
 * @property integer    $views
 *
 * @package App\Models
 */
class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    protected $fillable = ['title', 'user_id', 'content', 'rating', 'year_rate'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function inFavorite() {
        if (Auth::check() &&
            count(Auth::user()->favorite()->where('post_id', $this->id)->get()))
            return true;
        return false;
    }

}
