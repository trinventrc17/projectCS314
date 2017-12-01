<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Product;
use Illuminate\Http\Request;
use App\Stocks;
use Auth;
class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addFromExisting(Request $request){
        $products = Product::where('category','!=','Room Sale')->pluck('name', 'id');
        return view ('inventories.stocks.addFromExisting')
        ->with('products',$products);
    }




    public function index(Request $request)
    {
        $keyword = $request->get('q', '');

        $stocks = Stocks::searchByKeyword($keyword)->paginate();
        $stocks = !empty($keyword) ? $stocks->appends(['q' => $keyword]) : $stocks;

        $data = [
            'stocks' => $stocks,
            'keyword'  => $keyword,
        ];

        return view('inventories.stocks.index', $data);
    }


    public function ask(){
        return view ('inventories.stocks.existingOrAdd');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreStocks $request)
    {
        $productFind = Product::findOrFail($request->name);
        
        $form = $request->all();

        $stocks = Stocks::create([
                'name'=> $productFind->name,
                'added_by'=> Auth::user()->name,
                'quantity' => $request->quantity,
            ]);

        $product = Product::find($request->name);
        $product->quantity += $request->quantity;
        $product->save();


        return redirect('stocks')
            ->with('message-success', 'Stocks created!');
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
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests $request
     * @param int               $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateProduct $request, $id)
    {
        $form = $request->all();

        $product = Product::findOrFail($id);
        $product->update($form);

        return redirect('products')
            ->with('message-success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('products')
            ->with('message-success', 'Product deleted!');
    }
}
