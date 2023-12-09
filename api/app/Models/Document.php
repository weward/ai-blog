<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $guarded = [];

    public function scopeUser($query, $id = null)
    {
        $query->where('user_id', $id ?? auth()->user()->id);
    }

    public function scopeFilter($query)
    {
        $query->user();
    }

}
