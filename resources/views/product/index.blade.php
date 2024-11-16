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
                                    <th>Nama</th>
                                    <th>Harga (Rp.)</th>
                                    <th>Deskripsi</th>
                                    <th>Foto</th>
                                    <th width="20%"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($data as $d)
                                @php $i += 1; @endphp
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;">@php echo $i; @endphp</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$d->nama}}</td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        @if(isset($d->harga))
                                            {{ number_format($d->harga, 0, ',', '.') }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">{{$d->deskripsi}}</td>
                                    <td><img src="{{asset('foto/'.$d->foto)}}" height='80px'/></td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <form id="delete-form-{{ $d->id }}" action="{{ route('product.destroy', $d->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#modalEdit" data-toggle="modal" class="btn btn-icon btn-warning" onclick="EditForm({{ $d->id }})"><i class="far fa-edit"></i></a>

                                            <input type="hidden" class="form-control" id='id' name='id' placeholder="Type your name" value="{{$d->id}}">
                                            <button type="button" class="btn btn-icon btn-danger" data-id="{{ $d->id }}"><i class="fa fa-trash"></i></button>                                   
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </section>
</div>

<!-- CREATE WITH MODAL -->
<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <form role="form" method="POST" action="{{ url('product') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Tambah Produk</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id='nama' name='nama' placeholder="Nama Produk" required>
                    </div>
                    <div class="form-group">
                        <label>Harga (Rp.)</label>
                        <input type="text" class="form-control input-harga" id='harga' name='harga' min=0 required>
                    </div> 
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" style="height: 200px;" placeholder="Deskripsi Produk" required></textarea>
                    </div>   
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" value="" name="foto" class="form-control" id="foto" placeholder="Foto" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" required>
                        <img id="output" width="200px" height="200px">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT WITH MODAL-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modalContent">
            <div style="text-align: center;">
                <!-- <img src="{{ asset('res/loading.gif') }}"> -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>

$(document).ready(function() {
    $(".input-harga").on("input", function() {
        let inputValue = $(this).val();

        inputValue = inputValue.replace(/[^0-9]/g, '');

        let formattedValue = formatNumber(inputValue);

        $(this).val(formattedValue);
    });

    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }
});

function EditForm(id)
{
  $.ajax({
    type:'POST',
    url:'{{route("product.EditForm")}}',
    data:{'_token':'<?php echo csrf_token() ?>',
          'id':id
         },
    success: function(data){
      $('#modalContent').html(data.msg)
    }
  });
}

$(document).on('click', '.btn-danger', function(e) {
    e.preventDefault();
    
    var id = $(this).data('id');
    
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#delete-form-' + id).submit();
        }
    });
});

</script>
@endsection