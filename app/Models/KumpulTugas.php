<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KumpulTugas extends Model
{
    use HasFactory;
    protected $table = 'kumpul_tugas';
    protected $guarded = [];


    const STATUS = [
        'pending' => 0,
        'selesai' => 1,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
