<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundCategory extends Model
{
    use HasFactory;

    public function fund() {
        return $this->hasMany('App\Models\Fund');
    }

    public function fundSubCategory() {
        return $this->hasMany('App\Modles\FundSubCategory');
    }
}
