<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\SaleItem;
use App\Sale;
use Input;
use DB;
use Carbon;

class ExcelReports extends Controller
{

    public function ExportReports(){
    	Excel::create('reports',function($excel){
    		$excel->sheet('reports',function($sheet){
    			$sheet->loadView('reports.sales.index3');
    		});
    	})->export('xlsx');    
    }


    public function salesIndex(Request $request){
        $sales = SaleItem::with('product')->get();
        $saleTotal = SaleItem::sum(DB::raw('price * quantity'));
        $date_query = 'All';
    	return view ('printables.sales.index')
            ->with('sales',$sales)
            ->with('saleTotal',$saleTotal)
            ->with('date_query',$date_query);
    }


    public function salesCustomizedFilter(Request $request){

        $date_range = $request->date_range;
        $date_query = $date_range;

        $sales = SaleItem::whereDate('created_at', $date_range)->get();

        $saleTotal = SaleItem::whereDate('created_at', $date_range)
                ->sum(DB::raw('price * quantity'));


    	return view ('printables.sales.index')
            ->with('sales',$sales)
            ->with('saleTotal',$saleTotal)
            ->with('date_query',$date_query);
    }


    public function salesDefaultFilter (Request $request){

        $date_range = $request->date_range;
        $sales = SaleItem::whereDate('created_at', $date_range)->get();
        $saleTotal = 0;
        
        $date_query = $date_range;

        if($date_range == 'Select Filter'){
            $sales = SaleItem::with('product')->get();
            $saleTotal = SaleItem::sum(DB::raw('price * quantity'));            
        }


        if($date_range == 'Today'){
                $sales = SaleItem::whereDay('created_at', '=', date('d'))->get();
                $saleTotal = SaleItem::whereDay('created_at', '=', date('d'))->sum(DB::raw('price * quantity'));
        }

        if ($date_range == 'This Week'){
             $sales =SaleItem::whereBetween('created_at', [
                    Carbon\Carbon::parse('last monday')->startOfDay(),
                    Carbon\Carbon::parse('next friday')->endOfDay(),
                ])->get();

            $saleTotal= SaleItem::select(DB::raw('YEAR(created_at) year'))
                ->whereBetween('created_at', [
                    Carbon\Carbon::parse('last monday')->startOfDay(),
                    Carbon\Carbon::parse('next friday')->endOfDay(),
                ])
                    ->sum(DB::raw('price * quantity'));           
        }


        if ($date_range == 'This Month'){
            $sales= SaleItem::whereMonth('created_at', '=', date('m'))
                ->get();
            $saleTotal= SaleItem::select(DB::raw('MONTH(created_at) month'))
                ->whereMonth('created_at', '=', date('m'))
                ->sum(DB::raw('price * quantity'));            
        }


        return view ('printables.sales.index')
            ->with('sales',$sales)->with('saleTotal',$saleTotal)
            ->with('date_query',$date_query);

    }


    // public function salesExcelPrintable (Request $request){
    //     $date_query = $request->date_query;

    //     dd($date_query);
    // }


    public function salesExcelPrintable(Request $request){

        $accept = $request->date_query;

        Excel::create('reports',function($excel) use ($accept){

            $date_range = $accept;

            $excel->sheet('reports',function($sheet) use ($date_range) {

                $sales = SaleItem::with('product')->get();
                $saleTotal = SaleItem::sum(DB::raw('price * quantity'));
                $date_query = $date_range;

                if($date_range == 'Select Filter'){
                    $sales = SaleItem::with('product')->get();
                    $saleTotal = SaleItem::sum(DB::raw('price * quantity'));            
                }


                if($date_range == 'Today'){
                        $sales = SaleItem::whereDay('created_at', '=', date('d'))->get();
                        $saleTotal = SaleItem::whereDay('created_at', '=', date('d'))->sum(DB::raw('price * quantity'));
                }

                if ($date_range == 'This Week'){
                     $sales =SaleItem::whereBetween('created_at', [
                            Carbon\Carbon::parse('last monday')->startOfDay(),
                            Carbon\Carbon::parse('next friday')->endOfDay(),
                        ])->get();

                    $saleTotal= SaleItem::select(DB::raw('YEAR(created_at) year'))
                        ->whereBetween('created_at', [
                            Carbon\Carbon::parse('last monday')->startOfDay(),
                            Carbon\Carbon::parse('next friday')->endOfDay(),
                        ])
                            ->sum(DB::raw('price * quantity'));           
                }


                if ($date_range == 'This Month'){
                    $sales= SaleItem::whereMonth('created_at', '=', date('m'))
                        ->get();
                    $saleTotal= SaleItem::select(DB::raw('MONTH(created_at) month'))
                        ->whereMonth('created_at', '=', date('m'))
                        ->sum(DB::raw('price * quantity'));            
                }


                else{
                    $sales = SaleItem::whereDate('created_at', $date_range)->get();

                    $saleTotal = SaleItem::whereDate('created_at', $date_range)
                    ->sum(DB::raw('price * quantity'));
                }

                $sheet->loadView('printables.sales.printable')
                    ->with('sales',$sales)
                    ->with('saleTotal',$saleTotal)
                    ->with('date_query',$date_query);
            });
        })->export('xlsx');    
    }



}
