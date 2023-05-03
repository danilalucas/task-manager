<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $casts = [
        'filed' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'description',
        'tumb',
        'deadline',
        'group_id',
        'priority_id',
        'user_id',
        'status_id',
        'filed',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
