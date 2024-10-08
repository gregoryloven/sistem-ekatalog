<?php

namespace App\Http\Controllers;

use session;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestDetail;

class PurchaseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PurchaseRequest::all();
        return view('home.purchase', compact('data'));
    }

    public function cariProduk()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productIds = $request->input('products');
        $quantities = $request->input('quantities');

        $today = Carbon::now()->format('Ymd');

        $lastOrder = PurchaseRequest::latest('id')->first();

        $lastOrderNumber = 0;

        if ($lastOrder) {
            // Ambil nomor urut dari no_pesanan terakhir, format "PR-XXX-YYYYMMDD"
            // Ini asumsinya no_pesanan berbentuk PR-XXX-YYYYMMDD, jadi kita ambil bagian XXX
            $lastOrderNumber = (int) substr($lastOrder->no_pesanan, 3, 3); // Ambil bagian XXX
        }

        // Tambah 1 untuk nomor urut yang baru
        $newOrderNumber = str_pad($lastOrderNumber + 1, 3, '0', STR_PAD_LEFT);

        // Buat nomor pesanan baru dengan format PR-XXX-YYYYMMDD
        $noPesanan = 'PR-' . $newOrderNumber . '-' . $today;

        $purchaseRequest = PurchaseRequest::create([
            'no_pesanan' => $noPesanan,
            'nama_penerima' => $request->input('nama_penerima'),
            'no_telp_penerima' => $request->input('no_telp_penerima'),
            'alamat_penerima' => $request->input('alamat_penerima'),
            'status' => 1,
        ]);

        $purchaseId = $purchaseRequest->id;

        foreach ($productIds as $index => $productId) {
            $quantity = $quantities[$index];

            PurchaseRequestDetail::create([
                'purchase_id' => $purchaseId,
                'product_id' => $productId,
                'qty' => $quantity,
            ]);
        }

        $productsWithNames = [];
        foreach ($productIds as $productId) {
            $product = Product::find($productId);
            if ($product) {
                $productsWithNames[] = $product->nama; // Asumsi 'nama' adalah kolom nama produk
            }
        }

        // Store data in session for WhatsApp message
        session([
            'data' => [
                'nama_penerima' => $request->input('nama_penerima'),
                'no_telp_penerima' => $request->input('no_telp_penerima'),
                'alamat_penerima' => $request->input('alamat_penerima'),
                'products' => $productsWithNames,
                'quantities' => $quantities,
            ]
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat dengan nomor: ' . $noPesanan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequest $purchaseRequest)
    {
        //
    }
}
