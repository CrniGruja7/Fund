<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Return_;

class FundSubCategory extends Model
{
    use HasFactory;

    public function fundCategory(){
        return $this->belongsTo('App\Models\FundCategory');
    }
    public function fund() {
        return $this->hasMany('App\Models\Fund');
    }
}
