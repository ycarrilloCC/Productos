<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Shopping;
use App\Models\Bill;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class ShoppingController extends Controller
{
    public function index()
    {
        $products = Products::pluck('name_product','id');
        $shopping = $this->loadshopping();
        return view('shopping.index', compact('products','shopping'));
    }
    public function loadshopping()
    {
        $shopping = Bill::where('id_user', Auth::user()->id)->where('status', 0)->get()->toArray();
        return count($shopping) == 0 ? []:$shopping[0]['shopping'];
    }
    public function store(Request $request)
    {
        $messages = [

            'product.required'   =>__('Please select a Product')
        ];
         $validator = Validator::make($request->all(), [

            'product' => 'required'

        ], $messages);
        if ($validator->fails()) {
            $result['status'] = 0;
            $result['message'] = __('');
            foreach ($validator->errors()->all() as $key => $value) {
                $result['message'] .= $value.'<br/>';
            }
            $result['data'] = null;
            $result['type'] = 'error';

        }else{
            try {
                $Bill = Bill::where('id_user', Auth::user()->id)->where('status', 0)->get()->toArray();
                if(count($Bill) == 0){
                    $bill = new Bill();
                    $bill->id_user       = Auth::user()->id;
                    $bill->status        = 0;
                    $bill->date_billing  = now();
                    $bill->date_register = now();
                    $bill->ip            = \Request::ip();
                    $bill->save();
                }
                $item = new Shopping();
                $item->id_bill       = count($Bill) == 0 ? $bill->id : $Bill[0]['id'];
                $item->id_product    = $request->product;
                $item->date_register = now();
                $item->ip            = \Request::ip();
                $item->save();

                $result['status']  = 1;
                $result['tittle']  = __('Data stored successfully');
                $result['type']    = __('success');
                $result['message'] = __('');

            }catch (\Exception $e) {
                $result['status']  = 0;
                $result['tittle']  = __('Store error');
                $result['type']    = __('error');
                $result['message'] = $e->getMessage();
            }
        }
            return $result;
    }
    public function delete_shopping($id)
    {
     try {
            DB::table('shopping')->where('id', $id)->delete();
            $msg = __('Deleted');

            $result['status']  = 1;
            $result['tittle']  = $msg;
            $result['type']    = __('success');
            $result['message'] = __('');
        } catch (Exception $e) {
            $result['status']  = 0;
            $result['tittle']  = __('Update error');
            $result['type']    = __('error');
            $result['message'] = $e->getMessage();
        }
        return $result;
    }
}
