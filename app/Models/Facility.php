<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    protected $table = 'facilities';
    protected $fillable = [
        'facility_name',
        'facility_address',
        'facility_description',
        'created_at',
        'updated_at'
    ];
    public function rooms()
    {
        return $this->hasMany(Room::class, 'facility_id');
    }
}
