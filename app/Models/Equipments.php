<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Equipments extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'equipments';
    protected $primaryKey = 'equipments_code';
    protected $fillable = [
        'equipments_code',
        'status',
        'asset_number',
        'date_acquired',
        'item_description_name',
        'vendor',
        'acquisition_method',
        'price',
        'amount',
        'additional',
        'reference_number',
        'budget',
        'serial_number',
        'location_site_code',
        'type_of_equipment_id',
        'location_use_name'
    ];

    public function imagesequipments()
    {
        return $this->hasMany(Images_equipment::class, 'equipments_code', 'equipments_code');
    }
    public function responsible()
    {
        return $this->belongsTo(Responsible::class, 'equipments_code', 'equipments_code');
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_site_code', 'location_site_code');
    }

    public function typeOfEquipment()
    {
        return $this->belongsTo(Type_of_equipment::class, 'type_of_equipment_id', 'type_of_equipment_id');
    }
}
