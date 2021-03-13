<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryController extends BaseController {
    public function index() {
        return view('inventory');
    }

    public function getInventory(Request $request) {
        $inventory = DB::table('inventory as i')
            ->join('products as p','p.id','=','i.product_id')
            ->where('p.admin_id',Auth::user()->id)
            ->orderBy('product_id')
            ->orderBy('sku');
        if(!empty($request->filterId)){
            $inventory = $inventory->whereRaw("i.product_id LIKE ?",[$request->filterId.'%']);
        }
        if(!empty($request->filterName)){
            $inventory = $inventory->whereRaw("p.product_name LIKE ?",[$request->filterName.'%']);
        }
        if(!empty($request->filterSku)){
            $inventory = $inventory->whereRaw("i.sku LIKE ?",[$request->filterSku.'%']);
        }
        if(isset($request->filterQty) && isset($request->filterQtyDir)){
            $operator = ($request->filterQtyDir=='more') ? '>=' : '<=';
            $inventory = $inventory->where("i.quantity",$operator, $request->filterQty);
        }
        $inventory = $inventory->paginate(10);
        return json_encode(['inventory' => $inventory]);
    }
}
