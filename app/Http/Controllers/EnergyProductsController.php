<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EnergyProduct;
use DB;


class EnergyProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $dataYears = EnergyProduct::select(DB::raw('YEAR(entry_date) as year'))
            ->orderby('year', 'DESC')
            ->distinct()
            ->get();

        $yearFilter = $request->input('year') ? $request->input('year') : $dataYears->first()->year;

        $yearsArray = $dataYears->pluck('year');

        $productsAll = EnergyProduct::whereYear("entry_date", $yearFilter)->get();



        $electricity = DB::table('energy_products')->select('name', 'source', DB::raw('quantity*0.000086 as convertedQty'))
            ->whereYear('entry_date', $yearFilter)
            ->where('name', 'electricity')
            ->get();

        $biomass = DB::table('energy_products')->select('name', 'source', DB::raw('quantity*0.00009993 as convertedQty'))
            ->whereYear('entry_date', $yearFilter)
            ->where('name', 'biomass')
            ->get();

        $lpgas = DB::table('energy_products')->select('name', 'source', \DB::raw('quantity*0.00000009993 as convertedQty'))
            ->whereYear('entry_date', $yearFilter)
            ->where('name', 'lpgas')
            ->get();

        $renewables = DB::table('energy_products')->select('name', 'source', \DB::raw('quantity*0.000086 as convertedQty'))
            ->whereYear('entry_date', $yearFilter)
            ->where('name', 'renewables')
            ->get();

        $coal = DB::table('energy_products')->select('name', 'source', \DB::raw('quantity*0.00009993 as convertedQty'))
            ->whereYear('entry_date', $yearFilter)
            ->where('name', 'coal products')
            ->get();

        $petroleum = DB::table('energy_products')->select('name', 'source', \DB::raw('quantity*0.00009813 as convertedQty'))
            ->whereYear('entry_date', $yearFilter)
            ->where('name', 'petroleum')
            ->get();

        // =============== FILTERED DATA ===============
        $source = $request->input('source') == null || $request->input('source') == "all" ? null : $request->input('source');
        $productName = $request->input('product') == null || $request->input('product') == "all" ? null : $request->input('product');
        $fromDate = $request->input('from');
        $toDate = $request->input('to');



        $productsFiltered = \DB::table('energy_products')
            ->when($source, function ($query, $source) {
                return $query->where('source', '=', $source);
            })
            ->when($productName, function ($query, $productName) {
                return $query->where('name', '=', $productName);
            })
            ->when($fromDate, function ($query, $fromDate) {
                return $query->where('entry_date', '>=', $fromDate);
            })
            ->when($toDate, function ($query, $toDate) {
                return $query->where('entry_date', '<=', $toDate);
            })
            ->get();


        $energyBalance = $electricity->concat($biomass)->concat($lpgas)->concat($renewables)->concat($coal)->concat($petroleum);
        return view("products.index", [
            "productsAll" => $productsAll,
            "energyBalance" => $energyBalance,
            "productsFiltered" => $productsFiltered,
            "availableYears" => $yearsArray,
            "filterYear" => $yearFilter
        ]);
    }
    public function indexApi()
    {
        return EnergyProduct::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required'
        ]);
        EnergyProduct::create([
            "name" => $request->product,
            "source" => $request->source,
            "quantity" => $request->quantity,
            "entry_date" => $request->date
        ]);

        return  redirect(route("product.index"));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
