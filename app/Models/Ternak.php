<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ternak extends Model
{
    protected $fillable=['user_id','gambar','nama','umur','bobot','tinggi','harga'];
    protected $casts = [
        'gambar' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
