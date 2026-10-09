<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $daftarBarang = Barang::all();

        $cart = session()->get('cart', []);

        $itemsKeranjang = [];
        $totalHarga = 0;

        if (!empty($cart)) {
            $barangs = Barang::whereIn('id', array_keys($cart))->get();

            foreach ($barangs as $b) {
                $jumlah = $cart[$b->id];
                $subtotal = $b->harga * $jumlah;
                $totalHarga += $subtotal;

                $itemsKeranjang[] = [
                    'id' => $b->id,
                    'nama' => $b->nama,
                    'harga' => $b->harga,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('keranjang', compact('daftarBarang', 'itemsKeranjang', 'totalHarga'));
    }

    // Tambah barang ke keranjang
    public function tambah($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke keranjang.');
    }

    // Tambah 1 jumlah barang (+)
    public function tambahQty($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]++;
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    // Kurang 1 jumlah barang (-)
    public function kurangQty($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]--;
            if ($cart[$id] <= 0) {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    public function hapus($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Barang dihapus dari keranjang.');
    }

    public function kosongkan()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Keranjang telah dikosongkan.');
    }
}
