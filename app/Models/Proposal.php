<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = ['status','judul', 'mulai', 'selesai', 'tanggal', 'tempat', 'PenanggungJawab', 'name', 'type','slug'];

    public function report(){
        return $this->hasOne(Report::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
