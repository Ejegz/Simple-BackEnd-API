<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
    public function auth()
    {
        $header = \request()->header('Authorization'); // basic email:password xxxbase64encodexxx
        $keyauth = substr($header, 6); // hilangkan text basic

        $keyauth = base64_decode($keyauth); //decode info login

        $auth = explode(':', $keyauth); //pisahkan email password
        [$email, $pass] = $auth;

        // Sama dengan yang diatas
        // $email = $auth[0];
        // $pass = $auth[1];

        $data = (new Customers())->newQuery()
            ->where('email', $email)
            ->get(['id', 'first_name', 'last_name', 'email', 'password'])->first();


        if ($data == null) {
            // return $this->out(null, 'Gagal', ['Pengguna Tidak Ditemukan'], 404); // PHP 7

            return $this->out(
                status: 'Gagal',
                code: 404, // Tidak Ditemukan
                error: ['Pengguna Tidak ditemukan'],
            ); // PHP 8

        } else {
            if (Hash::check($pass, $data->password)) {
                $data->token = hash('sha256', Str::random()); // Generate token
                unset($data->password); //Hilangkan password
                $data->update(); //Update data dengan isi token

                return $this->out(data: $data, status: 'OK');
            } else {
                return $this->out(
                    status: 'Gagal',
                    code: 401, //Unautorized 
                    error: ['Anda tidak memiliki wewenang'],
                );
            }
        }
    }
}
