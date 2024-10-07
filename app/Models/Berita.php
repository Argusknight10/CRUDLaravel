<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'kategori_id',
        'deskripsi'
    ];

    protected $with = ['kategori'];

    public function kategori(): BelongsTo {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function scopeFilter(Builder $query, array $filters){
        $query->when(isset($filters['search']) ? $filters['search'] : false, function($query, $search){
            $query->where('title', 'like', '%'.$search.'%');
        });

        $query->when(isset($filters['kategori']) ? $filters['kategori'] : false, function($query, $kategori){
            $query->whereHas('kategori', function($query) use ($kategori){
                $query->where('slug', $kategori);
            });
        });
    }
}
