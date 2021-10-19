<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Billing;

class Clients extends Model
{
    use HasFactory;
    protected $table = 'clients';

    public function billings()
   {
   	 	return $this->hasMany(Billing::class);
   }
}
