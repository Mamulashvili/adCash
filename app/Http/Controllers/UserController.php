<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\HTTP\Requests\UserAddRequest;
use App\HTTP\Requests\UserUpdateRequest;


class UserController extends Controller
{
    /**
     * Get all resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        $user = new User();

        if($request->has('limit'))
            return $user->orderBy('id', 'desc')
                ->take($request->query('limit'))
                ->get(['username', 'created_at', 'avatar']); // Date is formated with Trait

        return \DB::table('users')
            ->select(\DB::raw('users.id as id, username, fname, lname, deposit, avatar, COALESCE(SUM(price * amount - purchasePrice * amount), 0) as profit'))
            ->where('users.isActive', 1)
            ->leftJoin('transactions', 'transactions.userId', 'users.id')
            ->leftJoin('stocks', 'stocks.id', 'transactions.stockId')
            ->groupBy(['users.id'])
            ->orderBy('profit', 'desc')
            ->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HTTP\Models\User $user
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $userModel, $user = null)
    {
        return $userModel->findOrFail($user);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserAddRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAddRequest $request, User $user)
    {
        $userData = $request->collect();
        $fileName = null;
        $filePath = null;

        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
        }
        
        $user->username = $userData['username'];
        $user->fname = $userData['fname'];
        $user->lname = $userData['lname'];
        $user->avatar = $filePath;
        $user->save();

        return response('success', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->save();

        return response('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $userModel, $user = null)
    {
        // Like in stocks, don't remove user, update actove status
        $selectedUser = $userModel->findOrFail($user);
        $selectedUser->isActive = 0;
        $selectedUser->save();

        return response('success', 200);
    }
}
