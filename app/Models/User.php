<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * @property integer    id
 * @property integer    role
 * @property string     name
 * @property string     nickname
 * @property string     email
 * @property array      avatar
 *
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'avatar' => 'array'
    ];

    public const USER_ROLES = [
        'user',
        'admin',
        'moderator'
    ];

    protected const USER_ROLES_COLOR = [
        'text-green-500',
        'text-red-500',
        'text-blue-500'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * get list of post in favorite
     *
     * @return BelongsToMany
     */
    public function favorite(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'favorite');
    }

    public function liked(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_likes');
    }

    public function interests()
    {

        return Category::join('category_post', 'categories.id', '=', 'category_post.category_id')
            ->join('posts', 'category_post.post_id', '=', 'posts.id')
            ->join('post_likes', 'category_post.post_id', '=', 'post_likes.post_id')
            ->groupBy('categories.id')
            ->orderBy('count', 'desc')
            ->get(['categories.*', DB::raw('count(categories.id) as count')]);
    }

    public function role(string ...$roles): bool
    {
        $user_role = self::USER_ROLES[$this->role] ?? false;
        if (!$user_role) return false;

        foreach ($roles as $role) {
            if ($user_role == mb_strtolower($role))
                return true;
        }
        return false;
    }

    public function getRole(): string
    {
        return self::USER_ROLES[$this->role] ?? 'undefined';
    }

    public function getRoleColor(): string
    {
        return self::USER_ROLES_COLOR[$this->role] ?? 'text-indigo-500';
    }

    public function getAvatar($size): string
    {
        if ($this->avatar[$size] ?? null != null)
            $path = Storage::url($this->avatar[$size]);
        else
            $path = '/user/avatar.png';
        return $path;
    }


}
