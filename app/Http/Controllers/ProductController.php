<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseRequestDetail;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();
        return view('product.index', compact('data'));
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
        $data = new Product();
        $data->nama = $request->nama;
        $data->harga = str_replace('.', '', $request->harga);
        $data->deskripsi = $request->deskripsi;
        
        $file=$request->file('foto');
        $imgFolder = 'foto/';
        $extension = $request->file('foto')->extension();
        $imgFile=time()."_".$request->get('nama').".".$extension;
        $file->move($imgFolder,$imgFile);
        $data->foto=$imgFile;

        $data->save();

        return redirect()->route('product.index')->withToastSuccess('Data produk berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->nama = $request->nama;
        $product->harga = str_replace('.', '', $request->harga);
        $product->deskripsi = $request->deskripsi;
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $imgFolder = 'foto/';
            $extension = $file->extension();
            $imgFile = time() . "_" . $request->get('nama') . "." . $extension;
            $file->move($imgFolder, $imgFile);
    
            $oldFilePath = $imgFolder . $product->foto;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
    
            $product->foto = $imgFile;
        }

        $product->save();

        return redirect()->route('product.index')->withToastSuccess('Data produk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // try {
        //     $imgFolder = 'foto/';
        //     $filePath = $imgFolder . $product->foto;

        //     if (file_exists($filePath)) {
        //         unlink($filePath);
        //     }
        //     $product->delete();
            
        //     return redirect()->route('product.index')->withToastSuccess('Data produk berhasil dihapus');
        // } catch (\Exception $e) {
        //     return redirect()->route('product.index')->withToastError('Data produk gagal dihapus karena digunakan pada data lain');
        // }

        $imgFolder = 'foto/';
        $filePath = $imgFolder . $product->foto;

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $prdetails = PurchaseRequestDetail::where('product_id', $product->id)->get();

        foreach ($prdetails as $prd) {
            // Menghapus PurchaseRequestDetail
            $prd->delete();

            // Menghapus PurchaseRequest terkait jika tidak ada lagi PurchaseRequestDetail yang terkait
            $purchase = PurchaseRequest::find($prd->purchase_id);

            // Pastikan purchase_request memiliki purchase_request_details lain yang tidak terkait dengan produk ini
            if ($purchase && $purchase->purchaseRequestDetails->isEmpty()) {
                $purchase->delete();
            }
        }

        $product->delete();
        
        return redirect()->route('product.index')->withToastSuccess('Data produk berhasil dihapus');
    }

    public function EditForm(Request $request)
    {
        $id = $request->get("id");
        $data = Product::find($id);

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('product.EditForm',compact('data'))->render()),200);
    }
}
