<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Room;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests;
use App\Sale;
use App\SaleItem;
use App\RoomChanges;
use DB;
use Carbon\Carbon;
class TestController extends Controller
{




public function productsExcelPrintable(Request $request){

            
        $accept = $request->date_query;
        $accept2 = $request->date_query2;

            Excel::create('reports',function($excel) use ($accept,$accept2){

                $date_range = $accept;
                $date_range2 = $accept2;
                $excel->sheet('reports',function($sheet) use ($date_range,$date_range2) {

                $sales = DB::table('products')
                        ->where('category','!=','Room Sale')
                        ->orderByRaw(' price - capitalPrice ASC') 
                        ->get();


                $sales = DB::table('sale_items')
                    ->join('products', 'sale_items.product_id', '=', 'products.id')
                    ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price')
                    ->where('products.category','!=','Room Sale')
                    ->groupBy(DB::raw('product_id') )
                    ->get();

                        $saleTotal = DB::table('sale_items')->join('products', 'sale_items.product_id', '=', 'products.id')
                            ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price','sale_items.created_at as created_at')
                            ->where('products.category','!=','Room Sale')
                            ->groupBy(DB::raw('product_id') )
                            ->sum(DB::raw('sale_items.quantity * (products.price - products.capitalPrice)'));



                    $date_query = $date_range;

                    if($date_range == 'All'){
                        $sales = DB::table('sale_items')
                            ->join('products', 'sale_items.product_id', '=', 'products.id')
                            ->where('products.category','!=','Room Sale')
                            ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price')
                            ->groupBy(DB::raw('product_id') )
                            ->get();


                        $saleTotal = DB::table('sale_items')->join('products', 'sale_items.product_id', '=', 'products.id')
                            ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price','sale_items.created_at as created_at')
                            ->where('products.category','!=','Room Sale')
                            ->groupBy(DB::raw('product_id') )
                            ->sum(DB::raw('sale_items.quantity * (products.price - products.capitalPrice)'));                          
                    }


                    elseif($date_range == 'Select Filter'){
                        $sales = DB::table('sale_items')
                            ->join('products', 'sale_items.product_id', '=', 'products.id')
                            ->where('products.category','!=','Room Sale')
                            ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price')
                            ->groupBy(DB::raw('product_id') )
                            ->get();


                        $saleTotal = DB::table('sale_items')->join('products', 'sale_items.product_id', '=', 'products.id')
                            ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price','sale_items.created_at as created_at')
                            ->where('products.category','!=','Room Sale')
                            ->groupBy(DB::raw('product_id') )
                            ->sum(DB::raw('sale_items.quantity * (products.price - products.capitalPrice)'));            
                    }


                    elseif($date_range == 'Today'){
                        $sales = DB::table('sale_items')
                            ->join('products', 'sale_items.product_id', '=', 'products.id')
                            ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price','sale_items.created_at as created_at')
                            ->where('products.category','!=','Room Sale')
                            ->whereDay('sale_items.created_at', '=', date('d'))
                            ->groupBy(DB::raw('product_id') )
                            ->get();

                        $saleTotal = DB::table('sale_items')->join('products', 'sale_items.product_id', '=', 'products.id')
                            ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price','sale_items.created_at as created_at')
                            ->where('products.category','!=','Room Sale')
                            ->whereDay('sale_items.created_at', '=', date('d'))
                            ->groupBy(DB::raw('product_id') )
                            ->sum(DB::raw('sale_items.quantity * (products.price - products.capitalPrice)'));
                    }

                    elseif ($date_range == 'This Week'){
                        $sales = DB::table('sale_items')
                            ->join('products', 'sale_items.product_id', '=', 'products.id')
                            ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price','sale_items.created_at as created_at')
                            ->where('products.category','!=','Room Sale')
                            ->whereBetween('sale_items.created_at', [
                                Carbon\Carbon::parse('last monday')->startOfDay(),
                                Carbon\Carbon::parse('next friday')->endOfDay(),
                                ])
                            ->groupBy(DB::raw('product_id') )
                            ->get();

                        $saleTotal = DB::table('sale_items')->join('products', 'sale_items.product_id', '=', 'products.id')
                            ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price','sale_items.created_at as created_at')
                            ->where('products.category','!=','Room Sale')
                            ->whereBetween('sale_items.created_at', [
                                Carbon\Carbon::parse('last monday')->startOfDay(),
                                Carbon\Carbon::parse('next friday')->endOfDay(),
                                ])
                            ->groupBy(DB::raw('product_id') )
                            ->sum(DB::raw('sale_items.quantity * (products.price - products.capitalPrice)'));           
                    }


                    elseif ($date_range == 'This Month'){
                        $sales = DB::table('sale_items')
                            ->join('products', 'sale_items.product_id', '=', 'products.id')
                            ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price','sale_items.created_at as created_at')
                            ->where('products.category','!=','Room Sale')
                            ->whereMonth('sale_items.created_at', '=', date('m'))
                            ->groupBy(DB::raw('product_id') )
                            ->get();

                        $saleTotal = DB::table('sale_items')->join('products', 'sale_items.product_id', '=', 'products.id')
                            ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price','sale_items.created_at as created_at')
                            ->where('products.category','!=','Room Sale')
                            ->whereMonth('sale_items.created_at', '=', date('m'))
                            ->groupBy(DB::raw('product_id') )
                            ->sum(DB::raw('sale_items.quantity * (products.price - products.capitalPrice)'));               
                    }


                    else{
                        $sales = DB::table('sale_items')
                            ->join('products', 'sale_items.product_id', '=', 'products.id')
                            ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price','sale_items.created_at as created_at')
                            ->where('products.category','!=','Room Sale')
                            ->whereBetween('sale_items.created_at',array($date_range,$date_range2))
                            ->groupBy(DB::raw('product_id') )
                            ->get();


                        $saleTotal = DB::table('sale_items')->join('products', 'sale_items.product_id', '=', 'products.id')
                                ->select('products.name as name' ,DB::raw('sum(sale_items.quantity) as sold'),'products.capitalPrice as capitalPrice','products.price as price','sale_items.created_at as created_at')
                                ->where('products.category','!=','Room Sale')
                                ->whereBetween('sale_items.created_at',array($date_range,$date_range2))
                                ->groupBy(DB::raw('product_id') )
                                ->sum(DB::raw('sale_items.quantity * (products.price - products.capitalPrice)'));
                    }

                    $sheet->loadView('printables.products.printable')
                        ->with('sales',$sales)
                        ->with('saleTotal',$saleTotal)
                        ->with('date_query',$date_query);
                });
            })->export('xlsx');    
        }


    


}
