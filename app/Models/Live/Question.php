<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Question extends Model
{
    use SoftDeletes;
    use Searchable;

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

    /** 
     * Get the indexable data array for the model. 
     * 
     * @return array 
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        return array('id' => $array['id'], 'label' => $array['label']);
    }

    public static function makeSearch($search)
    {
        return empty($search) ? static::query()
            : static::where('id', 'like', '%' . $search . '%')
            ->orWhere('label', 'like', '%' . $search . '%')
            ->orWhere('level', 'like', '%' . $search . '%');
        // ->orWhere('category_id', 'like', '%' . $search . '%');
    }

    public function subcategories()
    {
        $data = [];
        foreach ($this->categories()->get() as $subcategory) {
            $data[] = $subcategory->name;
        };
        return implode(" , ", $data);
    }
}
