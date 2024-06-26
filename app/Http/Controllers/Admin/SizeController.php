<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Session;
use Validator;

class SizeController extends Controller
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

        $sizes = Size::orderBy('id', 'ASC')->get();

        return view('admin.size.view', compact('sizes'));
    }

    public function addSize($slug)
    {
        if($slug != Session::get('name'))
        {
            Session::flush();
            return redirect()->route('login');
        }

        return view('admin.size.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'namaUkuran' => 'required',
        ],[
            'namaUkuran.required' => 'Ukuran harus di isi',
        ]);

        if($validator->fails()) {
            return $this->showMessage('fail',$validator->errors()->first());
        }

        Size::insert([
                'size_name' => $request->namaUkuran,
                'created_at' => Carbon::now(),
        ]);

        // Notification Toastr
        $notification = array(
            'message' => 'Add Product Size Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('sizeView',[Session::get('name')])->with($notification);
    }

    public function editSize($slug, $id)
    {
        if($slug != Session::get('name'))
        {
            Session::flush();
            return redirect()->route('login');
        }

        $size = Size::findOrFail($id);

        return view('admin.size.edit', compact('size'));
    }

    public function update(Request $request)
    {
        $size_id = $request->id;
        Size::findOrFail($size_id)->update([
            'size_name' => $request->namaUkuran,
        ]);

        // Notification Toastr
        $notification = array(
            'message' => 'Product Size Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('sizeView',[Session::get('name')])->with($notification);
    }

    public function delete($id)
    {
        Size::findOrFail($id)->delete();

        // Notification Toastr
        $notification = array(
            'message' => 'Product Size Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->route('sizeView',[Session::get('name')])->with($notification);
    }



}