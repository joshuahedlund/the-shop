<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
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
        if(!empty($request->get('filterId'))){
            $inventory = $inventory->whereRaw("i.product_id LIKE ?",[$request->get('filterId').'%']);
        }
        if(!empty($request->get('filterSku'))){
            $inventory = $inventory->whereRaw("i.sku LIKE ?",[$request->get('filterSku').'%']);
        }
        $inventory = $inventory->paginate(25);
        echo json_encode(['inventory' => $inventory]);
    }
}
