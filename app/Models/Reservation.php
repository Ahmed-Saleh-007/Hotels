<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'country',
        'room_id',
        'acc_no',
        'from',
        'to',
        'price'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}