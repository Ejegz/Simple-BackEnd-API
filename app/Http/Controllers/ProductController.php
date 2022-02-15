<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends BaseController
{
    public function findAll()
    {
        $data = Product::paginate(
            20,
            [
                'id', 'title', 'category', 'price', 'stock', 'free_shipping', 'rate'
            ]
        );

        if (count($data) == 0) {
            return $this->out(data: [], status: 'Kosong', code: 204);
        } else {
            return $this->out(data: $data, status: 'OK');
        }
    }


    public function findOne(Product $product)
    {
        return $this->out(data: $product, status: 'OK');
    }
}
