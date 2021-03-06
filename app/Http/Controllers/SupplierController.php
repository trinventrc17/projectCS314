<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Supplier;
use App\SaleItem;
use App\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'suppliers' => Supplier::paginate(),
        ];

        return view('suppliers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreSupplier $request)
    {
        $form = $request->all();

        $supplier = Supplier::create($form);

        return redirect('suppliers')
            ->with('message-success', 'Supplier created!');
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
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.show', compact('supplier'));
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
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests $request
     * @param int               $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateSupplier $request, $id)
    {
        $form = $request->all();

        $supplier = Supplier::findOrFail($id);
        $supplier->update($form);

        return redirect('suppliers')
            ->with('message-success', 'Supplier updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $supplier = SaleItem::findOrFail($id);
        $product = Product::all();

        if($supplier->quantity > 1 && $request->type == 'reduce'){
                $supplier->quantity -= 1;
                $supplier->save();

                $product = Product::findOrFail($supplier->product_id);
                $product->sold -= 1;
                $product->save();
        }
        else
            $supplier->delete();

        return Redirect::back();
    }
}
