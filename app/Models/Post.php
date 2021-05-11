<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
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

    public const POST_STATUS = [
        'draft',
        'moderation',
        'published',
        'rejected',
    ];

    public const STATUS_COLOR = [
        'text-gray-500',
        'text-blue-500',
        'text-green-400',
        'text-red-500'
    ];

    // данный запрос будет добавляться ко всем запросам объекта Post
    protected static function booted()
    {
        if (Auth::check()) { // проверка на то, зарегистрирован ли пользователь
            static::addGlobalScope(function (Builder $builder) {
                $user_id = Auth::user()->id;
                $builder
                    ->select(
                        DB::raw('posts.*, COUNT(pl.*) as likes, COUNT(fv.*) as favorite, COUNT(vw.*) as views'),
                        DB::raw("fv.user_id = $user_id as in_favorite"), // в избранном
                        ) // понравилось
                    ->leftJoin(DB::raw('favorite fv'), 'posts.id', '=', 'fv.post_id')
                    ->leftJoin(DB::raw('views vw'), 'posts.id', '=', 'vw.post_id')
                    ->leftJoin(DB::raw('post_likes pl'), 'posts.id', '=', 'pl.post_id')
                    ->groupBy('posts.id', 'fv.user_id')
                    ->orderBy('posts.created_at');
            });
        } else
            static::addGlobalScope(fn($query) => $query
                    ->orderBy('created_at', 'desc')
                    ->leftJoin('views as vw', 'vw.post_id', '=', 'posts.id')
                    ->groupBy('posts.id')
                    ->select(['posts.*', DB::raw('COUNT(vw.*) as views')]));
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', array_search('published', self::POST_STATUS));
    }

    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', array_search('draft', self::POST_STATUS));
    }

    public function scopeModeration($query)
    {
        return $query->where('status', array_search('moderation', self::POST_STATUS));
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

    public function viewedBy()
    {
        return $this->belongsToMany(User::class, 'views');
    }
//
//    public function views() {
//        return $this->viewedBy()->count();
//    }

    public function getLikedAttribute() {
        return $this->likedBy()->where('user_id', Auth::user()->id)->count();
    }

//    public function likes()
//    {
//        return $this->likedBy()->count();
//    }
//
    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'post_likes');
    }

    public function getPreviewAttribute($value)
    {
        if (!$value)
            return self::DEFAULT_PREVIEW;
        return $value;
    }

    public function status(string ...$statuses): bool
    {
        $post_status = self::POST_STATUS[$this->status] ?? false;
        if (!$post_status) return false;

        foreach ($statuses as $status) {
            if ($post_status == mb_strtolower($status))
                return true;
        }
        return false;
    }

}
