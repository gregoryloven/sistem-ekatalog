@extends('layouts_admin.admin')

@push('css')
<style>
    #myTable td {text-align: center; vertical-align: middle;}
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
          <h1>Daftar Produk</h1>
        </div>

        <div class="section-body">
            <a href="#modalCreate" data-toggle='modal' class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Tambah Produk</a><br><br>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Daftar Produk 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="text-align: center;" id="myTable">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Stok (pcs)</th>
                                    <th>Harga</th>
                                    <th>Foto</th>
                                    <th width="20%"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </section>
</div>


@endsection

@section('javascript')
<script>

</script>
@endsection