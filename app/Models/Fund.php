<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    public function fundCategory() {
        return $this->belongsTo('App\Models\FundCategory');
    }
    
    public function fundSubCategory() {
        return $this->belongsTo('App\Models\FundSubCategory');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function pdfAvailable()
    {
        // Pretpostavljamo da postoji polje 'pdf_available' u tabeli
        return $this->pdf_available;
    }

    public function xlsxAvailable()
    {
        // Pretpostavljamo da postoji polje 'xlsx_available' u tabeli
        return $this->xlsx_available;
    }

    public function xmlAvailable()
    {
        // Pretpostavljamo da postoji polje 'xml_available' u tabeli
        return $this->xml_available;
    }
}
