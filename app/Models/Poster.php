<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poster extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'image',
        'deskripsi',
    ];

    public function scopeFilter(Builder $query, array $filters) {
        $query->when($filters['search'] ?? false, function($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
        });
    }
}
