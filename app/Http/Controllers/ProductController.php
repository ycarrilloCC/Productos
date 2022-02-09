<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Comments;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
        $products = $this->loadproducts();
        return view('products.index', compact('products'));
    }
    public function loadproducts()
    {
        $products = Products::get();
        return $products;
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        $messages = [

            'name_product.required'   =>__('The Name of the Product is Required'),
            'name_product.unique'     =>__('The Name of the Product Already Exists'),
            'product_price.required'  =>__('The Price of the Product is Required'),
            'product_tax.required'    =>__('The Tax of the Product is Required')
        ];
         $validator = Validator::make($request->all(), [

            'name_product'     => 'required|unique:products,name_product',
            'product_price'    => 'required',
            'product_tax'      => 'required'

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
                $item = new Products();
                $item->name_product  = strtoupper($request->name_product);
                $item->product_price = $request->product_price;
                $item->product_tax   = $request->product_tax;
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
    public function edit($id)
    {
        $Products = Products::find($id);
        return view('products.edit', compact('Products'));
    }
    public function update(Request $request)
    {
        $messages = [

            'name_product.required'   =>__('The Name of the Product is Required'),
            'name_product.unique'     =>__('The Name of the Product Already Exists'),
            'product_price.required'  =>__('The Price of the Product is Required'),
            'product_tax.required'    =>__('The Price of the Product is Required')
        ];
         $validator = Validator::make($request->all(), [

            'name_product'    => 'required|unique:products,name_product,' . $request->id,
            'product_price'   => 'required',
            'product_tax'     => 'required'

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
                $item = Products::find($request->id);
                if($item != null){
                    $item->name_product  = strtoupper($request->name_product);
                    $item->product_price = $request->product_price;
                    $item->product_tax   = $request->product_tax;
                    $item->date_register = now();
                    $item->ip            = \Request::ip();
                    $item->save();

                    $result['status']  = 1;
                    $result['tittle']  = __('Data stored successfully');
                    $result['type']    = __('success');
                    $result['message'] = __('');
                }else{
                    $result['status']  = 0;
                    $result['tittle']  = __('No data found');
                    $result['type']    = __('error');
                    $result['message'] = __('');
                }

            }catch (\Exception $e) {
                $result['status']  = 0;
                $result['tittle']  = __('Update error');
                $result['type']    = __('error');
                $result['message'] = $e->getMessage();
            }
        }
            return $result;
    }
    public function change_status($id, $type)
    {
     try {
            $product         = Products::find($id);
            $product->status = $type;
            $product->save();
            $msg = $type == 0 ? __('Deleted'):__('Restored');

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
