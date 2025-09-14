<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Sc1 extends Model
{
    use HasFactory;

    protected $table = 'sc1';   // tabel sc1
    protected $primaryKey = 'No';
    public $timestamps = false;
    protected $guarded = [];

    // Ambil semua kolom dari tabel
    public static function getAllColumns()
    {
        return Schema::getColumnListing((new self)->getTable());
    }
}
