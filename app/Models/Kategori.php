<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function beritas(): HasMany{
        return $this->hasMany(Berita::class);
    }

    public function scopeFilter(Builder $query, array $filters) {
        $query->when($filters['search'] ?? false, function($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');

        });
    }
}
