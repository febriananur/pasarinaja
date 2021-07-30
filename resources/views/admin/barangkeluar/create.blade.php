@extends('layouts.app', ['title' => 'Tambah Barang Keluar'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-shopping-bag"></i> TAMBAH BARANG KELUAR</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>NAMA PRODUK</label>
                            <select name="namabbarang" id="namabarang" class="form-control" style="width:300px;">
                                <?php foreach($barang as $c) : ?>
                                    <option value="<?= $c['id']; ?>"><?= $c['content']; ?></option>
                                <?php endforeach; ?>      
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                                        value="{{ old('stok') }}" placeholder="unit">

                                    @error('stok')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>HARGA</label>
                                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" placeholder="Harga Produk">

                                    @error('price')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    let dataBarang = document.getElementById('namabarang').innerHTML;

    console.log(dataBarang);


    var editor_config = {
        selector: "textarea.content",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
    };

    tinymce.init(editor_config);
</script>
@endsection