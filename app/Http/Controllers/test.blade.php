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


    public function productsIndex(Request $request){
        $sales = DB::table('products')
                ->where('category','!=','Room Sale')
                ->orderByRaw(' price - capitalPrice ASC') 
                ->get();

        $saleTotal = Product::sum(DB::raw('sold * (price - capitalPrice)'));
        
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
                ->whereDate('created_at', $date_range)->get();

        $saleTotal = Product::whereDate('created_at', $date_range)
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
                ->whereDate('created_at', $date_range)->get();
        $saleTotal = Product::sum(DB::raw('sold * (price - capitalPrice)'));
        
        $date_query = $date_range;

        if($date_range == 'Select Filter'){
            $sales =  DB::table('products')
                    ->where('category','!=','Room Sale')
                    ->orderByRaw(' price - capitalPrice ASC')
                    ->whereDate('created_at', $date_range)->get();
            $saleTotal = Product::sum(DB::raw('sold * (price - capitalPrice)'));        
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
                    ->whereDay('created_at', '=', date('d'))->sum(DB::raw('price * quantity'));
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
                    ->sum(DB::raw('price * quantity'));           
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


    public function productsExcelPrintable(Request $request){

        $accept = $request->date_query;

        Excel::create('reports',function($excel) use ($accept){

            $date_range = $accept;

            $excel->sheet('reports',function($sheet) use ($date_range) {

                $sales = DB::table('products')
                        ->where('category','!=','Room Sale')
                        ->orderByRaw(' price - capitalPrice ASC') 
                        ->get();

                $saleTotal = Product::sum(DB::raw('sold * (price - capitalPrice)'));
                $date_query = $date_range;

                if($date_range == 'Select Filter'){
                    $sales =  DB::table('products')
                            ->where('category','!=','Room Sale')
                            ->orderByRaw(' price - capitalPrice ASC')
                            ->whereDate('created_at', $date_range)->get();
                    $saleTotal = Product::sum(DB::raw('sold * (price - capitalPrice)'));             
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
                        ->whereDay('created_at', '=', date('d'))->sum(DB::raw('price * quantity'));
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
                            ->sum(DB::raw('price * quantity'));           
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
                        ->sum(DB::raw('price * quantity'));              
                }


                else{
                    $sales = DB::table('products')
                            ->where('category','!=','Room Sale')
                            ->orderByRaw(' price - capitalPrice ASC')
                            ->whereDate('created_at', $date_range)->get();

                    $saleTotal = Product::whereDate('created_at', $date_range)
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
