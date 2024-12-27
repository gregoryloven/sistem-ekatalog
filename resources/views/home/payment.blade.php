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
                <h1 class="fs-5 fs-sm-6 text-white mb-3" data-zanim-xs='{"delay":0}'>Formulir Pembayaran</h1>
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
                            <h4>Formulir Pembayaran</h4>
                            <form id="payment" action="{{ url('payment') }}" method="POST" class="mt-3" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <label>Nama - Kode</label>
                                        <input class="form-control bg-white" type="text" name="kode"
                                            placeholder="Nama - kode (Bima - 200.001) " required="required" />
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label>Bukti Bayar</label>
                                        <input class="form-control bg-white" type="file" name="foto"
                                            placeholder="Bukti Pembayaran" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" required="required" />
                                            <img id="output" width="400px" height="350px" data-bs-toggle="modal" data-bs-target="#imageModal" style="cursor: pointer;">
                                    </div>
                                    <!-- Modal Bootstrap -->
                                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="max-width: 80%; margin: auto;">
                                            <div class="modal-content" style="height: 80vh; display: flex; justify-content: center; align-items: center;">
                                                <div class="modal-body text-center" style="padding: 0;">
                                                    <img id="modalImage" src="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 d-flex justify-content-end"><button class="btn btn-primary"
                                            type="Submit"> <span class="text-white fw-semi-bold">Upload</span></button>
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
        // Saat gambar di klik, set gambar di modal
        document.getElementById('output').addEventListener('click', function () {
            const modalImage = document.getElementById('modalImage');
            modalImage.src = this.src; // Sinkronkan gambar output ke modal
        });
    </script>

@endsection
