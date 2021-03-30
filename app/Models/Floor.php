<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'name',
        'manager_id'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class);
    }
}
