<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

/**
 * Class Post
 *
 * @property integer    $id
 * @property string     $title
 * @property integer    $user_id
 * @property string     $body
 * @property string     $preview
 * @property string     $synopsis
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

    protected $fillable = ['title', 'user_id', 'content', 'rating', 'year_rate', 'synopsis'];

    protected static function booted()
    {
        static::addGlobalScope(fn ($query) => $query->orderBy('created_at', 'desc'));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function inFavorite(): bool
    {
        if (Auth::check() &&
            count(Auth::user()->favorite()->where('post_id', $this->id)->get()))
            return true;
        return false;
    }

    public function viewedBy() {
        return $this->belongsToMany(User::class, 'views');
    }

    public function views() {
        return $this->viewedBy()->count();
    }

    public function likes() {
        return $this->likedBy()->count();
    }

    public function likedBy() {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function liked(): bool
    {
        if (Auth::check() &&
            count(Auth::user()->liked()->where('post_id', $this->id)->get()))
            return true;
        return false;
    }

}
