<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExhibitionBoost extends Model
{
    use HasFactory;

    protected $connection = 'mysqllive';
    protected $table = 'exhibition_boosts';


    public function gameSession(){
        return $this->belongsTo(GameSession::class);
    }

    public function boost(){
        return $this->belongsTo(Boost::class);
    }

    public function usedBoosts()
    {
        $data = [];
        foreach ($this->boost()->get() as $boost) {
            $data[] = $boost->name;
        };
        return implode(" , ", $data);
    }
}
