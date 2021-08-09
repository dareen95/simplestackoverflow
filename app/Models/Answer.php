<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['user_id', 'question_id', 'content'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
