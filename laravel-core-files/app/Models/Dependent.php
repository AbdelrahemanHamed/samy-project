<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = ['member_id', 'dep_name'];

    protected $fillable = [
        'member_id', 'dep_name', 'relationship', 'dob'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }
}
