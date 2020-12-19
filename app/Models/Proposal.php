<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'mulai', 'selesai', 'tanggal', 'tempat', 'PenanggungJawab', 'name', 'type'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
