<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class CustomerController extends Controller
{

    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     $this->authorize('owner', $request->book);
        //     return $next($request);
        // });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreCustomerRequest $request)
    // {
    //     $customer = new Customer($request->all());
    //     $book->customers()->save($customer);

    //     // return response([
    //     //     'data' => new CustomersResource($customer)
    //     // ], Response::HTTP_CREATED);
    //     return new CustomersResource($customer);
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid)
    {
        $customer = Customer::where('uuid', $uuid)->first();
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(string $uuid)
    {
        $customer = Customer::where('uuid', $uuid)->first();
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateCustomerRequest $request, Book $book, Customer $customer)
    // {
    //     // if (!$customer) {
    //     //     throw new HttpException(400, "Invalid id");
    //     // }

    //     // try {
    //     //     $customer = Customer::find($customer);
    //     //     if (is_object($customer)) {
    //     //         $customer->update($request->all());
    //     //         return new CustomersResource($customer);
    //     //     } else {
    //     //         throw new \Exception("Invalid id", 1);
    //     //     }
    //     // } catch (\Exception $exception) {
    //     //     throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
    //     // }

    //     $customer->update($request->all());
    //     return new CustomersResource($customer);
    // }
}
