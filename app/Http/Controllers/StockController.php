<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\HTTP\Requests\StockUpdateRequest;
use App\HTTP\Requests\StockStoreRequest;
use App\Http\Resources\StockResource;
use Illuminate\Support\Facades\Storage;


class StockController extends Controller
{
    /**
     * Get stocks.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        return Stock::where('isActive', 1)
            ->orderBy('price', 'DESC')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StockStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockStoreRequest $request)
    {
        $userData = $request->collect();
        $fileName = null;
        $filePath = null;

        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
        }

        $stock = new Stock();
        $stock->name = $userData['name'];
        $stock->price = $userData['price'];
        $stock->accentColor = $userData['accentColor'];
        $stock->bgColor = $userData['bgColor'];
        $stock->isActive = 1;
        $stock->icon = $filePath;
        $stock->save();

        return response('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HTTP\Models\Stock $stock
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock, $id = null)
    {
        return $stock->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Requests\StockUpdateRequest  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(StockUpdateRequest $request, Stock $stock)
    {
        $inputData = $request->only(['id', 'price', 'accentColor', 'bgColor']);

        $selectedStock = $stock->find($request['id']);
        $selectedStock->price = $inputData['price'];
        $selectedStock->accentColor = $inputData['accentColor'];
        $selectedStock->bgColor = $inputData['bgColor'];
        $selectedStock->save();

        return response('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock, $id = null)
    {
        // I can use delete method, but i'm not removing any record from DB,
        // Just updating active status
        // $deletedStock = $stock->find($id)->delete();

        $selectedStock = $stock->findOrFail($id);
        $selectedStock->isActive = 0;
        $selectedStock->price = 0;
        $selectedStock->save();

        return response('success', 200);
    }

        /**
     * Get most valuable stocks.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMostValuableStocks()
    {
        return Stock::where('isActive', 1)
            ->orderBy('price', 'DESC')
            ->take(4)
            ->get();
    }

    /**
     * Get mrecent stock.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRecentStock()
    {
        return Stock::
            where('isActive', 1)
            ->orderBy('id', 'DESC')
            ->first('name');
    }
}
