@extends('layouts_enduser.index')

<style>
    .btn-hapus {
        background-color: red !important;
    }
</style>

@section('content')
    <section class="py-9 overflow-hidden text-center" data-zanim-timeline="{}" data-zanim-trigger="scroll">
        <div class="bg-holder overlay overlay-1" style="background-image:url(../assets/img/elements_header.jpg);"
            data-parallax="data-parallax"></div>
        <!--/.bg-holder-->
        <div class="container">
            <div class="overflow-hidden">
                <h1 class="fs-5 fs-sm-6 text-white mb-3" data-zanim-xs='{"delay":0}'>Formulir Pemesanan</h1>
            </div>
            <div class="overflow-hidden">
                <p class="fs-2 fw-light ls text-400 text-uppercase" data-zanim-xs='{"delay":0.1}'>We're Here for You</p>
            </div>
        </div>
    </section>

    <section class="bg-100">
        <div class="container">
            <div class="row align-items-stretch justify-content-center">
                <div class="col-12">
                    <div class="card rounded-0">
                        <div class="card-body p-5">
                            @if (session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                                <a id="whatsappButton" class="btn btn-success mt-3" href="#"
                                    onclick="redirectToWhatsApp()">Kirim ke WhatsApp</a>
                            @endif
                            <br><br>
                            <h4>Formulir Pemesanan</h4>
                            <form id="purchaseForm" action="{{ url('purchase-request') }}" method="POST" class="mt-3">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <input class="form-control bg-white" type="text" name="nama_penerima"
                                            placeholder="Nama Penerima" required="required" />
                                    </div>
                                    <div class="col-12 mt-4">
                                        <input class="form-control bg-white" type="text" name="no_telp_penerima"
                                            placeholder="No HP" required="required" />
                                    </div>
                                    <div class="col-12 mt-4">
                                        <textarea class="form-control bg-white" rows="5" name="alamat_penerima" placeholder="Alamat Penerima"
                                            required="required"></textarea>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <table id="productTable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Produk</th>
                                                    <th style="text-align: center; vertical-align: middle;">Jumlah</th>
                                                    <th style="text-align: center; vertical-align: middle;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="productTableBody">
                                                <!-- Produk akan ditambahkan di sini -->
                                            </tbody>
                                        </table>

                                        <!-- Tombol Tambah Produk -->
                                        <a id="addrow" class="btn"
                                            style="margin: 7px 0px; padding: 5px 10px; background-color: #007bff; color: white; font-size: 10px;">
                                            <i class="fa fa-plus"></i> Tambah Produk
                                        </a>
                                    </div>
                                    <div class="col-12 mt-4 d-flex justify-content-end"><button class="btn btn-primary"
                                            type="Submit"> <span class="text-white fw-semi-bold">Pesan</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->
    </section>
@endsection

@section('javascript')
<script>
    document.getElementById('addrow').addEventListener('click', function() {
        // Ambil data produk dari server
        fetch('/purchase-request/cariProduk')
            .then(response => response.json())
            .then(data => {
                const productOptions = data.map(product => `<option value="${product.id}">${product.nama}</option>`).join('');

                // Tambahkan baris baru ke tabel
                const tableBody = document.getElementById('productTableBody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>
                        <select class="form-control" name="produk[]" required>
                            <option value="">Pilih Produk</option>
                            ${productOptions}
                        </select>
                    </td>
                    <td style="text-align: center;">
                        <input type="number" name="jumlah[]" class="form-control" style="width: 80px; margin: 0 auto;" min="1" required>
                    </td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button>
                    </td>
                `;

                tableBody.appendChild(newRow);

                // Tambahkan event listener untuk tombol hapus
                newRow.querySelector('.remove-row').addEventListener('click', function() {
                    newRow.remove();
                });
            })
            .catch(error => console.error('Error fetching products:', error));
    });

    function redirectToWhatsApp() {
        const namaPenerima = '{{ session('data.nama_penerima') }}';
        const noHp = '{{ session('data.no_telp_penerima') }}';
        const alamatPenerima = '{{ session('data.alamat_penerima') }}';
        const products = @json(session('data.products')); // Ambil dari sesi
        const quantities = @json(session('data.quantities')); // Ambil dari sesi

        const message = `Halo Kak,
    ` +
            `*Nama Penerima:* ${namaPenerima}
    ` +
            `*No HP:* ${noHp}
    ` +
            `*Alamat Penerima:* ${alamatPenerima}

    ` +
            `*Nama Produk:*
    ` +
            products.map((nama, i) => `${i + 1}. ${nama} (${quantities[i]} pcs)`).join('\n');

        const encodedMessage = encodeURIComponent(message);
        const whatsappNumber = '6282132465830';
        const whatsappUrl = `https://api.whatsapp.com/send?phone=${whatsappNumber}&text=${encodedMessage}`;
        window.location.href = whatsappUrl;
    }

</script>
@endsection
