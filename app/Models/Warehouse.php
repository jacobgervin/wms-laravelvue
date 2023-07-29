<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouse'; // Explicitly set the correct table name

    protected $fillable = ['customer', 'type', 'measure', 'amount'];

    // ...
}
