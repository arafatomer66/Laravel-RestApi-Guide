<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerTransactionController extends ApiController
{

    public function index(Seller $seller)
    {
        $transactions = $seller->products()->whereHas('transactions')->with('transactions')->get()->pluck('transactions')->collapse() ;
        return $this->showAll($transactions);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Seller $seller)
    {
        //
    }


    public function edit(Seller $seller)
    {
        //
    }


    public function update(Request $request, Seller $seller)
    {
        //
    }


    public function destroy(Seller $seller)
    {
        //
    }
}
