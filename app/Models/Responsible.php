<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Responsible extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'responsible';
    protected $fillable = [
        'date_of_use',
        'action',
        'user_id',
        'equipments_code',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Define the inverse relationship to Equipments
    public function equipments()
    {
        return $this->hasMany(Equipments::class, 'equipments_code', 'equipments_code');
    }
}
