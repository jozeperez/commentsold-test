<?php

namespace App\Http\Controllers;

// use App\Inventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, String $flag = NULL, String $type = NULL)
    {
        // apply quick filter on 'product id' or 'sku #'
        $inventory = DB::table('inventory')
            ->join('products', 'products.id', '=', 'inventory.product_id')
            ->select('products.product_name', 'inventory.sku', 'inventory.quantity', 'inventory.color', 'inventory.size', 'inventory.price_cents', 'inventory.cost_cents')
            ->when($request->input('search-query'), function($query, $searchQuery) {
                $searchByField = is_numeric($searchQuery) ? "product_id" : "sku";

                return $query->where("inventory.".$searchByField, "like", "%$searchQuery%");
            })
            ->paginate(15);

            if ($inventory->count() === 0) {
                return redirect('inventory/404/'.($request->input('search-query') ? $request->input('search-query') : ''));
            }

        return view('inventory.index', [
            'inventory'    => $inventory,
            'active_query' => $request->input('search-query'),
            'flag'         => $flag,
            'type'         => $type,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
