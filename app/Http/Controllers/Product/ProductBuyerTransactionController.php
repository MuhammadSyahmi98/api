<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{

    public function store(Request $request, Product $product, User $buyer)
    {
        $rules = [
            'quantity' => 'required|integer|min:1'
        ];

        $this->validate($request, $rules);

//        if ($buyer->id == $product_seller_id){
//            return $this->errorResponse('This buyer must be different from the seller', 409);
//        }

        if (!$buyer->isVerified()){
            return $this->errorResponse('This buyer must be a verified user', 409);
        }

        if (!$product->seller->isVerified()){
            return $this->errorResponse('This seller must be a verified user', 409);
        }

        if (!$product->isAvailable()){
            return $this->errorResponse('The product is not available', 409);
        }

        if ($product->quantity < $request->quantity){
            return $this->errorResponse('The product does not ahve enough units for the transaction', 409);
        }

        return DB::transaction(function () use ($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id
            ]);

            return $this->showOne($transaction, 201);
        });
    }

}
