<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'completed',
        'user_id',
    ];
}
