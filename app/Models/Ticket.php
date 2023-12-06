<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = ['receive','title', 'description', 'attachment', 'user_id', 'status','ticket_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
