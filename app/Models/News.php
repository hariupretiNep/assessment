<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLikeDislike;

class News extends Model
{
    use HasFactory;

    public function likes()
    {
        return $this->hasMany(UserLikeDislike::class);
    }
}
