<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use App\SaleItem;
use DB;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type)
    {
        $data = [
            'sale' => Sale::get()
        ];

        $form = $request->all();

        $data = [
            'input' => $form,
        ];

        switch ($type) {
            case 'sales':
                $data['sales'] = Sale::search($form)->get();
                break;

            default:
                abort(404);
                break;
        }
        $saleItem = SaleItem::get();
        $sales = $data['sales'];
 

        $earnings = DB::table('sale_items')->select(DB::raw('*'))
                          ->whereRaw('Date(created_at) = CURDATE()')
                          ->sum(DB::raw('price * quantity'));



        return view('reports.sales.index5',$data)
            ->with('earnings',$earnings);
            // ->with('sales',$sales);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'sale' => Sale::findOrFail($id),
        ];
        
        return view('reports.sales.show2', $data);
    }


}
