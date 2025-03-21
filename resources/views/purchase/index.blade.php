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
          <h1>Daftar Pemesanan</h1>
        </div>

        <div class="section-body">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Daftar Pemesanan 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="text-align: center;" id="myTable">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>No Pesanan</th>
                                    <th>Nama Penerima</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Status Pembayaran</th>
                                    <th width="20%"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($data as $d)
                                @php $i += 1; @endphp
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;">@php echo $i; @endphp</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$d->no_pesanan}}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$d->nama_penerima}}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$d->alamat_penerima}}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$d->no_telp_penerima}}</td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        {{ date('j F Y H:i:s', strtotime($d->created_at)) }}
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        @if($d->status == 1)
                                            <button type="button" class="btn btn-success" data-toggle="modal" 
                                                data-target="#konfirmasiModal" data-id="{{ $d->id }}" data-no_pesanan="{{ $d->no_pesanan }}">
                                                <i class="fas fa-check"></i> Konfirmasi
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" 
                                                data-target="#tolakModal" data-id="{{ $d->id }}" data-no_pesanan="{{ $d->no_pesanan }}">
                                                <i class="fas fa-times"></i> Tolak
                                            </button>
                                        @elseif($d->status == 0)
                                            <div class="alert alert-success">Lunas</div>
                                        @elseif($d->status == -1)
                                            <div class="alert alert-danger">Ditolak</div>
                                        @endif
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-id="{{ $d->id }}" data-no_pesanan="{{ $d->no_pesanan }}" data-target="#detailModal{{ $d->id }}">
                                            Detail
                                        </button>
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

<div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="konfirmasiForm" method="POST" action="{{ route('konfirmasi.pembayaran', ':id') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="order_id" name="order_id">
                    <p>Apakah Anda yakin ingin mengonfirmasi pembayaran untuk pesanan <strong id="order_no"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tolak Pembayaran -->
<div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tolakModalLabel">Tolak Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tolakForm" method="POST" action="{{ route('tolak.pembayaran', ':id') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="order_id_tolak" name="order_id">
                    <p>Apakah Anda yakin ingin menolak pembayaran untuk pesanan <strong id="order_no_tolak"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Pemesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="modalDetailBody">
                        <!-- Data akan dimasukkan melalui AJAX -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
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
    // document.querySelectorAll('.btn-info').forEach(button => {
    //     button.addEventListener('click', function () {
    //         var purchaseId = this.getAttribute('data-bs-target').replace('#detailModal', '');

    //         // Menampilkan modal saat tombol "Detail" diklik
    //         var modal = new bootstrap.Modal(document.getElementById('detailModal' + purchaseId));

    //         // Melakukan AJAX request untuk mengambil detail berdasarkan purchaseId
    //         fetch(`/purchase/${purchaseId}/details`)
    //             .then(response => response.json())
    //             .then(data => {
    //                 // Mengisi modal dengan data
    //                 var content = '<h6>Product Details:</h6><ul>';
    //                 data.forEach(item => {
    //                     content += `
    //                         <li>
    //                             <strong>Product:</strong> ${item.product_name}<br>
    //                             <strong>Quantity:</strong> ${item.qty}
    //                         </li>
    //                     `;
    //                 });
    //                 content += '</ul>';

    //                 // Menyisipkan konten ke dalam modal
    //                 document.getElementById('modal-body-content' + purchaseId).innerHTML = content;

    //                 // Menampilkan modal
    //                 modal.show();
    //             })
    //             .catch(error => console.error('Error fetching purchase details:', error));
    //     });
    // });

    // Konfirmasi Pembayaran
    $('#konfirmasiModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var noPesanan = button.data('no_pesanan');
        
        var modal = $(this);
        modal.find('#order_id').val(id);
        modal.find('#order_no').text(noPesanan);
        modal.find('#konfirmasiForm').attr('action', '{{ route("konfirmasi.pembayaran", "") }}/' + id);
    });

    // Tolak Pembayaran
    $('#tolakModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var noPesanan = button.data('no_pesanan');
        
        var modal = $(this);
        modal.find('#order_id_tolak').val(id);
        modal.find('#order_no_tolak').text(noPesanan);
        modal.find('#tolakForm').attr('action', '{{ route("tolak.pembayaran", "") }}/' + id);
    });

    $(document).ready(function() {
        $('.btn-info').click(function() {
            let purchaseId = $(this).data('id');
            let noPesanan = $(this).data('no_pesanan');

            $('#detailModalLabel').text(`Detail Pemesanan (${noPesanan})`);
            $('#modalDetailBody').empty();
            
            $.ajax({
                url: '/purchase-details/' + purchaseId,
                type: 'GET',
                success: function(response) {
                    console.log(response); // Tambahkan ini untuk melihat output response
                    
                    if (response.details && Array.isArray(response.details)) {
                        $('#modalDetailBody').empty(); // Hapus isi modal sebelumnya

                        // Menambahkan baris untuk detail produk
                        response.details.forEach(function(detail) {
                            $('#modalDetailBody').append(`
                                <tr>
                                    <td>${detail.product_name}</td>
                                    <td>${detail.harga}</td>
                                    <td>${detail.qty}</td>
                                    <td>${detail.subtotal}</td>
                                </tr>
                            `);
                        });

                        // Menambahkan baris untuk total
                        $('#modalDetailBody').append(`
                            <tr>
                                <td colspan="3"><strong>Total</strong></td>
                                <td><strong>${response.total}</strong></td>
                            </tr>
                        `);

                        $('#detailModal').modal('show');
                    } else {
                        alert('Data tidak valid atau tidak ditemukan.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat mengambil data.');
                }
            });

        });
    });


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

// $(document).on('click', '.btn-danger', function(e) {
//     e.preventDefault();
    
//     var id = $(this).data('id');
    
//     Swal.fire({
//         title: 'Apakah Anda Yakin?',
//         text: "Data akan dihapus!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#d33',
//         confirmButtonText: 'Hapus!'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $('#delete-form-' + id).submit();
//         }
//     });
// });

</script>
@endsection