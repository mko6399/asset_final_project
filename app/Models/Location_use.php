<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location_use extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'location_use';

    // The primary key associated with the table.
    protected $primaryKey = 'location_use_code';

    // Indicates if the IDs are auto-incrementing.
    public $incrementing = true;

    // The "type" of the auto-incrementing ID.
    protected $keyType = 'int';

    // The attributes that are mass assignable.
    protected $fillable = [
        'location_use_code',
        'location_use_name',

    ];

    // Define the relationship with the Location model
    public function equipments()
    {
        return $this->belongsTo(Equipments::class, 'location_use_code', 'location_use_code');
    }
}
