<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicines extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rxcui',
        'name',
        'drug_name',
        'base_names',
        'dose_form_group_names',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_medications');
    }
}
