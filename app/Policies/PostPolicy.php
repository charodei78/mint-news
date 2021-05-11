<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function view(User $user, Post $post): bool
    {
        return $post->status('published') || $this->update($user, $post);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function update(User $user, Post $post): bool
    {
        return $post->user == $user || $user->role('admin', 'moderator');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function delete(User $user, Post $post): bool
    {
        return $post->user == $user;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function restore(User $user, Post $post): bool
    {
        return $post->user == $user;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function forceDelete(User $user, Post $post)
    {
        return $post->user == $user || $user->role('admin', 'moderator');
    }

    public function moderate(User $user, Post $post)
    {
        return $user->role('admin', 'moderator');
    }
}
