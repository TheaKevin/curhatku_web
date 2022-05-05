<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'curhat_id',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function curhat()
    {
        return $this->belongsTo(curhat::class);
    }
}
