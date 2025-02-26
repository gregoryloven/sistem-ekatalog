<?php

namespace App\Http\Controllers;

use session;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestDetail;
use Auth;

class PurchaseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = PurchaseRequest::all();
        // return view('home.purchase', compact('data'));

        $data = PurchaseRequest::orderBy('id', 'desc')->get();
        $auth = Auth::user();

        if($auth) {
            return view('purchase.index', compact('data'));
        } else {
            return view('home.purchase');
        }
    }

    public function cariProduk()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function konfirmasiPembayaran($id)
    {
        $order = PurchaseRequest::findOrFail($id);
        $order->status = 0; // 0 = Lunas
        $order->save();
    
        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

        public function tolakPembayaran($id)
    {
        $order = PurchaseRequest::findOrFail($id);
        $order->status = -1; // -1 = Ditolak
        $order->save();

        return redirect()->back()->with('error', 'Pembayaran telah ditolak.');
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
        $purchaseId = $request->input('purchase_id'); // Pastikan ID pembelian sudah tersedia
        $productIds = $request->input('produk'); // Array ID produk
        $quantities = $request->input('jumlah'); // Array jumlah produk

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

        if (!$productIds || !$quantities) {
            return back()->with('error', 'Produk dan jumlah harus diisi.');
        }
    
        foreach ($productIds as $index => $productId) {
            $quantity = $quantities[$index];
    
            if ($productId && $quantity > 0) {
                // Simpan detail ke database
                PurchaseRequestDetail::create([
                    'purchase_id' => $purchaseId,
                    'product_id' => $productId,
                    'qty' => $quantity,
                ]);
            }
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

        // dd($request->all());

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat dengan nomor: ' . $noPesanan);
    }

    public function showPurchaseDetails($purchaseId)
    {
        $details = PurchaseRequestDetail::where('purchase_id', $purchaseId)->get();

        foreach ($details as $detail) {
            $detail->product_name = Product::find($detail->product_id)->nama ?? 'Nama Produk Tidak Ditemukan';
        }

        return response()->json($details); // Pastikan mengembalikan JSON array
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
