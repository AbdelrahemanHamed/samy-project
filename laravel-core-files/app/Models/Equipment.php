<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $primaryKey = 'equip_id';

    protected $fillable = [
        'equip_name', 'condition_'
    ];

    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'uses', 'equip_id', 'sport_id');
    }
}
