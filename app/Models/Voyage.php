<?php

namespace App\Models;

use App\Models\Vessel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        // Auto calculating profit
        static::saving(function(Model $model) {
            $model->profit = $model->revenues - $model->expenses;
        });
    }

    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }
}
