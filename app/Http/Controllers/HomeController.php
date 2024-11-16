<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Product::all();
        
        $data->each(function ($item) {
            $item->formatted_description = $this->formatDescription($item->deskripsi);
        });
        
        return view('home.index', compact('data'));
    }

    // private function formatDescription($text)
    // {
    //     // Tambahkan newline sebelum setiap angka diikuti titik
    //     return preg_replace('/(\d+\.)/', '<br><strong>$1</strong>', $text);
    // }

    private function formatDescription($text)
    {
        // Menambahkan <br> sebelum angka yang diikuti dengan titik
        $text = preg_replace('/(\d+\.)/', '<br><strong>$1</strong>', $text);

        // Menambahkan <br> untuk tanda minus (-) di awal kalimat tanpa mengubah menjadi <li>
        $text = preg_replace('/\s*-\s*/', '<br>- ', $text);

        return $text;
    }

}
