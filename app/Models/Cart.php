<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['item_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ternak()
    {
        return $this->belongsTo(Ternak::class, 'item_id');
    }
    use HasFactory;
}
