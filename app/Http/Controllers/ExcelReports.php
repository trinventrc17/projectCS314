<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\SaleItem;
use App\Sale;
class ExcelReports extends Controller
{

    public function ExportReports(){
    	Excel::create('reports',function($excel){
    		$excel->sheet('reports',function($sheet){
    			$sheet->loadView('reports.sales.index3');
    		});
    	})->export('xlsx');    
    }


    public function salesIndex(){
    	$sales = Sale::all();

    	return view ('printables.sales.index')->with('sales',$sales);
    }



}
