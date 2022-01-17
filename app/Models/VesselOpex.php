<?php

namespace App\Models;

use App\Models\Vessel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VesselOpex extends Model
{
    use HasFactory;

    protected $table = 'vessel_opex';

    protected $fillable = [
        'expenses',
        'date',
    ];

    public $timestamps = false;

    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }
}
