<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'age', 'description', 'price', 'status', 'pictures', 'type_id', 'race_id'
    ];

    /**
     * Relation avec le type de l'animal.
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Relation avec la race de l'animal.
     */
    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
