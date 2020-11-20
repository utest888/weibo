<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected function serializeDate(\DateTimeInterface $data)
    {
        return $data->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }
}
