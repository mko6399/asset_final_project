<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;


    protected $table = 'location';

    protected $primaryKey = 'location_site_code';


    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'location_site_name',

    ];
    public function equipments()
    {
        return $this->hasMany(Equipments::class);
    }
}
