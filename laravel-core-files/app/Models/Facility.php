<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $primaryKey = 'fac_id';

    protected $fillable = [
        'location', 'capacity', 'staff_id'
    ];

    public function manager()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }

    public function sports()
    {
        return $this->hasMany(Sport::class, 'fac_id', 'fac_id');
    }
}
