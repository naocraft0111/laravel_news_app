<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsEntry extends Model
{
    use HasFactory;

    protected $table = 'news_entry';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
