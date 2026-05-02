<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $primaryKey = 'member_id';

    protected $fillable = [
        'name', 'gender', 'dob', 'city', 'street', 'zip_code'
    ];

    public function phones()
    {
        return $this->hasMany(MemberPhone::class, 'member_id', 'member_id');
    }

    public function dependents()
    {
        return $this->hasMany(Dependent::class, 'member_id', 'member_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'member_id', 'member_id');
    }

    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'enrolls', 'member_id', 'sport_id')
                    ->withPivot('enroll_date');
    }
}
