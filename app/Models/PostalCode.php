<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    use HasFactory;
    protected $table = "PostalCode";
    protected $guarded = [];

    public function postalCodeLink(){
        return $this->belongsTO(PostalCode::class ,'postalCode', 'postalCode');
    }
    
}
