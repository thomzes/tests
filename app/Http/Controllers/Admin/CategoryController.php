<?php

namespace App\Http\Controllers\Admin;

use DB;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
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

        $categories = Category::orderBy('id', 'ASC')->get();

        return view('admin.category.view', compact('categories'));
    }

    public function addCategory($slug)
    {
        if($slug != Session::get('name'))
        {
            Session::flush();
            return redirect()->route('login');
        }

        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'namaKategori' => 'required',
        ],[
            'namaKategori.required' => 'Nama Kategori harus di isi',
        ]);

        if($validator->fails()) {
            return $this->showMessage('fail',$validator->errors()->first());
        }

        Category::insert([
                'nama_kategori' => $request->namaKategori,
                'created_at' => Carbon::now(),
        ]);

        // Notification Toastr
        $notification = array(
            'message' => 'Add Product Category Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('categoryView',[Session::get('name')])->with($notification);
    }

    public function editCategory($slug, $id)
    {
        if($slug != Session::get('name'))
        {
            Session::flush();
            return redirect()->route('login');
        }

        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request)
    {
        $category_id = $request->id;
        Category::findOrFail($category_id)->update([
            'nama_kategori' => $request->namaKategori,
        ]);

        // Notification Toastr
        $notification = array(
            'message' => 'Product Category Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('categoryView',[Session::get('name')])->with($notification);
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();

        // Notification Toastr
        $notification = array(
            'message' => 'Product Category Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->route('categoryView',[Session::get('name')])->with($notification);
    }


}