<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone', 'email', 'comment', 'leadDateCreate', 'leadDateUpdate', 'status'];

    public function scopeSearchPhone($query, $searchTerm)
    {
        $searchTerm = '%'.$searchTerm.'%';
        $query->where('phone', 'like', $searchTerm);
        return $query;
    }
}
