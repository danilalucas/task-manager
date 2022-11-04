<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'tumb',
        'deadline',
        'group_id',
        'priority_id',
        'responsible_id',
        'filed',
    ];
}
