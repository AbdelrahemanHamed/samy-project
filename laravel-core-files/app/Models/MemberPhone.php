<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberPhone extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = ['member_id', 'phone'];

    protected $fillable = [
        'member_id', 'phone'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }
}
