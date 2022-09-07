<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionsStoreRequest;
use App\Models\Transactions;
use App\Models\User;

class TransactionsController extends Controller
{
    protected $table = 'transactions';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transactions::join('users', 'users.id', 'transactions.userId')
            ->join('stocks', 'stocks.id', 'transactions.stockId')
            ->where('users.isActive', 1)
            ->limit(5)
            ->get();
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
     * @param  \App\Http\Requests\TransactionsStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionsStoreRequest $request)
    {
        $purchasePrice = $request->input('purchasePrice');
        $amount = $request->input('amount');
        $totalPrice = $purchasePrice * $amount;

        $user = User::find($request->input('userId'));

        if($user->deposit > $totalPrice) {
            $transModel = new Transactions();
            $transModel->userId = $request->input('userId');
            $transModel->stockId = $request->input('stockId');
            $transModel->amount = $request->input('amount');
            $transModel->purchasePrice = $request->input('purchasePrice');
            
            // Update user deposit
            $user->deposit = ($user->deposit - $totalPrice);

            $user->save();
            $transModel->save();

            return response('success', 200);
        }

        return response('error', 200);
    }

        /**
     * Display the specified resource for specified user.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function transactionsByUser($id = null)
    {
        $data = Transactions::where('userId', $id)
            ->join('stocks', 'transactions.stockId', 'stocks.id')
            ->get(['transactions.id','amount', 'name', 'price', 'purchasePrice']);

        return $data;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(Transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionsRequest  $request
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionsRequest $request, Transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transactions $transactions)
    {
        //
    }
}
