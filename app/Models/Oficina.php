<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    use HasFactory;

    protected $table = 'oficinas'; // Ensure the table name matches the database

    protected $fillable = ['nombre_oficina']; // Add fields that can be filled

    // If your table has timestamps (created_at, updated_at), leave it as is.
    // If it doesn't have timestamps in the database, add:
    // public $timestamps = false;
}