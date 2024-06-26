<?php

namespace App\Http\Controllers\Admin;

use DB;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\Size;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function showMessage($status,$message,$route = NULL)
    {
        return array(
            'status' => $status,
            'message' => $message,
            'redirect' => $route,
        );
    }

    public function index($slug)
    {
        if($slug != Session::get('name'))
        {
            Session::flush();
            return redirect()->route('login');
        }

        $transactions =  Transaction::join('products', 'transactions.id_product', '=', 'products.id')
        // ->where('transactions.id_product', 'products.id')
        ->where('products.status', 1)
        ->select('transactions.no_pemesanan', 'transactions.nama_pelanggan', 'transactions.jumlah', 'transactions.tanggal_pemesanan', 'transactions.harga_total', 'products.nama_produk')
        ->distinct('transactions.no_pemesanan', 'transactions.nama_pelanggan', 'transactions.jumlah', 'transactions.tanggal_pemesanan', 'transactions.harga_total', 'products.nama_produk')
        ->get();
        
        // dd($transactions);

        return view('admin.transaction.view', compact('transactions'));
    }

}