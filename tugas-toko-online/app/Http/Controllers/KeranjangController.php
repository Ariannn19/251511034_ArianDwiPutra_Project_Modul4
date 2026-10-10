<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function tambah($id)
    {
        $product = Product::where('id_barang', $id)->firstOrFail();

        if ($product->stok <= 0) {
            return back()->with('error', 'Stok barang habis!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] < $product->stok) {
                $cart[$id]['quantity']++;
            } else {
                return back()->with('error', 'Jumlah melebihi stok!');
            }
        } else {
            $cart[$id] = [
                "id_barang" => $product->id_barang,
                "nama_barang" => $product->nama_barang,
                "harga" => $product->harga,
                "gambar" => $product->gambar,
                "quantity" => 1,
                "stok" => $product->stok
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('toko.index')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function kurang($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }
        return redirect()->route('toko.index');
    }

    public function hapus($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('toko.index');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('toko.index')->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();
        try {
            $totalHarga = 0;
            foreach ($cart as $item) {
                $totalHarga += $item['harga'] * $item['quantity'];
            }

            $idOrder = 'ORD-' . rand(1, 9999);

            Order::create([
                'id_order' => $idOrder,
                'id_user' => Auth::user()->id_user,
                'tanggal_order' => now(),
                'total_harga' => $totalHarga,
                'alamat_pengiriman' => Auth::user()->alamat ?? '-',
            ]);

            foreach ($cart as $id => $item) {
                $product = Product::where('id_barang', $id)->lockForUpdate()->first();

                if ($product->stok < $item['quantity']) {
                    throw new \Exception("Stok {$product->nama_barang} tidak cukup.");
                }

                OrderDetail::create([
                    'id_order' => $idOrder,
                    'id_barang' => $item['id_barang'],
                    'harga_satuan' => $item['harga'],
                    'jumlah_beli' => $item['quantity'],
                ]);

                $product->stok -= $item['quantity'];
                $product->save();
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('riwayat')->with('success', 'Checkout berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('toko.index')->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }

    public function riwayat()
    {
        $orders = Order::where('id_user', Auth::user()->id_user)
            ->with('details.product')
            ->orderBy('tanggal_order', 'desc')
            ->get();

        return view('riwayat', compact('orders'));
    }
}
