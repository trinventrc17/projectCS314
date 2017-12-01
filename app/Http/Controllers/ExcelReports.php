<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\SaleItem;
use App\Sale;
use Input;
use DB;
use Carbon;
use App\Expenses;
use App\Product;
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
        $sales = SaleItem::with(['product','sale'])->get();
        $saleTotal = SaleItem::sum(DB::raw('price * quantity'));
        $date_query = 'All';
        $date_query2 = 'All';

    	return view ('printables.sales.index')
            ->with('sales',$sales)
            ->with('saleTotal',$saleTotal)
            ->with('date_query',$date_query)
            ->with('date_query2',$date_query2);
    }


    public function salesCustomizedFilter(Request $request){

        $date_range = $request->date_range;
        $date_range2 = $request->date_range2;
        $date_query = $date_range;
        $date_query2 = $date_range2;

        $sales = SaleItem::whereBetween('created_at',array($date_range,$date_range2))->get();

        $saleTotal = SaleItem::whereBetween('created_at',array($date_range,$date_range2))
                ->sum(DB::raw('price * quantity'));


    	return view ('printables.sales.index')
            ->with('sales',$sales)
            ->with('saleTotal',$saleTotal)
            ->with('date_query',$date_query)
            ->with('date_query2',$date_query2);
    }


    public function salesDefaultFilter (Request $request){

        $date_range = $request->date_range;
        $date_range2 = $request->date_range2;
        $sales = SaleItem::whereDate('created_at', $date_range)->get();
        $saleTotal = 0;
        
        $date_query = $date_range;
        $date_query2 = $date_range2;

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
            ->with('date_query',$date_query)
            ->with('date_query2',$date_query2);

    }


    // public function salesExcelPrintable (Request $request){
    //     $date_query = $request->date_query;

    //     dd($date_query);
    // }


    public function salesExcelPrintable(Request $request){

        $accept = $request->date_query;
        $accept2 = $request->date_query2;
        Excel::create('reports',function($excel) use ($accept,$accept2){

            $date_range = $accept;
            $date_range2 = $accept2;

            $excel->sheet('reports',function($sheet) use ($date_range,$date_range2) {
                $sales = SaleItem::with('product')->get();
                $saleTotal = SaleItem::sum(DB::raw('price * quantity'));
                $date_query = $date_range;

                if($date_range == 'All'){
                    $sales = SaleItem::with('product')->get();
                    $saleTotal = SaleItem::sum(DB::raw('price * quantity'));                   
                }
                elseif($date_range == 'Select Filter'){
                    $sales = SaleItem::with('product')->get();
                    $saleTotal = SaleItem::sum(DB::raw('price * quantity'));
                }


                elseif($date_range == 'Today'){
                        $sales = SaleItem::whereDay('created_at', '=', date('d'))->get();
                        $saleTotal = SaleItem::whereDay('created_at', '=', date('d'))->sum(DB::raw('price * quantity'));
                }

                elseif ($date_range == 'This Week'){
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


                elseif ($date_range == 'This Month'){
                    $sales= SaleItem::whereMonth('created_at', '=', date('m'))
                        ->get();
                    $saleTotal= SaleItem::select(DB::raw('MONTH(created_at) month'))
                        ->whereMonth('created_at', '=', date('m'))
                        ->sum(DB::raw('price * quantity'));            
                }


                else{
                $sales = SaleItem::whereBetween('created_at',array($date_range,$date_range2))->get();

                $saleTotal = SaleItem::whereBetween('created_at',array($date_range,$date_range2))
                        ->sum(DB::raw('price * quantity'));
                }

                $sheet->loadView('printables.sales.printable')
                    ->with('sales',$sales)
                    ->with('saleTotal',$saleTotal)
                    ->with('date_query',$date_query);
            });
        })->export('xlsx');    
    }


    public function earningsAndExpensesIndex(Request $request){

        $earnings =DB::table('sale_items')
            ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
            ->groupBy(DB::raw('DATE(created_at)') )
            ->orderByRaw('day DESC')
            ->get();

        $expenses =DB::table('expenses')
            ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
            ->groupBy(DB::raw('DATE(created_at)') )
            ->orderByRaw('day DESC')
            ->get();

        $totalEarnings = SaleItem::sum(DB::raw('price * quantity'));
        $totalExpenses = Expenses::sum(DB::raw('amount'));

        $monthlyEarnings= SaleItem::select(DB::raw('MONTH(created_at) month'))
                ->whereMonth('created_at', '=', date('m'))
                ->sum(DB::raw('price * quantity'));

        $dailyEarnings = SaleItem::whereDate('created_at', DB::raw('CURDATE()'))
                ->sum(DB::raw('price * quantity'));

        $yearlyEarnings= SaleItem::select(DB::raw('YEAR(created_at) year'))
        ->whereYear('created_at', '=', date('Y'))
                ->sum(DB::raw('price * quantity'));

        $weeklyEarnings= SaleItem::select(DB::raw('YEAR(created_at) year'))
            ->whereBetween('created_at', [
                Carbon\Carbon::parse('last monday')->startOfDay(),
                Carbon\Carbon::parse('next friday')->endOfDay(),
            ])
                ->sum(DB::raw('price * quantity'));


        $dailyExpenses = Expenses::whereDate('created_at', DB::raw('CURDATE()'))
                ->sum(DB::raw('amount'));



        $monthlyExpenses= Expenses::select(DB::raw('MONTH(created_at) month'))
                ->whereMonth('created_at', '=', date('m'))
                ->sum(DB::raw('amount'));

        $yearlyExpenses= Expenses::select(DB::raw('YEAR(created_at) year'))
        ->whereYear('created_at', '=', date('Y'))
                ->sum(DB::raw('amount'));

        $weeklyExpenses= Expenses::select(DB::raw('YEAR(created_at) year'))
            ->whereBetween('created_at', [
                Carbon\Carbon::parse('last monday')->startOfDay(),
                Carbon\Carbon::parse('next friday')->endOfDay(),
            ])
                ->sum(DB::raw('amount'));




        $saleTotal = $totalEarnings - $totalExpenses;
        
        $totalAll = $totalEarnings - $totalExpenses;
        
        $date_query = 'All';
        $date_query2 = 'All';
        return view ('printables.earningsAndExpenses.index')
            ->with('dailyEarnings',$dailyEarnings-$dailyExpenses)
            ->with('weeklyEarnings',$weeklyEarnings-$weeklyExpenses)
            ->with('monthlyEarnings',$monthlyEarnings-$monthlyExpenses)
            ->with('yearlyEarnings',$yearlyEarnings-$yearlyExpenses)
            ->with('earnings',$earnings)
            ->with('expenses',$expenses)
            ->with('saleTotal',$saleTotal)
            ->with('totalEarnings',$totalAll)
            ->with('date_query',$date_query)
            ->with('date_query2',$date_query2);
    }


    public function earningsAndExpensesCustomizedFilter(Request $request){

        $date_range = $request->date_range;
        $date_range2 = $request->date_range2;
        $date_query = $date_range;
        $date_query2 = $date_range2;



        $sales = SaleItem::whereBetween('created_at',array($date_range,$date_range2))->get();

        $earnings =DB::table('sale_items')
            ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
            ->whereBetween('created_at',array($date_range,$date_range2))
            ->groupBy(DB::raw('DATE(created_at)') )
            ->orderByRaw('day DESC')
            ->get();

        $expenses =DB::table('expenses')
            ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
            ->whereBetween('created_at',array($date_range,$date_range2))
            ->groupBy(DB::raw('DATE(created_at)') )
            ->orderByRaw('day DESC')
            ->get();

        $totalEarnings = SaleItem::whereBetween('created_at',array($date_range,$date_range2))->sum(DB::raw('price * quantity'));
        $totalExpenses = Expenses::whereBetween('created_at',array($date_range,$date_range2))->sum(DB::raw('amount'));


        $monthlyEarnings= SaleItem::select(DB::raw('MONTH(created_at) month'))
                ->whereMonth('created_at', '=', date('m'))
                ->sum(DB::raw('price * quantity'));

        $dailyEarnings = SaleItem::whereDate('created_at', DB::raw('CURDATE()'))
                ->sum(DB::raw('price * quantity'));

        $yearlyEarnings= SaleItem::select(DB::raw('YEAR(created_at) year'))
        ->whereYear('created_at', '=', date('Y'))
                ->sum(DB::raw('price * quantity'));

        $weeklyEarnings= SaleItem::select(DB::raw('YEAR(created_at) year'))
            ->whereBetween('created_at', [
                Carbon\Carbon::parse('last monday')->startOfDay(),
                Carbon\Carbon::parse('next friday')->endOfDay(),
            ])
                ->sum(DB::raw('price * quantity'));


        $dailyExpenses = Expenses::whereDate('created_at', DB::raw('CURDATE()'))
                ->sum(DB::raw('amount'));



        $monthlyExpenses= Expenses::select(DB::raw('MONTH(created_at) month'))
                ->whereMonth('created_at', '=', date('m'))
                ->sum(DB::raw('amount'));

        $yearlyExpenses= Expenses::select(DB::raw('YEAR(created_at) year'))
        ->whereYear('created_at', '=', date('Y'))
                ->sum(DB::raw('amount'));

        $weeklyExpenses= Expenses::select(DB::raw('YEAR(created_at) year'))
            ->whereBetween('created_at', [
                Carbon\Carbon::parse('last monday')->startOfDay(),
                Carbon\Carbon::parse('next friday')->endOfDay(),
            ])
                ->sum(DB::raw('amount'));


        $totalAllEarnings = SaleItem::sum(DB::raw('price * quantity'));
        $totalAlExpenses = Expenses::sum(DB::raw('amount'));

        $saleTotal = $totalEarnings - $totalExpenses;
        $totalAll = $totalAllEarnings - $totalAlExpenses;
        
        return view ('printables.earningsAndExpenses.index')
            ->with('dailyEarnings',$dailyEarnings-$dailyExpenses)
            ->with('weeklyEarnings',$weeklyEarnings-$weeklyExpenses)
            ->with('monthlyEarnings',$monthlyEarnings-$monthlyExpenses)
            ->with('yearlyEarnings',$yearlyEarnings-$yearlyExpenses)
            ->with('earnings',$earnings)
            ->with('expenses',$expenses)
            ->with('saleTotal',$saleTotal)
            ->with('totalEarnings',$totalAll)
            ->with('date_query',$date_query)
            ->with('date_query2',$date_query2);
    }


    public function earningsAndExpensesDefaultFilter (Request $request){

        $date_range = $request->date_range;
        $date_range2 = $request->date_range2;
        $date_query = $date_range;
        $date_query2 = $date_range2;

        $earnings =DB::table('sale_items')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();

        $expenses =DB::table('expenses')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();
        
        $totalEarnings = SaleItem::whereDate('created_at', $date_range)->sum(DB::raw('price * quantity'));
        $totalExpenses = Expenses::whereDate('created_at', $date_range)->sum(DB::raw('amount'));

        $saleTotal = $totalEarnings - $totalExpenses;
        $totalEarnings = SaleItem::sum(DB::raw('price * quantity'));
        $totalExpenses = Expenses::sum(DB::raw('amount'));

        $monthlyEarnings= SaleItem::select(DB::raw('MONTH(created_at) month'))
                ->whereMonth('created_at', '=', date('m'))
                ->sum(DB::raw('price * quantity'));

        $dailyEarnings = SaleItem::whereDate('created_at', DB::raw('CURDATE()'))
                ->sum(DB::raw('price * quantity'));

        $yearlyEarnings= SaleItem::select(DB::raw('YEAR(created_at) year'))
        ->whereYear('created_at', '=', date('Y'))
                ->sum(DB::raw('price * quantity'));

        $weeklyEarnings= SaleItem::select(DB::raw('YEAR(created_at) year'))
            ->whereBetween('created_at', [
                Carbon\Carbon::parse('last monday')->startOfDay(),
                Carbon\Carbon::parse('next friday')->endOfDay(),
            ])
                ->sum(DB::raw('price * quantity'));


        $dailyExpenses = Expenses::whereDate('created_at', DB::raw('CURDATE()'))
                ->sum(DB::raw('amount'));



        $monthlyExpenses= Expenses::select(DB::raw('MONTH(created_at) month'))
                ->whereMonth('created_at', '=', date('m'))
                ->sum(DB::raw('amount'));

        $yearlyExpenses= Expenses::select(DB::raw('YEAR(created_at) year'))
        ->whereYear('created_at', '=', date('Y'))
                ->sum(DB::raw('amount'));

        $weeklyExpenses= Expenses::select(DB::raw('YEAR(created_at) year'))
            ->whereBetween('created_at', [
                Carbon\Carbon::parse('last monday')->startOfDay(),
                Carbon\Carbon::parse('next friday')->endOfDay(),
            ])
                ->sum(DB::raw('amount'));




        $totalAllEarnings = SaleItem::sum(DB::raw('price * quantity'));
        $totalAlExpenses = Expenses::sum(DB::raw('amount'));

        $saleTotal = $totalEarnings - $totalExpenses;
        $totalAll = $totalAllEarnings - $totalAlExpenses;
        
        if($date_range == 'Select Filter'){
            $earnings =DB::table('sale_items')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();

            $expenses =DB::table('expenses')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();

            $totalEarnings = SaleItem::sum(DB::raw('price * quantity'));
            $totalExpenses = Expenses::sum(DB::raw('amount'));

            $saleTotal = $totalEarnings - $totalExpenses;       
        }


        if($date_range == 'Today'){

            $earnings =DB::table('sale_items')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                ->whereDay('created_at', '=', date('d'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();

            $expenses =DB::table('expenses')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                ->whereDay('created_at', '=', date('d'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();

            $totalEarnings = SaleItem::whereDay('created_at', '=', date('d'))->sum(DB::raw('price * quantity'));
            $totalExpenses = Expenses::whereDay('created_at', '=', date('d'))->sum(DB::raw('amount'));
            $saleTotal = $totalEarnings - $totalExpenses;    

        }

        if ($date_range == 'This Week'){



            $earnings =DB::table('sale_items')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                ->whereBetween('created_at', [
                    Carbon\Carbon::parse('last monday')->startOfDay(),
                    Carbon\Carbon::parse('next friday')->endOfDay(),
                ])
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();

            $expenses =DB::table('expenses')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                ->whereBetween('created_at', [
                    Carbon\Carbon::parse('last monday')->startOfDay(),
                    Carbon\Carbon::parse('next friday')->endOfDay(),
                ])
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();

            $totalEarnings = SaleItem::whereBetween('created_at', [
                    Carbon\Carbon::parse('last monday')->startOfDay(),
                    Carbon\Carbon::parse('next friday')->endOfDay(),
                ])->sum(DB::raw('price * quantity'));
            $totalExpenses = Expenses::whereBetween('created_at', [
                    Carbon\Carbon::parse('last monday')->startOfDay(),
                    Carbon\Carbon::parse('next friday')->endOfDay(),
                ])->sum(DB::raw('amount'));

            $saleTotal = $totalEarnings - $totalExpenses;    
        
        }


        if ($date_range == 'This Month'){

            $earnings =DB::table('sale_items')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                ->whereMonth('created_at', '=', date('m'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();

            $expenses =DB::table('expenses')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                ->whereMonth('created_at', '=', date('m'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();

            $totalEarnings = SaleItem::whereMonth('created_at', '=', date('m'))->sum(DB::raw('price * quantity'));
            $totalExpenses = Expenses::whereMonth('created_at', '=', date('m'))->sum(DB::raw('amount'));

            $saleTotal = $totalEarnings - $totalExpenses;   
        
        }



        return view ('printables.earningsAndExpenses.index')
            ->with('dailyEarnings',$dailyEarnings-$dailyExpenses)
            ->with('weeklyEarnings',$weeklyEarnings-$weeklyExpenses)
            ->with('monthlyEarnings',$monthlyEarnings-$monthlyExpenses)
            ->with('yearlyEarnings',$yearlyEarnings-$yearlyExpenses)
            ->with('earnings',$earnings)
            ->with('expenses',$expenses)
            ->with('saleTotal',$saleTotal)
            ->with('totalEarnings',$totalAll)
            ->with('date_query',$date_query)
            ->with('date_query2',$date_query2);

    }



    public function earningsAndExpensesExcelPrintable(Request $request){

        $accept = $request->date_query;
        $accept2 = $request->date_query2;
        Excel::create('reports',function($excel) use ($accept,$accept2){

            $date_range = $accept;
            $date_range2 = $accept2;
            $excel->sheet('reports',function($sheet) use ($date_range,$date_range2) {

            $earnings =DB::table('sale_items')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();

            $expenses =DB::table('expenses')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();

            $totalEarnings = SaleItem::sum(DB::raw('price * quantity'));
            $totalExpenses = Expenses::sum(DB::raw('amount'));

            $saleTotal = $totalEarnings - $totalExpenses;
                
                $date_query = $date_range;
                if($date_range == 'All'){
                     $earnings =DB::table('sale_items')
                        ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                        ->groupBy(DB::raw('DATE(created_at)') )
                        ->orderByRaw('day DESC')
                        ->get();

                    $expenses =DB::table('expenses')
                        ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                        ->groupBy(DB::raw('DATE(created_at)') )
                        ->orderByRaw('day DESC')
                        ->get();

                    $totalEarnings = SaleItem::sum(DB::raw('price * quantity'));
                    $totalExpenses = Expenses::sum(DB::raw('amount'));

                    $saleTotal = $totalEarnings - $totalExpenses;                   
                }

                elseif($date_range == 'Select Filter'){
                    $earnings =DB::table('sale_items')
                        ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                        ->groupBy(DB::raw('DATE(created_at)') )
                        ->orderByRaw('day DESC')
                        ->get();

                    $expenses =DB::table('expenses')
                        ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                        ->groupBy(DB::raw('DATE(created_at)') )
                        ->orderByRaw('day DESC')
                        ->get();

                    $totalEarnings = SaleItem::sum(DB::raw('price * quantity'));
                    $totalExpenses = Expenses::sum(DB::raw('amount'));

                    $saleTotal = $totalEarnings - $totalExpenses;         
                }


                elseif($date_range == 'Today'){
                $earnings =DB::table('sale_items')
                    ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                    ->whereDay('created_at', '=', date('d'))
                    ->groupBy(DB::raw('DATE(created_at)') )
                    ->orderByRaw('day DESC')
                    ->get();

                $expenses =DB::table('expenses')
                    ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                    ->whereDay('created_at', '=', date('d'))
                    ->groupBy(DB::raw('DATE(created_at)') )
                    ->orderByRaw('day DESC')
                    ->get();

                $totalEarnings = SaleItem::whereDay('created_at', '=', date('d'))->sum(DB::raw('price * quantity'));
                $totalExpenses = Expenses::whereDay('created_at', '=', date('d'))->sum(DB::raw('amount'));
                $saleTotal = $totalEarnings - $totalExpenses;  
                }

                elseif ($date_range == 'This Week'){
                $earnings =DB::table('sale_items')
                    ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                    ->whereBetween('created_at', [
                        Carbon\Carbon::parse('last monday')->startOfDay(),
                        Carbon\Carbon::parse('next friday')->endOfDay(),
                    ])
                    ->groupBy(DB::raw('DATE(created_at)') )
                    ->orderByRaw('day DESC')
                    ->get();

                $expenses =DB::table('expenses')
                    ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                    ->whereBetween('created_at', [
                        Carbon\Carbon::parse('last monday')->startOfDay(),
                        Carbon\Carbon::parse('next friday')->endOfDay(),
                    ])
                    ->groupBy(DB::raw('DATE(created_at)') )
                    ->orderByRaw('day DESC')
                    ->get();

                $totalEarnings = SaleItem::whereBetween('created_at', [
                        Carbon\Carbon::parse('last monday')->startOfDay(),
                        Carbon\Carbon::parse('next friday')->endOfDay(),
                    ])->sum(DB::raw('price * quantity'));
                $totalExpenses = Expenses::whereBetween('created_at', [
                        Carbon\Carbon::parse('last monday')->startOfDay(),
                        Carbon\Carbon::parse('next friday')->endOfDay(),
                    ])->sum(DB::raw('amount'));

                $saleTotal = $totalEarnings - $totalExpenses;             
                }


                elseif ($date_range == 'This Month'){
                    $earnings =DB::table('sale_items')
                        ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                        ->whereMonth('created_at', '=', date('m'))
                        ->groupBy(DB::raw('DATE(created_at)') )
                        ->orderByRaw('day DESC')
                        ->get();

                    $expenses =DB::table('expenses')
                        ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                        ->whereMonth('created_at', '=', date('m'))
                        ->groupBy(DB::raw('DATE(created_at)') )
                        ->orderByRaw('day DESC')
                        ->get();

                    $totalEarnings = SaleItem::whereMonth('created_at', '=', date('m'))->sum(DB::raw('price * quantity'));
                    $totalExpenses = Expenses::whereMonth('created_at', '=', date('m'))->sum(DB::raw('amount'));

                    $saleTotal = $totalEarnings - $totalExpenses;             
                }


                else{
                    $earnings =DB::table('sale_items')
                        ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                        ->whereBetween('created_at',array($date_range,$date_range2))
                        ->groupBy(DB::raw('DATE(created_at)') )
                        ->orderByRaw('day DESC')
                        ->get();

                    $expenses =DB::table('expenses')
                        ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                        ->whereBetween('created_at',array($date_range,$date_range2))
                        ->groupBy(DB::raw('DATE(created_at)') )
                        ->orderByRaw('day DESC')
                        ->get();

                    $totalEarnings = SaleItem::whereBetween('created_at',array($date_range,$date_range2))->sum(DB::raw('price * quantity'));
                    $totalExpenses = Expenses::whereBetween('created_at',array($date_range,$date_range2))->sum(DB::raw('amount'));

                    $saleTotal = $totalEarnings - $totalExpenses;
                }

                $sheet->loadView('printables.earningsAndExpenses.printable')
                    ->with('earnings',$earnings)
                    ->with('expenses',$expenses)
                    ->with('saleTotal',$saleTotal)
                    ->with('date_query',$date_query);
            });
        })->export('xlsx');    
    }


public function productsIndex(Request $request){
        $sales = DB::table('products')
                ->where('category','!=','Room Sale')
                ->orderByRaw(' price - capitalPrice ASC') 
                ->get();

        $saleTotal = Product::where('category','!=','Room Sale')->sum(DB::raw('sold * (price - capitalPrice)'));
        
        $date_query = 'All';
        return view ('printables.products.index')
            ->with('sales',$sales)
            ->with('saleTotal',$saleTotal)
            ->with('date_query',$date_query);
    }


    public function productsCustomizedFilter(Request $request){

        $date_range = $request->date_range;
        $date_query = $date_range;

        $sales = DB::table('products')
                ->where('category','!=','Room Sale')
                ->orderByRaw(' price - capitalPrice ASC')
                ->whereDate('created_at', $date_range)
                ->get();

        $saleTotal = Product::where('category','!=','Room Sale')
                    ->whereDate('created_at', $date_range)
                    ->sum(DB::raw('sold * (price - capitalPrice)'));

        return view ('printables.products.index')
            ->with('sales',$sales)
            ->with('saleTotal',$saleTotal)
            ->with('date_query',$date_query);
    }


    public function productsDefaultFilter (Request $request){

        $date_range = $request->date_range;
        $sales =  DB::table('products')
                ->where('category','!=','Room Sale')
                ->orderByRaw(' price - capitalPrice ASC')
                ->whereDate('created_at', $date_range)
                ->get();
                
        $saleTotal = Product::where('category','!=','Room Sale')->sum(DB::raw('sold * (price - capitalPrice)'));
        
        $date_query = $date_range;

        if($date_range == 'Select Filter'){
            $sales =  DB::table('products')
                    ->where('category','!=','Room Sale')
                    ->orderByRaw(' price - capitalPrice ASC')
                    ->whereDate('created_at', $date_range)->get();
            $saleTotal = Product::where('category','!=','Room Sale')->sum(DB::raw('sold * (price - capitalPrice)'));        
        }


        if($date_range == 'Today'){
                $sales = DB::table('products')
                    ->where('category','!=','Room Sale')
                    ->orderByRaw(' price - capitalPrice ASC')
                    ->whereDay('created_at', '=', date('d'))
                   ->get();
                $saleTotal = DB::table('products')
                    ->where('category','!=','Room Sale')
                    ->orderByRaw(' price - capitalPrice ASC')
                    ->whereDay('created_at', '=', date('d'))->sum(DB::raw('sold * (price - capitalPrice)'));
        }

        if ($date_range == 'This Week'){
             $sales =DB::table('products')
                    ->where('category','!=','Room Sale')
                    ->orderByRaw(' price - capitalPrice ASC')
                    ->whereBetween('created_at', [
                    Carbon\Carbon::parse('last monday')->startOfDay(),
                    Carbon\Carbon::parse('next friday')->endOfDay(),
                ])->get();

            $saleTotal= DB::table('products')
                    ->where('category','!=','Room Sale')
                    ->orderByRaw(' price - capitalPrice ASC')
                    ->select(DB::raw('YEAR(created_at) year'))
                ->whereBetween('created_at', [
                    Carbon\Carbon::parse('last monday')->startOfDay(),
                    Carbon\Carbon::parse('next friday')->endOfDay(),
                ])
                    ->sum(DB::raw('sold * (price - capitalPrice)'));           
        }


        if ($date_range == 'This Month'){
            $sales= DB::table('products')
                    ->where('category','!=','Room Sale')
                    ->orderByRaw(' price - capitalPrice ASC')
                    ->whereMonth('created_at', '=', date('m'))
                ->get();
            $saleTotal= DB::table('products')
                    ->where('category','!=','Room Sale')
                    ->orderByRaw(' price - capitalPrice ASC')
                    ->select(DB::raw('MONTH(created_at) month'))
                ->whereMonth('created_at', '=', date('m'))
                ->sum(DB::raw('sold * (price - capitalPrice)'));            
        }


        return view ('printables.products.index')
            ->with('sales',$sales)->with('saleTotal',$saleTotal)
            ->with('date_query',$date_query);

    }


    // public function salesExcelPrintable (Request $request){
    //     $date_query = $request->date_query;

    //     dd($date_query);
    // }


        public function productsExcelPrintable(Request $request){

            $accept = $request->date_query;

            Excel::create('reports',function($excel) use ($accept){

                $date_range = $accept;

                $excel->sheet('reports',function($sheet) use ($date_range) {

                    $sales = DB::table('products')
                            ->where('category','!=','Room Sale')
                            ->orderByRaw(' price - capitalPrice ASC') 
                            ->get();
                    $saleTotal = Product::where('category','!=','Room Sale')->sum(DB::raw('sold * (price - capitalPrice)'));
                    $date_query = $date_range;

                    if($date_range == 'All'){
                         $sales = DB::table('products')
                                ->where('category','!=','Room Sale')
                                ->orderByRaw(' price - capitalPrice ASC') 
                                ->get();

                        $saleTotal = Product::where('category','!=','Room Sale')->sum(DB::raw('sold * (price - capitalPrice)'));                       
                    }


                    elseif($date_range == 'Select Filter'){
                        $sales =  DB::table('products')
                                ->where('category','!=','Room Sale')
                                ->orderByRaw(' price - capitalPrice ASC')
                                ->whereDate('created_at', $date_range)->get();
                        $saleTotal = Product::where('category','!=','Room Sale')->sum(DB::raw('sold * (price - capitalPrice)'));             
                    }


                    elseif($date_range == 'Today'){
                        $sales = DB::table('products')
                            ->where('category','!=','Room Sale')
                            ->orderByRaw(' price - capitalPrice ASC')
                            ->whereDay('created_at', '=', date('d'))
                            ->get();
                        $saleTotal = DB::table('products')
                            ->where('category','!=','Room Sale')
                            ->orderByRaw(' price - capitalPrice ASC')
                            ->whereDay('created_at', '=', date('d'))->sum(DB::raw('sold * (price - capitalPrice)'));
                    }

                    elseif ($date_range == 'This Week'){
                         $sales =DB::table('products')
                                ->where('category','!=','Room Sale')
                                ->orderByRaw(' price - capitalPrice ASC')
                                ->whereBetween('created_at', [
                                Carbon\Carbon::parse('last monday')->startOfDay(),
                                Carbon\Carbon::parse('next friday')->endOfDay(),
                            ])->get();

                        $saleTotal= DB::table('products')
                                ->where('category','!=','Room Sale')
                                ->orderByRaw(' price - capitalPrice ASC')
                                ->select(DB::raw('YEAR(created_at) year'))
                            ->whereBetween('created_at', [
                                Carbon\Carbon::parse('last monday')->startOfDay(),
                                Carbon\Carbon::parse('next friday')->endOfDay(),
                            ])
                                ->sum(DB::raw('sold * (price - capitalPrice)'));           
                    }


                    elseif ($date_range == 'This Month'){
                        $sales= DB::table('products')
                                ->where('category','!=','Room Sale')
                                ->orderByRaw(' price - capitalPrice ASC')
                                ->whereMonth('created_at', '=', date('m'))
                           ->get();
                        $saleTotal= DB::table('products')
                                ->where('category','!=','Room Sale')
                                ->orderByRaw(' price - capitalPrice ASC')
                                ->select(DB::raw('MONTH(created_at) month'))
                            ->whereMonth('created_at', '=', date('m'))
                            ->sum(DB::raw('sold * (price - capitalPrice)'));              
                    }


                    else{
                        $sales = DB::table('products')
                                ->where('category','!=','Room Sale')
                                ->orderByRaw(' price - capitalPrice ASC')
                                ->whereDate('created_at', $date_range)->get();

                        $saleTotal = Product::where('category','!=','Room Sale')->whereDate('created_at', $date_range)
                                    ->sum(DB::raw('sold * (price - capitalPrice)'));
                    }

                    $sheet->loadView('printables.products.printable')
                        ->with('sales',$sales)
                        ->with('saleTotal',$saleTotal)
                        ->with('date_query',$date_query);
                });
            })->export('xlsx');    
        }


}
