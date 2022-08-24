<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['community_id', 'user_id', 'title', 'post_text', 'post_url', 'post_image', 'votes'];

    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }

    public function postVotes(): HasMany
    {
        return $this->hasMany(PostVote::class);
    }

    public function votesThisWeek(): HasMany
    {
        return $this->hasMany(PostVote::class)
            ->where('post_votes.created_at', '>=', now()->subDays(7));
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    /**
     * Delete Post Image from Storage.
     *
     * @return void
     */
    public function deleteImage(): void
    {
        Storage::delete($this->post_image);
    }
}
