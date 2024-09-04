<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'agency';

    // The primary key associated with the table.
    protected $primaryKey = 'agency_id';

    // Indicates if the IDs are auto-incrementing.
    public $incrementing = true;

    // The "type" of the auto-incrementing ID.
    protected $keyType = 'int';

    // The attributes that are mass assignable.
    protected $fillable = [
        'name_agency',
        'user_id',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }
}
