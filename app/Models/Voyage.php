<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'status',
        'start',
        'end',
        'revenues',
        'expenses',
    ];

    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }
}
