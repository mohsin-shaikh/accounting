<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Customer;
use App\Http\Resources\CustomersResource;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authorize('owner', $request->book);
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        return CustomersResource::collection($book->customers()->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Not Used
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request, Book $book)
    {
        $customer = new Customer($request->all());
        $book->customers()->save($customer);

        // return response([
        //     'data' => new CustomersResource($customer)
        // ], Response::HTTP_CREATED);
        return new CustomersResource($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, Customer $customer)
    {
        return new CustomersResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        // Not Used
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Book $book, Customer $customer)
    {
        // if (!$customer) {
        //     throw new HttpException(400, "Invalid id");
        // }

        // try {
        //     $customer = Customer::find($customer);
        //     if (is_object($customer)) {
        //         $customer->update($request->all());
        //         return new CustomersResource($customer);
        //     } else {
        //         throw new \Exception("Invalid id", 1);
        //     }
        // } catch (\Exception $exception) {
        //     throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        // }

        $customer->update($request->all());
        return new CustomersResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Customer $customer)
    {
        $customer->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
