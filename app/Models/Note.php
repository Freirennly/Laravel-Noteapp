<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    // Izinkan mass-assignment
    protected $fillable = [
        'title',
        'content',
        'category_id',
        'is_pinned',
        'created_date',
    ];

    // Kalau tidak pakai created_at & updated_at bawaan Laravel
    public $timestamps = false;

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
