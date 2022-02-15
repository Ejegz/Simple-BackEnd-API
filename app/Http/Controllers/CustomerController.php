<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class CustomerController extends BaseController
{
    public function findAll()
    {
        $data = Customers::paginate(
            20,
            [
                'id', 'email', 'first_name', 'last_name', 'city', 'address'
            ]
        );

        if (count($data) == 0) {
            return $this->out(data: [], status: 'Kosong', code: 204);
        } else {
            return $this->out(data: $data, status: 'OK');
        }
    }
}
