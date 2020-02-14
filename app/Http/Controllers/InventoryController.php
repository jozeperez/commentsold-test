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
        // Query database for all inventory
        $inventory = DB::table('inventory')
            ->join('products', 'products.id', '=', 'inventory.product_id')
            ->select('products.product_name', 'inventory.sku', 'inventory.quantity', 'inventory.color', 'inventory.size', 'inventory.price_cents', 'inventory.cost_cents')
            // Apply quick filter on 'product id' or 'sku #'
            ->when($request->input('search-query'), function($query, $searchQuery) {
                $searchByField = is_numeric($searchQuery) ? "product_id" : "sku";

                return $query->where("inventory.".$searchByField, "like", "%$searchQuery%");
            })
            ->paginate(15);

            // We don't have any results do to search parameter;
            //    lets start from scratch and show a notification
            if ($inventory->count() === 0) {
                return redirect('inventory/404/'.($request->input('search-query') ? $request->input('search-query') : ''));
            }

        // Return inventory list
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
