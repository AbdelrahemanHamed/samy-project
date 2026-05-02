<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $primaryKey = 'sport_id';

    protected $fillable = [
        'sport_name', 'fac_id', 'coach_id'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'fac_id', 'fac_id');
    }

    public function coach()
    {
        return $this->belongsTo(Coach::class, 'coach_id', 'coach_id');
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'enrolls', 'sport_id', 'member_id')
                    ->withPivot('enroll_date');
    }

    public function equipment()
    {
        return $this->belongsToMany(Equipment::class, 'uses', 'sport_id', 'equip_id');
    }
}
