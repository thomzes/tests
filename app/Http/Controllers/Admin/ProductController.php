<?php

namespace App\Http\Controllers\Admin;

use DB;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\Size;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
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

        $products = Product::join('product_size', 'products.id_product_size', '=', 'product_size.id')
        ->join('product_category', 'products.id_product_category', '=', 'product_category.id')
        // ->where('products.status', 1)
        ->select('products.nama_produk','products.kode_produk','products.harga_satuan','products.status','products.exp_date','product_size.size_name','product_category.nama_kategori','products.nama_supplier','products.id')
        ->distinct('products.nama_produk','products.kode_produk','products.harga_satuan','products.status','products.exp_date','product_size.size_name','product_category.nama_kategori','products.nama_supplier','products.id')
        ->get();

        return view('admin.products.view', compact('products'));
    }

    public function addProduct($slug)
    {
        if($slug != Session::get('name'))
        {
            Session::flush();
            return redirect()->route('login');
        }

        $sizes = Size::latest()->get();
        $categories = Category::latest()->get();

        return view('admin.products.create', compact('sizes','categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'namaProduk' => 'required',
            'kodeProduk' => 'required',
            'namaSupplier' => 'required',
            'hargaSatuan' => 'required',
            'ukuran' => 'required',
            'kategori' => 'required',
            'expDate' => 'required',
        ],[
            'namaProduk.required' => 'Nama Produk harus di isi',
            'kodeProduk.required' => 'Kode Produk harus di isi',
            'hargaSatuan.required' => 'Harga Satuan Produk harus di isi',
            'ukuran.required' => 'Ukuran harus di isi',
            'kategori.required' => 'Kategori harus di isi',
            'expDate.required' => 'Expired Date harus di isi',
            'namaSupplier.required' => 'Nama Supplier harus di isi',
        ]);

        if($validator->fails()) {
            return $this->showMessage('fail',$validator->errors()->first());
        }

        Product::insert([
            'nama_produk' => $request->namaProduk,
            'kode_produk' => $request->kodeProduk,
            'harga_satuan' => $request->hargaSatuan,
            'nama_supplier' => $request->namaSupplier,
            'id_product_size' => $request->ukuran,
            'id_product_category' => $request->kategori,
            'exp_date' => $request->expDate,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);

        // Notification Toastr
        $notification = array(
            'message' => 'Add Product Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('productView',[Session::get('name')])->with($notification);
    }

    public function editProduct($slug, $id)
    {
        if($slug != Session::get('name'))
        {
            Session::flush();
            return redirect()->route('login');
        }

        $sizes = Size::latest()->get();
        $categories = Category::latest()->get();
        $product = Product::findOrFail($id);

        return view('admin.products.edit', compact('product','sizes','categories'));
    }

    public function update(Request $request)
    {
        $product_id = $request->id;
        Product::findOrFail($product_id)->update([
            'nama_produk' => $request->namaProduk,
            'kode_produk' => $request->kodeProduk,
            'harga_satuan' => $request->hargaSatuan,
            'id_product_size' => $request->ukuran,
            'id_product_category' => $request->kategori,
            'exp_date' => $request->expDate,
            'status' => $request->status,
        ]);

        // Notification Toastr
        $notification = array(
            'message' => 'Product Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('productView',[Session::get('name')])->with($notification);
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();

        // Notification Toastr
        $notification = array(
            'message' => 'Product Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->route('productView',[Session::get('name')])->with($notification);
    }

    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);

        // Notification Toastr
        $notification = array(
            'message' => 'Product Inactive!',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);

    } //end method

    public function ProductActive($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);

         // Notification Toastr
         $notification = array(
            'message' => 'Product Active!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } //end method


}