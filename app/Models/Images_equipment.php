<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images_equipment extends Model
{
    use HasFactory;


    protected $table = 'images_equipment';

    protected $primaryKey = 'image_number';

    public $incrementing = true;


    protected $keyType = 'int';

    protected $fillable = [
        'image_path',
        'description',
        'equipments_code',
    ];

    // Define the relationship with the Equipment model
    public function equipment()
    {
        return $this->belongsTo(Equipments::class, 'equipments_code', 'equipments_code');
    }
}
