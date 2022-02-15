<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Customers;
use Illuminate\Http\Request;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('token');
        $customer = Customers::where('token', $token)->first();

        if ($customer == null) {
            //stop proses dan kirimkan respone token invalid
            return response()->json(
                [
                    'status' => 'Invlalid',
                    'data' => null,
                    'error' => ['Token Invalid, unauthorized']
                ],
                401
            );
        }

        // Simpan data customer
        $request->setUserResolver(function () use ($customer) {
            return $customer;
        });

        return $next($request);
    }
}
