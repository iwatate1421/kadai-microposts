<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id'];

    /**
     * この投稿を所有するユーザー。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 多対多のリレーションを定義
    public function favoritedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'micropost_id', 'user_id')
                    ->withTimestamps(); 
    }
}
