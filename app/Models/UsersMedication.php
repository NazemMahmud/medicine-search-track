<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersMedication extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'users_medications';

    protected $fillable = [
        'user_id',
        'medication_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medication()
    {
        return $this->belongsTo(Medicines::class);
    }
}
