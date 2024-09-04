<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_of_equipment extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'type_of_equipment';

    // The primary key associated with the table.
    protected $primaryKey = 'type_of_equipment_id';

    // Indicates if the IDs are auto-incrementing.
    public $incrementing = true;

    // The "type" of the auto-incrementing ID.
    protected $keyType = 'int';

    // The attributes that are mass assignable.
    protected $fillable = [
        'name_type_of_equipment',

    ];

    // Define the relationship with the Equipment model
    public function equipment()
    {
        return $this->belongsTo(Equipments::class, 'type_of_equipment_id', 'type_of_equipment_id');
    }
}
