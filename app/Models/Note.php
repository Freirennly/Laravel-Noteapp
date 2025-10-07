<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'created_date',
        'is_pinned',
        'category_id',
    ];

    // Relasi: 1 Note belongsTo 1 Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
