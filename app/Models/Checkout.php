<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = ['user_id','item_id','nama','alamat','jarak','no_telp','bukti_byr','catatan','angkutan','total_harga'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ternak()
    {
        return $this->belongsTo(Ternak::class, 'item_id');
    }
}
