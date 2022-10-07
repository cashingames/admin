<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $connection = 'mysqllive';

    protected $fillable = ['created_by', 'is_published'];

    protected $casts = [
        'is_published' => 'boolean'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_questions')->withTimestamps();
    }

    public function options()
    {
        return $this->hasMany(Option::class)->inRandomOrder();
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::where('id', 'like', '%' . $search . '%')
            ->orWhere('label', 'like', '%' . $search . '%')
            ->orWhere('level', 'like', '%' . $search . '%')
            ->orWhere('category_id', 'like', '%' . $search . '%');
    }
}
