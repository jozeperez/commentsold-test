<?php

namespace App\Http\Controllers;

// use App\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // apply quick filter on 'product id' or 'sku #'
        $orders = DB::table('orders')
            ->select(
                'orders.product_id',
                'orders.name',
                'orders.email',
                'orders.order_status',
                'orders.total_cents',
                'orders.tax_total_cents',
                'orders.transaction_id',
                'orders.shipper_name',
                'orders.tracking_number')
            ->paginate(15);

            // extend our orders (a little more efficient than joining 3 tables)
            foreach ($orders as $order) {
                // fetch product name & extend item record
                $order->product_name = DB::table('products')->where('id', '=', $order->product_id)->value('product_name');

                // fetch product name & extend item record
                $inventoryTempData = DB::table('inventory')->select('color', 'size')->where('product_id', '=', $order->product_id)->get();
                $order->size = $inventoryTempData[0]->size;
                $order->color = $inventoryTempData[0]->color;
            }

            // calculate total sales
            $sumTotalSales = DB::table('orders')
                ->select(DB::raw('SUM(total_cents) as sum_total_cents'), DB::raw('SUM(tax_total_cents) as sum_tax_total_cents'))
                ->get();

            // calculate average sales
            $avgTotalSales = DB::table('orders')
                ->select(DB::raw('AVG(total_cents) as avg_total_cents'), DB::raw('AVG(tax_total_cents) as avg_tax_total_cents'))
                ->get();

        return view('orders.index', [
            'orders'        => $orders,
            'sumTotalSales' => $sumTotalSales,
            'avgTotalSales' => $avgTotalSales
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
