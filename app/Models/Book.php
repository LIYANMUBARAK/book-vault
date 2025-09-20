<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;


class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category_id',
        'published_year',
        'stock_count',
    ];

    // A book belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}