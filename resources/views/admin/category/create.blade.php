@extends('layout.header')

@section('content')

<!-- Topbar -->
@include('layout.topbar')
<!-- End of Topbar -->
<div class="col-lg-6" style="align-self: center">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Product Category Detail</h6>
        </div>
        <div class="card-body">
            <form class="user myForm" method="post" action="{{ route('storeCategory') }}" enctype="multipart/form-data">
                @csrf()
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="namaKategori" class="form-control form-control-user"
                            id="namaKategori"
                            placeholder="Nama Produk">
                    </div>
                    <button type="submit" id="submitForm" class="btn btn-primary btn-user btn-block">
                        Add Kategori
                    </button>
            </form>
        </div>
    </div>
</div>


@endsection

