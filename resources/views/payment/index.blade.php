@extends('layouts_admin.admin')

@push('css')
<style>
    #myTable td {text-align: center; vertical-align: middle;}
    .filter-container {
        margin-bottom: 20px;
        display: flex;
        justify-content: flex-end;  /* Memastikan filter berada di kanan */
        width: 100%;  /* Pastikan lebar wadah filter mencakup 100% */
        padding-right: 10px;  /* Memberikan sedikit jarak dari kanan */
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
          <h1>Daftar Pembayaran</h1>
        </div>

        <div class="section-body">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Daftar Pembayaran 
                </div>
                <div class="card-body">
                    <!-- Filter Dropdown, diposisikan di kanan -->
                    <select id="statusFilter" class="form-control" style="width: 200px;">
                        <option value="" disabled selected>-- Pilih Status --</option>
                        <option value="1">Proses</option>
                        <option value="0">Lunas</option>
                        <option value="-1">Ditolak</option>
                    </select>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" style="text-align: center;" id="myTable">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Nama - Kode</th>
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
                                    <td style="text-align: center; vertical-align: middle;">{{$d->kode}}</td>
                                    <td><img src="{{ asset('foto/'.$d->foto) }}" height="80px" style="cursor: pointer;" data-toggle="modal"></td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        @if($d->status == 1)
                                        <!-- Tombol Edit (Centang) -->
                                        <a href="#" class="btn btn-icon btn-success" onclick="showConfirmationModal('edit', {{ $d->id }})">
                                            <i class="fas fa-check"></i>
                                        </a>

                                        <!-- Tombol Delete (Silang) -->
                                        <button type="button" class="btn btn-icon btn-danger" onclick="showConfirmationModal('delete', {{ $d->id }})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        @endif
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

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 70%; margin: auto;">
        <div class="modal-content" style="height: auto; display: flex; justify-content: center; align-items: center;">
            <div class="modal-body text-center" style="padding: 0;">
                <img id="modalImage" src="" style="max-width: 100%; max-height: 60vh; object-fit: contain; border-radius: 8px;">
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Aksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin melanjutkan aksi ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmActionBtn">Yes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sukses -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Aksi Berhasil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Status pembayaran berhasil diubah.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Terjadi Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Terjadi kesalahan dalam mengubah status pembayaran.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>



@endsection

@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi DataTable
    const table = $('#myTable').DataTable({
        language: {
            emptyTable: "Tidak ada data yang tersedia di tabel",
        }
    });

    const statusFilter = document.getElementById('statusFilter');
    statusFilter.addEventListener('change', function () {
        const selectedStatus = this.value;
        filterTableData(selectedStatus);
    });

    function filterTableData(status) {
        $.ajax({
            url: '/filter-payments', // Endpoint filter
            type: 'GET',
            data: { status: status },
            success: function (response) {
                table.clear(); // Hapus semua data sebelumnya di tabel
                if (response.data && response.data.length > 0) {
                    response.data.forEach(item => {
                        table.row.add([
                            item.id,
                            item.kode,
                            `<img src="/foto/${item.foto}" height="80px" style="cursor: pointer;" data-toggle="modal">`,
                            item.status === 1
                                ? `<a href="#" class="btn btn-success" onclick="showConfirmationModal('edit', ${item.id})"><i class="fas fa-check"></i></a>
                                   <button class="btn btn-danger" onclick="showConfirmationModal('delete', ${item.id})"><i class="fas fa-times"></i></button>`
                                : ''
                        ]);
                    });
                }
                table.draw(); // Render ulang tabel
            },
            error: function () {
                console.error('Terjadi kesalahan saat memuat data.');
            }
        });
    }

        // Fungsi untuk memperbarui tabel dengan data baru
        function updateTable(data) {
            const tableBody = document.querySelector('#myTable tbody');
            tableBody.innerHTML = ''; // Kosongkan isi tabel sebelumnya

            let rowNumber = 1;
            data.forEach(item => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${rowNumber++}</td>
                    <td>${item.kode}</td>
                    <td>
                        <img src="/foto/${item.foto}" height="80px" style="cursor: pointer;" data-toggle="modal">
                    </td>
                    <td>
                        ${item.status === 1 ? `
                            <a href="#" class="btn btn-icon btn-success" onclick="showConfirmationModal('edit', ${item.id})">
                                <i class="fas fa-check"></i>
                            </a>
                            <button type="button" class="btn btn-icon btn-danger" onclick="showConfirmationModal('delete', ${item.id})">
                                <i class="fas fa-times"></i>
                            </button>
                        ` : ''}
                    </td>
                `;

                tableBody.appendChild(row);
            });
        }

        // Event listener untuk gambar agar bisa membuka modal gambar
        document.querySelectorAll('img[data-toggle="modal"]').forEach(img => {
            img.addEventListener('click', function () {
                const modalImage = document.getElementById('modalImage');
                modalImage.src = this.src;
                const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
                imageModal.show();
            });
        });
    });

    let actionType = '';
    let targetId = null;

    // Fungsi untuk menampilkan modal konfirmasi
    function showConfirmationModal(action, id) {
        actionType = action;
        targetId = id;
        $('#confirmationModal').modal('show');
    }

    // Menangani aksi Yes pada modal konfirmasi
    document.getElementById('confirmActionBtn').addEventListener('click', function () {
        if (actionType === 'edit') {
            // Proses Edit (Misalnya, update status menjadi 0)
            updateStatus(targetId, 0);  // Mengubah status menjadi 0 (contoh untuk centang)
        } else if (actionType === 'delete') {
            // Proses Delete (Misalnya, update status menjadi -1)
            updateStatus(targetId, -1);  // Mengubah status menjadi -1 (contoh untuk silang)
        }
    });

    // Fungsi untuk mengupdate status menggunakan AJAX
    function updateStatus(id, status) {
        $.ajax({
            url: '/payment/' + id,  // Ganti dengan URL yang sesuai
            type: 'POST',  // Menggunakan POST karena form HTML tidak mendukung PUT
            data: {
                _method: 'PUT',  // Override untuk PUT
                _token: '{{ csrf_token() }}',  // Token CSRF untuk keamanan
                status: status  // Mengirim status yang baru
            },
            success: function (response) {
                console.log('Status berhasil diubah');
                $('#confirmationModal').modal('hide'); // Menutup modal konfirmasi
                showSuccessModal();  // Menampilkan modal sukses

                // Reload halaman setelah sukses
                setTimeout(function () {
                    location.reload(); // Refresh halaman setelah beberapa detik
                }, 1000); // Waktu tunggu 1 detik sebelum reload (opsional)
            },
            error: function (error) {
                console.error('Terjadi kesalahan', error);
                $('#confirmationModal').modal('hide'); // Menutup modal konfirmasi
                showErrorModal();  // Menampilkan modal error
            }
        });
    }

    // Menampilkan modal sukses
    function showSuccessModal() {
        $('#successModal').modal('show');
    }

    // Menampilkan modal error
    function showErrorModal() {
        $('#errorModal').modal('show');
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('img[data-toggle="modal"]').forEach(img => {
            img.addEventListener('click', function () {
                const modalImage = document.getElementById('modalImage');
                modalImage.src = this.src;
                const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
                imageModal.show();
            });
        });
    });


</script>

@endsection