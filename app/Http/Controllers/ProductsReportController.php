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
                ->get();

        $totalEarnings = Product::sum(DB::raw('sold * (price - capitalPrice)'));

    	return view ('reports.products.index')
            ->with('products',$products)
            ->with('totalEarnings',$totalEarnings);

       //  $data = [
       //      'sale' => Sale::get()
       //  ];

       //  $form = $request->all();

       //  $data = [
       //      'input' => $form,
       //  ];

 
       // $data['sales'] = Sale::search($form)->get();

       //  $saleItem = SaleItem::get();
       //  $sales = $data['sales'];
        
       //  return view('reports.products.index2',$data);
    }


    public function rooms(Request $request){
        $products = DB::table('products')
                ->where('category','=','Room Sale')
                ->orderByRaw(' price - capitalPrice ASC') 
                ->get();

      return view ('reports.products.rooms')
            ->with('products',$products);
    }



    public function earnings (Request $request){

        $earnings =DB::table('sale_items')
            ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(price * quantity) as total'))
            ->groupBy(DB::raw('DATE(created_at)') )
            ->orderByRaw('day DESC')
            ->paginate(15);

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
        
        $expenses =DB::table('expenses')
            ->select(DB::raw('DATE(created_at) as day'),DB::raw('sum(amount) as total'))
            ->groupBy(DB::raw('DATE(created_at)') )
            ->orderByRaw('day DESC')
            ->get();



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
