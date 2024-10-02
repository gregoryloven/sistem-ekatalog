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
                                            <tbody id="productTable">
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
        const productTable = document.getElementById('productTable');
        const addRowButton = document.getElementById('addrow');
        const purchaseForm = document.getElementById('purchaseForm');
        let products = []; // Inisialisasi array produk kosong

        // Fungsi untuk mengambil data produk dari API
        async function fetchProducts() {
            try {
                const response = await fetch('/purchase-request/cariProduk'); // Sesuaikan endpoint jika perlu
                const data = await response.json();
                products = data; // Simpan produk yang diterima
            } catch (error) {
                console.error('Gagal mengambil data produk:', error);
            }
        }

        // Fungsi untuk menambahkan baris produk ke tabel
        function addProductRow() {
            const row = document.createElement('tr');

            // Dropdown produk
            const productDropdown = document.createElement('select');
            productDropdown.classList.add('form-control');
            productDropdown.style.width = '100%'; // Set lebar yang proporsional

            // Tambahkan opsi produk ke dalam dropdown
            if (products.length === 0) {
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'Produk tidak tersedia';
                option.disabled = true; // Nonaktifkan opsi
                productDropdown.appendChild(option);
            } else {
                products.forEach(product => {
                    const option = document.createElement('option');
                    option.value = product.id; // Sesuaikan dengan key produk di database
                    option.textContent = product.nama; // Sesuaikan dengan nama produk
                    productDropdown.appendChild(option);
                });
            }


            // Input jumlah
            const productQuantity = document.createElement('input');
            productQuantity.type = 'number';
            productQuantity.classList.add('form-control');
            productQuantity.style.width = '100%'; // Set lebar yang proporsional
            productQuantity.min = 1;
            productQuantity.value = 1;

            // Tombol hapus
            const removeButton = document.createElement('button');
            removeButton.classList.add('btn', 'btn-danger');
            removeButton.classList.add('btn', 'btn-hapus');
            removeButton.textContent = 'Hapus';
            removeButton.onclick = function() {
                productTable.removeChild(row);
            };

            // Menambahkan elemen-elemen ke dalam baris
            const tdProduct = document.createElement('td');
            const tdQuantity = document.createElement('td');
            const tdAction = document.createElement('td');

            tdAction.style.textAlign = 'center';

            tdProduct.appendChild(productDropdown);
            tdQuantity.appendChild(productQuantity);
            tdAction.appendChild(removeButton);

            row.appendChild(tdProduct);
            row.appendChild(tdQuantity);
            row.appendChild(tdAction);

            // Menambahkan baris ke tabel
            productTable.appendChild(row);

            addHiddenInputToForm(productDropdown, productQuantity);
        }

        // Fungsi untuk menambahkan input tersembunyi ke dalam form
        function addHiddenInputToForm(productDropdown, productQuantity) {
            // Buat input tersembunyi untuk produk
            const productInput = document.createElement('input');
            productInput.type = 'hidden';
            productInput.name = 'products[]'; // Input array untuk produk
            productInput.value = productDropdown.value; // ID produk yang dipilih

            // Buat input tersembunyi untuk jumlah produk
            const quantityInput = document.createElement('input');
            quantityInput.type = 'hidden';
            quantityInput.name = 'quantities[]'; // Input array untuk jumlah
            quantityInput.value = productQuantity.value; // Jumlah produk yang dipilih

            // Tambahkan input tersembunyi ke dalam form
            purchaseForm.appendChild(productInput);
            purchaseForm.appendChild(quantityInput);
        }

        // Event listener untuk tombol "Tambah Produk"
        addRowButton.addEventListener('click', addProductRow);

        function redirectToWhatsApp() {
            const namaPenerima = '{{ session('data.nama_penerima') }}';
            const noHp = '{{ session('data.no_telp_penerima') }}';
            const alamatPenerima = '{{ session('data.alamat_penerima') }}';
            const products = @json(session('data.products')); // Ambil dari sesi
            const quantities = @json(session('data.quantities')); // Ambil dari sesi

            const message = `Halo Kak,\n` +
                `**Nama Penerima:** ${namaPenerima}\n` +
                `**No HP:** ${noHp}\n` +
                `**Alamat Penerima:** ${alamatPenerima}\n\n` +
                `**Nama Produk:**\n` +
                products.map((nama, i) => `${i + 1}. ${nama} (${quantities[i]} pcs)`).join('\n');

            const encodedMessage = encodeURIComponent(message);
            const whatsappNumber = '6282236639255';
            const whatsappUrl = `https://api.whatsapp.com/send?phone=${whatsappNumber}&text=${encodedMessage}`;
            window.location.href = whatsappUrl;
        }



        // Panggil fungsi untuk fetch produk saat halaman dimuat
        document.addEventListener('DOMContentLoaded', fetchProducts);
    </script>
@endsection
