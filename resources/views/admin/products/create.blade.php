@extends('layout.header')

@section('content')

<!-- Topbar -->
@include('layout.topbar')
<!-- End of Topbar -->
<div class="col-lg-6" style="align-self: center">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Product Detail</h6>
        </div>
        <div class="card-body">
            <form class="user myForm" method="post" action="{{ route('storeProduct') }}" enctype="multipart/form-data">
                @csrf()
                <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Nama Produk</label>
                            <input type="text" name="namaProduk" class="form-control form-control-user"
                                id="namaProduk"
                                placeholder="Nama Produk">
                        </div>
                        <div class="form-group">
                            <label for="">Kode Produk</label>
                            <input type="text" name="kodeProduk" class="form-control form-control-user"
                                id="kodeProduk"
                                placeholder="Kode Produk">
                        </div>
                        <div class="form-group">
                            <label for="">Harga Satuan</label>
                            <input type="text" name="hargaSatuan" class="form-control form-control-user"
                                id="hargaSatuan"
                                placeholder="Harga Satuan">
                        </div>
                        <div class="form-group">
                            <label for="">Ukuran</label>
                            <select data-placeholder="Pilih Ukuran" name="ukuran" id="ukuran" class="form-control">
                                <option value="" selected disabled>Pilih Ukuran</option> 
                                @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                @endforeach                   
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select data-placeholder="Pilih Kategori" name="kategori" id="kategori" class="form-control">
                                <option value="" selected disabled>Pilih Kategori</option>                    
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select data-placeholder="Status" name="status" id="status" class="form-control">
                                <option value="" selected disabled>Pilih Status</option>                    
                                <option value="1">Publish</option>
                                <option value="0">Not Publish</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Expired Date</label>
                            <input type="date" name="expDate" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nama Suplier</label>
                            <input type="text" name="namaSupplier" class="form-control">
                        </div>
                    </div>
                    <button type="submit" id="submitForm" class="btn btn-primary btn-user btn-block">
                        Add Produk
                    </button>
            </form>
        </div>
    </div>
</div>

<script>

    function myFunction() {

        var x = document.getElementById("namaSupplier");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }

    }


</script>




@endsection

