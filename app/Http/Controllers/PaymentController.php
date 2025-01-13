<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Payment::all();
        return view('payment.index', compact('data'));
    }

    public function filterPayments(Request $request)
    {
        // Ambil parameter 'status' dari request
        $status = $request->input('status');

        // Query data berdasarkan status
        $data = Payment::where('status', $status)->get();

        // Mengembalikan respons dalam format JSON
        return response()->json([
            'data' => $data
        ]);
    }

    public function indexUser()
    {
        return view('home.payment');
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
        $data = new Payment();
        $data->kode = $request->kode;
        $data->status = 1;
        
        $file=$request->file('foto');
        $imgFolder = 'foto/';
        $extension = $request->file('foto')->extension();
        $imgFile=time()."_".$request->get('nama').".".$extension;
        $file->move($imgFolder,$imgFile);
        $data->foto=$imgFile;

        $data->save();

        return redirect()->back()->with('success', 'Bukti Pembayaran berhasil diupload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);

        if ($payment) {
            // Perbarui status berdasarkan input dari AJAX
            $payment->status = $request->status;  // Status yang dikirimkan dari frontend
            $payment->save();  // Simpan perubahan

            // Mengembalikan respon sukses
            return response()->json(['status' => 'success']);
        }

        // Mengembalikan respon error jika pembayaran tidak ditemukan
        return response()->json(['status' => 'error'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
