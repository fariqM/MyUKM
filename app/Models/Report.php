<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['proposal_id', 'spj_name', 'spj_type', 'spj_slug' ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function proposal(){
        return $this->belongsTo(Proposal::class);
    }
}
