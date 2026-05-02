<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $primaryKey = 'coach_id';

    protected $fillable = [
        'name', 'gender', 'dob', 'salary'
    ];

    public function sports()
    {
        return $this->hasMany(Sport::class, 'coach_id', 'coach_id');
    }
}
