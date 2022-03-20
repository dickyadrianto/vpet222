<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicineName',
        'medicineAmount',
        'medicinePrice',
        'image',
    ];
    protected $table = 'medicines';
    public $timestamps = false;
}
