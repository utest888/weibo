<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'content'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    protected function serializeDate(\DateTimeInterface $data)
    {
        return $data->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }
}
