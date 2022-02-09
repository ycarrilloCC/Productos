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

class BillController extends Controller
{
    public function index()
    {
        $bill = $this->loadBills();
        return view('bill.index', compact('bill'));
    }
    public function loadBills()
    {
        $bill = Bill::where('status', 1)->get()->toArray();
        return $bill;
    }
    public function check_in()
    {
     try {
            DB::table('bill')->where('status', 0)->update(['status' => true]);
            $msg = __('Check in successfully');

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
    public function show_bill($id)
    {
        $DetailBill = Bill::where('id', $id)->get()->toArray();
        $totals     = $DetailBill[0]['shopping'];
        $totalPrice = 0;
        $totalTax   = 0;
        foreach ($totals as $value) {
            $totalPrice += $value['product_price'];
            $totalTax   += $value['product_tax'];
        }
        $DetailBill[0]['totalPrice'] = $totalPrice;
        $DetailBill[0]['totalTax']   = $totalTax;
        return view('bill.detail', compact('DetailBill',));
    }
}
