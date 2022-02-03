<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CustomerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Customer::all());
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
     * @param  \Illuminate\Http\CustomerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $data = $request->validated() +
            [
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'blocked' => empty($request['blocked']) ? false : true
            ];

        $customer = Customer::create($data);

        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Just another way. Not using model binding, we go and handle the error without Handler
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'error' => "The customer with ID {$id} does not exist.",
            ], 404);
        }
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CustomerRequest  $request
     * @param  Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $result = $customer->update($request->validated());

        return response()->json(
            ['success' => $result]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $result = $customer->delete();

        return response()->json(
            ['success' => $result]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  str  $code
     * @return \Illuminate\Http\Response
     */
    public function searchUsername($username)
    {
        $validator = Validator::make(
            ['username' => $username],
            ['username' => 'required']
        );
        $validator->validate();

        $result = Customer::where('username', 'like', '%' . $username . '%')->get();
        return response()->json($result);
    }
}
