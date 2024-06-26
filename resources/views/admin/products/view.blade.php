@extends('layout.header')

@section('content')
    
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        @include('layout.topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Manage Product</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-2 font-weight-bold text-primary">Product Detail</h6>
                    <a href="{{ route('addProduct',[Session::get('name')]) }}" class="btn btn-primary" title="Add Product"><i class="fa fa-plus"></i> Add Product</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Kode Produk</th>
                                    <th>Nama Supplier</th>
                                    <th>Harga Satuan</th>
                                    <th>Ukuran</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Expired Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td>{{ $item->kode_produk }}</td>
                                        <td>{{ $item->nama_supplier }}</td>
                                        <td>{{ $item->harga_satuan }}</td>
                                        <td>{{ $item->size_name }}</td>
                                        <td>{{ $item->nama_kategori }}</td>
                                        <td>@if ($item->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">In Active</span>
                                        @endif</td>
                                        <td>{{ $item->exp_date }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <a href="{{ route('product.inactive',$item->id) }}" class="btn btn-danger" title="Inactive Now"><i class="fa fa-arrow-down"></i>In Active</a>
                                            @else
                                                <a href="{{ route('product.active',$item->id) }}" class="btn btn-success" title="Active Now"><i class="fa fa-arrow-up"></i>Active</a>
                                            @endif
                                            <a href="{{ route('editProduct',[Session::get('name'),$item->id]) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('deleteProduct',$item->id) }}" class="btn btn-danger" id="delete" id="Delete Data"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>



@endsection