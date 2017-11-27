<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Sale;
use App\Product;
use App\SaleItem;
use App\Expenses;
use Carbon;
class ProductsReportController extends Controller
{
    public function index(Request $request){

        $products = DB::table('products')
                ->where('category','!=','Room Sale')
                ->orderByRaw(' price - capitalPrice ASC') 
                ->paginate(10);

        $totalEarnings = Product::where('category','!=','Room Sale')->sum(DB::raw('sold * (price - capitalPrice)'));

    	return view ('reports.products.index')
            ->with('products',$products)
            ->with('totalEarnings',$totalEarnings);
    }


    public function rooms(Request $request){
        $products = DB::table('products')
                ->where('category','=','Room Sale')
                ->orderByRaw(' price - capitalPrice ASC') 
                ->get();
        $totalEarnings = Product::where('category','=','Room Sale')->sum(DB::raw('sold * (price)'));
      
      return view ('reports.products.rooms')
            ->with('totalEarnings',$totalEarnings)
            ->with('products',$products);
    }



    public function earnings (Request $request){

        $expenses =DB::table('expenses')
            ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
            ->groupBy(DB::raw('DATE(created_at)') )
            ->orderByRaw('day DESC')
            ->get();


        $earnings =DB::table('sale_items')
            ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
            ->groupBy(DB::raw('DATE(created_at)') )
            ->orderByRaw('day DESC')
            ->get();

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





        $totalEarnings = SaleItem::sum(DB::raw('price * quantity'));
        $totalExpenses = Expenses::sum(DB::raw('amount'));

        $totalAll = $totalEarnings - $totalExpenses;
        




        return view('reports.earnings.index')
            ->with('earnings',$earnings)
            ->with('expenses',$expenses)
            ->with('dailyEarnings',$dailyEarnings-$dailyExpenses)
            ->with('weeklyEarnings',$weeklyEarnings-$weeklyExpenses)
            ->with('monthlyEarnings',$monthlyEarnings-$monthlyExpenses)
            ->with('yearlyEarnings',$yearlyEarnings-$yearlyExpenses)
            ->with('totalEarnings',$totalAll);
    }

   public function earningsSearched (Request $request){

        $date_range = $request->date_range;




        if($date_range == 'Select Filter' || $date_range == 'All'){
            $expenses =DB::table('expenses')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();


            $earnings =DB::table('sale_items')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();      
        }


        elseif($date_range == 'Today'){
            $expenses =DB::table('expenses')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                ->whereDay('created_at', '=', date('d'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();


            $earnings =DB::table('sale_items')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                ->whereDay('created_at', '=', date('d'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();    
        }

        elseif($date_range == 'This Week'){
            $expenses =DB::table('expenses')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                ->whereBetween('created_at', [
                    Carbon\Carbon::parse('last monday')->startOfDay(),
                    Carbon\Carbon::parse('next friday')->endOfDay(),
                ])
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();


            $earnings =DB::table('sale_items')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                ->whereBetween('created_at', [
                    Carbon\Carbon::parse('last monday')->startOfDay(),
                    Carbon\Carbon::parse('next friday')->endOfDay(),
                ])
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();            
        }


        elseif($date_range == 'This Month'){

            $expenses =DB::table('expenses')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                ->whereMonth('created_at', '=', date('m'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();


            $earnings =DB::table('sale_items')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                ->whereMonth('created_at', '=', date('m'))
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();        
        }

        else{
            
            $expenses =DB::table('expenses')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
                ->whereDate('created_at', $date_range)
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();


            $earnings =DB::table('sale_items')
                ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
                ->whereDate('created_at', $date_range)
                ->groupBy(DB::raw('DATE(created_at)') )
                ->orderByRaw('day DESC')
                ->get();      
        }




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





        $totalEarnings = SaleItem::sum(DB::raw('price * quantity'));
        $totalExpenses = Expenses::sum(DB::raw('amount'));

        $totalAll = $totalEarnings - $totalExpenses;
        




        return view('reports.earnings.index')
            ->with('earnings',$earnings)
            ->with('expenses',$expenses)
            ->with('dailyEarnings',$dailyEarnings-$dailyExpenses)
            ->with('weeklyEarnings',$weeklyEarnings-$weeklyExpenses)
            ->with('monthlyEarnings',$monthlyEarnings-$monthlyExpenses)
            ->with('yearlyEarnings',$yearlyEarnings-$yearlyExpenses)
            ->with('totalEarnings',$totalAll);
    }

}
