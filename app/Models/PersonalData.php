<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    use HasFactory;
    protected $table = 'personal_data';
    public $timestamps = true;

    /*protected $casts = [
        'cost' => 'float'
    ]; */

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'telephone',
        'created_at',
    ];
}
