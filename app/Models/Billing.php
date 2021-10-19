<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clients;

class Billing extends Model
{
    use HasFactory;
    protected $table = 'billings';

    public function client()
    {
    	return $this->belongsTo(Clients::class);
    }
}
