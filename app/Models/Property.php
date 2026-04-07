<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = ['owner_id', 'description', 'bedrooms', 'bathrooms', 'sqft', 'image'];

    public function owner() //belong to User table
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function address()  //can only have one address
    {
        return $this->hasOne(PropertyAddress::class);
    }
}
