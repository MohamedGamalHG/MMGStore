<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFilter extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function filter(){
        return $this->belongsTo(Filter::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
