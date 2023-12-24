<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\FundCategory;
use App\Models\UserFund;
use Dompdf\Dompdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use SimpleXMLElement;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){

        $query = Fund::query();
        $queryCat = FundCategory::query();

        if(request()->has('cat')){
            $category_id = request()->input('cat');
            $query->where('fund_category_id', $category_id);
            $funds = $query->paginate(10);
            $fundCategory = $queryCat->where('id', $category_id);
            $fundCategory = FundCategory::all();
        }
        elseif(request()->has('search')){
            $search = request()->input('search');
            $query->where('name','like',"$search")->orWhere('ISIN','like',"%$search%")->orWhere('WKN','like',"%$search%");
            $funds=$query->paginate(10);
            $fundCategory = FundCategory::all();
        }
        else{
            $funds = Fund::all();
            $funds = Fund::paginate(10);
            $fundCategory = FundCategory::all();
        }

        //dd($fundCategory);
        return view('home', compact('funds','fundCategory'));
    }

    public function favorites() {
        $user = Auth::user();

        $favorites = UserFund::where('user_id', $user->id)->get();

        return view('favorites',compact('favorites'));
    }

    public function favoritesAdd($id) {

        $fund = Fund::find($id);
        $user = Auth::user();

        // Provera da li je fond već dodat u omiljene
        $existingFavorite = UserFund::where(['user_id' => $user->id, 'fund_id' => $fund->id])->first();

         if (!$existingFavorite) {
            $favorite = UserFund::create(['fund_id' => $fund->id, 'user_id' => $user->id]);
            
            // Dodajte logiku ili povratnu poruku prema potrebi
            return redirect()->back()->with('success', 'Fond je dodat u omiljene.');

        }else{

            // Dodajte logiku ili povratnu poruku ako je fond već u omiljenima
            return redirect()->back()->with('info', 'Fond je već u omiljenima.');
        }
    }

    public function remove($id) {
        $fund = Fund::find($id);
        $user = Auth::user();
        
        $userFund = $user->userFund->where('fund_id', $fund->id)->first();
        $userFund->delete();

        return redirect()->back()->with('success', 'Fond je uklonjen iz omiljenih.');
    }

    public function generatePdf($id) {
        // Logika za proveru autentikacije korisnika

        // Preuzimanje podataka fonda
        $fund = Fund::find($id);

        // Logika za generisanje PDF-a
        $pdf = new Dompdf();
        $pdf->loadHtml(view('pdf_template', compact('fund')));
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream('fund_data.pdf');
    }

    public function generateXml($id) {
        // Preuzimanje podataka fonda
        $fund = Fund::find($id);

        // Logika za generisanje XML-a
        $xmlData = new SimpleXMLElement('<fund></fund>');
        $xmlData->addChild('id', $fund->id);
        $xmlData->addChild('name', $fund->name);
        $xmlData->addChild('fund_category_name', $fund->fundCategory->name);
        $xmlData->addChild('fund_sub_category_name', $fund->fundSubCategory->name);
        $xmlData->addChild('ISIN', $fund->ISIN);
        $xmlData->addChild('WKN', $fund->WKN);

        // Snimanje XML-a u fajl ili izlaz
        $xmlFile = storage_path('app/fund_data.xml');
        $xmlData->asXML($xmlFile);

        return response()->file($xmlFile);
    }

    public function generateXlsx($id) {
         // Preuzimanje podataka fonda
         $fund = Fund::find($id);

         // Logika za generisanje XLSX-a
         $spreadsheet = new Spreadsheet();
         $sheet = $spreadsheet->getActiveSheet();
         
         // Postavljanje podataka u tabelu (primer, možete prilagoditi)
         $sheet->setCellValue('A1', 'ID');
         $sheet->setCellValue('B1', 'Name');
         $sheet->setCellValue('C1', 'FundCategoryName');
         $sheet->setCellValue('D1', 'FundSubCategoryName');
         $sheet->setCellValue('E1', 'ISIN');
         $sheet->setCellValue('F1', 'WKN');
         $sheet->setCellValue('A2', $fund->id);
         $sheet->setCellValue('B2', $fund->name);
         $sheet->setCellValue('C2', $fund->fundCategory->name);
         $sheet->setCellValue('D2', $fund->fundSubCategory->name);
         $sheet->setCellValue('E2', $fund->ISIN);
         $sheet->setCellValue('F2', $fund->WKN);
 
         // Kreiranje XLSX fajla
         $xlsxFile = storage_path('app/fund_data.xlsx');
         $writer = new Xlsx($spreadsheet);
         $writer->save($xlsxFile);
 
         return response()->file($xlsxFile);
    }
}

