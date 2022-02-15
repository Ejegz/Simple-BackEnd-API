<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Dflydev\DotAccessData\Data;

class OrderController extends BaseController
{
    public function __construct()
    {
        $this->middleware('authorization');
    }

    public function store()
    {
        // Cari data produk berdasarkan produk id
        $product = Product::find(\request('product_id'));

        if ($product == null) // Jika data produk tidak ditemukan
        {
            // Kembalikan nilai dengan format produk tidak ditemukan
            return $this->out(status: 'Gagal', code: 404, error: ['Data tidak ditemukan']);
        }

        $order = new Orders();
        $order->order_date = Carbon::now('Asia/Jakarta');
        $order->product_id = $product->id;
        $order->customer_id = \request('customer_id');
        $order->qty = \request('qty');
        $order->price = $product->price;

        if ($order->save()) //Jika order berhasil
        {
            return $this->out(data: $order, status: 'OK', code: 201);
        } else {
            return $this->out(status: 'Gagal', error: ['Order Gagal Disimpan'], code: 504);
        }
    }

    public function findAll()
    {
        $order = Orders::query()
            ->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
            ->leftJoin('products', 'products.id', '=', 'orders.product_id');

        if (request()->has('q')) //Jika ada query 'q' untuk mencari products.title
        {
            $q = request('q');
            $order->where('products.title', 'like', "%$q%");
        }

        $data = $order->paginate(
            10,
            [
                'orders.*',
                'customers.first_name',
                'customers.last_name', 'customers.address', 'customers.city',
                'products.title as product_title'
            ]
        );

        return $this->out(data: $data, status: 'OK');
    }

    public function findOne(Orders $order)
    {
        return $this->out(data: $order, status: 'OK');
    }

    public function update(Orders $order)
    {
        $product = Product::find(request('product_id'));

        // Cari data produk berdasarkan produk id
        if ($product == null) {
            return $this->out(status: 'Gagal', code: 404, error: ['Produk tidak ditemukan']);
        };

        $order->product_id = $product->id;
        $order->customer_id = \request('customer_id');
        $order->qty = \request('qty');
        $order->price = $product->price;

        $hasil = $order->save();

        return $this->out(
            status: $hasil ? 'OK' : 'Gagal',
            data: $hasil ? $order : null,
            error: $hasil ? null : ['gagal merubah data'],
            code: $hasil ? 201 : 504
        );
    }

    public function delete(Orders $order)
    {
        $hasil = $order->delete();
        return $this->out(
            status: $hasil ? 'OK' : 'Gagal',
            data: $hasil ? $order : null,
            error: $hasil ? null : ['Gagal Hapus data'],
            code: $hasil ? 200 : 504,
        );
    }
}
