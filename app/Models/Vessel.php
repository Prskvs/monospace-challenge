<?php

namespace App\Models;

use App\Models\Voyage;
use App\Models\VesselOpex;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vessel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'imo_number',
    ];

    public $timestamps = false;

    public function voyages()
    {
        return $this->hasMany(Voyage::class);
    }

    public function opex()
    {
        return $this->hasMany(VesselOpex::class);
    }
}
