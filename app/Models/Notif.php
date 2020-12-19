<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'judul', 'info','tipe','deskripsi', 'pengirim'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
