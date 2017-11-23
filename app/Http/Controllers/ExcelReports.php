<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
class ExcelReports extends Controller
{

    public function ExportReports(){
    	Excel::create('reports',function($excel){
    		$excel->sheet('reports',function($sheet){
    			$sheet->loadView('reports.sales.index3');
    		});
    	})->export('xlsx');    
    }
}
