<?php

namespace App\Http\Controllers\Frontend;

use DB;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\Size;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;

class FrontProductController extends Controller
{
    public function showMessage($status,$message,$route = NULL)
    {
        return array(
            'status' => $status,
            'message' => $message,
            'redirect' => $route,
        );
    }

    public function index()
    {
        $products = Product::join('product_size', 'products.id_product_size', '=', 'product_size.id')
        ->join('product_category', 'products.id_product_category', '=', 'product_category.id')
        ->where('products.status', 1)
        ->select('products.nama_produk','products.kode_produk','products.harga_satuan','products.status','products.exp_date','product_size.size_name','product_category.nama_kategori','products.id')
        ->distinct('products.nama_produk','products.kode_produk','products.harga_satuan','products.status','products.exp_date','product_size.size_name','product_category.nama_kategori','products.id')
        ->get();

        return view('frontend.home', compact('products'));
    }

    public function quote(Request $request)
    {
        $product_id = $request->id;
        
        if($product_id) {
            $product_choose = Product::where('id', $request->id)
            ->select('id','nama_produk')
            ->distinct('id','nama_produk')
            ->first();

            $numeric = str_shuffle('123456789');
            $code = substr($numeric, 0, 2);

            $products = NULL;
        }

        return view('frontend.quote', compact('product_choose','products','numeric', 'code'));
    }

    public function custQuote(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'id' => 'required',
            'nama' => 'required',
            'jumlah' => 'required',
            'tglPemesanan' => 'required',
        ],[
            'nama.required' => 'Nama Produk harus di isi',
            'jumlah.required' => 'Jumlah Produk harus di isi',
            'tglPemesanan.required' => 'Tanggal harus di isi',
        ]);

        if($validator->fails()) {
            return $this->showMessage('fail',$validator->errors()->first());
        }

        $id = $request->id;
        $noPesan = $request->noPesan;
        $nama = $request->nama;
        $jumlah = $request->jumlah;
        $tanggal = $request->tglPemesanan;

        // $harga = Transaction::join('products', 'transactions.id_product', '=', 'products.id')
        // ->where('transactions.id_product', $id)
        // ->where('products.status', 1)
        // ->select('products.harga_satuan')
        // ->distinct('products.harga_satuan')
        // ->first();

        $harga = Product::where('id', $id)
        ->select('harga_satuan')
        ->distinct('harga_satuan')
        ->first();
        // dd($harga);
        
        if($id) {
            if($noPesan) {
                if($nama) {
                    if($jumlah) {
                        if($tanggal) {
                        }
                        $product_choose = Product::where('id', $id)
                        ->select('id','nama_produk')
                        ->distinct('id','nama_produk')
                        ->first();
            
                        $noPesan = $request->noPesan;
                        $nama = $request->nama;
                        $jumlah = $request->jumlah;
                        $tanggal = $request->tglPemesanan;
            
                        $products = NULL;
                        $total = $request->jumlah * $harga->harga_satuan;

                        // Notification Toastr
                        $notification = array(
                            'message' => 'Add Product Successfully!',
                            'alert-type' => 'success'
                        );

                        return view('frontend.total', compact('product_choose','products','total','noPesan','nama','jumlah','tanggal'))->with($notification);
                        }
                    }
                }
        }
        // dd($harga);
        

        // Transaction::insert([
        //     'id_product' => $request->id,
        //     'no_pemesanan' => $request->noPesan,
        //     'nama_pelanggan' => $request->nama,
        //     'jumlah' => $request->jumlah,
        //     'tanggal_pemesanan' => $request->tglPemesanan,
        //     'harga_total' => $total,
        //     'created_at' => Carbon::now(),
        // ]);

        
    }

    public function totalQuote(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'id' => 'required',
            'nama' => 'required',
            'jumlah' => 'required',
            'tglPemesanan' => 'required',
        ],[
            'nama.required' => 'Nama Produk harus di isi',
            'jumlah.required' => 'Jumlah Produk harus di isi',
            'tglPemesanan.required' => 'Tanggal harus di isi',
        ]);

        if($validator->fails()) {
            return $this->showMessage('fail',$validator->errors()->first());
        }

        $id = $request->id;
        $noPesan = $request->noPesan;
        $nama = $request->nama;
        $jumlah = $request->jumlah;
        $tanggal = $request->tglPemesanan;

        // $harga = Transaction::join('products', 'transactions.id_product', '=', 'products.id')
        // ->where('transactions.id_product', $id)
        // ->where('products.status', 1)
        // ->select('products.harga_satuan')
        // ->distinct('products.harga_satuan')
        // ->first();

        $harga = Product::where('id', $id)
        ->select('harga_satuan')
        ->distinct('harga_satuan')
        ->first();
        // dd($harga);
        
        if($id) {
            if($noPesan) {
                if($nama) {
                    if($jumlah) {
                        if($tanggal) {
                        }
                        $product_choose = Product::where('id', $id)
                        ->select('id','nama_produk')
                        ->distinct('id','nama_produk')
                        ->first();
            
                        $noPesan = $request->noPesan;
                        $nama = $request->nama;
                        $jumlah = $request->jumlah;
                        $tanggal = $request->tglPemesanan;
            
                        $products = NULL;
                        $total = $request->jumlah * $harga->harga_satuan;

                        // Notification Toastr
                        $notification = array(
                            'message' => 'Add Product Successfully!',
                            'alert-type' => 'success'
                        );

                        return redirect()->route('total', compact('product_choose','products','total','noPesan','nama','jumlah','tanggal'))->with($notification);
                        }
                    }
                }
        }

        

        // dd($harga);
        

        // Transaction::insert([
        //     'id_product' => $request->id,
        //     'no_pemesanan' => $request->noPesan,
        //     'nama_pelanggan' => $request->nama,
        //     'jumlah' => $request->jumlah,
        //     'tanggal_pemesanan' => $request->tglPemesanan,
        //     'harga_total' => $total,
        //     'created_at' => Carbon::now(),
        // ]);

        
    }

    public function totalStore(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'id' => 'required',
            'nama' => 'required',
            'jumlah' => 'required',
            'tglPemesanan' => 'required',
        ],[
            'nama.required' => 'Nama Produk harus di isi',
            'jumlah.required' => 'Jumlah Produk harus di isi',
            'tglPemesanan.required' => 'Tanggal harus di isi',
        ]);

        if($validator->fails()) {
            return $this->showMessage('fail',$validator->errors()->first());
        }

        $id = $request->id;
        $noPesan = $request->noPesan;
        $nama = $request->nama;
        $jumlah = $request->jumlah;
        $tanggal = $request->tglPemesanan;
        $total = $request->total;

        $harga = Product::where('id', $id)
        ->select('harga_satuan')
        ->distinct('harga_satuan')
        ->first();

        Transaction::insert([
            'id_product' => $request->id,
            'no_pemesanan' => $noPesan,
            'nama_pelanggan' => $nama,
            'jumlah' => $jumlah,
            'tanggal_pemesanan' => $tanggal,
            'harga_total' => $total,
            'created_at' => Carbon::now(),
        ]);

        // Notification Toastr
        $notification = array(
            'message' => 'Buy Products Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('home')->with($notification);

    }

}