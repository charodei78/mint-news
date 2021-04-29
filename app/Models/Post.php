<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class Post
 *
 * @property integer    id
 * @property string     title
 * @property integer    user_id
 * @property string     body
 * @property string     preview
 * @property string     synopsis
 * @property integer    rating
 * @property integer    year_rate
 * @property integer    views
 * @property int        status // 0 - draft, 1 - on moderation, 2 - publicised
 *
 * @package App\Models
 */
class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'categories'
    ];

    public const DEFAULT_PREVIEW = '/ico/photo-bg.svg';

    protected $fillable = ['title', 'user_id', 'content', 'rating', 'year_rate', 'synopsis'];

    // данный запрос будет добавляться ко всем запросам объекта Post
    protected static function booted()
    {
        if (Auth::check()) { // проверка на то, зарегистрирован ли пользователь
            $user_id = Auth::user()->id;
            static::addGlobalScope(fn($query) => $query->orderBy('posts.created_at', 'desc')
                ->leftJoin('post_likes as pl', function ($query) use ($user_id) { // присоединение таблицы post_likes
                    return $query->on('pl.user_id', '=', DB::raw($user_id))->on('pl.post_id', '=', 'posts.id');
                })
                ->leftJoin('favorite as fv', function ($query) use ($user_id) { // присоединение таблицы favorite
                    return $query->on('fv.user_id', '=', DB::raw($user_id))->on('fv.post_id', '=', 'posts.id');
                })
                ->leftJoin('views as vw', 'vw.post_id', '=', 'posts.id') // присоединение таблицы views
                ->groupBy('posts.id', 'pl.post_id', 'fv.post_id') // группировка по id поста
                ->select([
                    'posts.*',
                    DB::raw('COUNT(pl.post_id) as liked'), // поле-состояние "понравилось"
                    DB::raw('COUNT(fv.post_id) as in_favorite'), // поле-состояние "в избранном"
                    DB::raw('COUNT(vw.*) as views') // поле "количество просмотров"
                ])
            );
        } else
            static::addGlobalScope(fn($query) => $query->orderBy('created_at', 'desc')
                ->leftJoin('views as vw', 'vw.post_id', '=', 'posts.id')
                ->groupBy('posts.id')
                ->select(['posts.*', DB::raw('COUNT(vw.*) as views')]));
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

//    public function inFavorite(): bool
//    {
//        if (Auth::check() &&
//            count(Auth::user()->favorite()->where('post_id', $this->id)->get()))
//            return true;
//        return false;
//    }
// TODO: добавить защиту от изменения незарегиститрованными ползователями
    public function viewedBy()
    {
        return $this->belongsToMany(User::class, 'views');
    }
//
//    public function views() {
//        return $this->viewedBy()->count();
//    }

    public function likes()
    {
        return $this->likedBy()->count();
    }

    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function getPreviewAttribute($value)
    {
        if (!$value)
            return self::DEFAULT_PREVIEW;
        return $value;
    }

//    public function liked(): bool
//    {
//        if (Auth::check() &&
//            count(Auth::user()->liked()->where('post_id', $this->id)->get()))
//            return true;
//        return false;
//    }

}
