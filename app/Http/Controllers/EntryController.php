<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Entry;
use App\Models\Customer;
use App\Http\Resources\EntriesResource;
use App\Http\Requests\StoreEntryRequest;
use App\Http\Requests\UpdateEntryRequest;
use App\Exceptions\CustomerNotBelongsToBook;
use Symfony\Component\HttpFoundation\Response;

class EntryController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authorize('owner', $request->book);
            $this->CustomerBookCheck($request->book, $request->customer);
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book, Customer $customer)
    {
        return EntriesResource::collection(
            $book->customers()->find($customer->id)->entries()->paginate(10)
        );
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
     * @param  \App\Http\Requests\StoreEntryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntryRequest $request, Book $book, Customer $customer)
    {
        $entry = new Entry($request->all());
        $customer->entries()->save($entry);
        return new EntriesResource($entry);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, Customer $customer, Entry $entry)
    {
        return new EntriesResource($entry);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        // Not Used
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEntryRequest  $request
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEntryRequest $request, Book $book, Customer $customer, Entry $entry)
    {
        $entry->update($request->all());
        return new EntriesResource($entry);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Customer $customer, Entry $entry)
    {
        $entry->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function CustomerBookCheck(Book $book, Customer $customer)
    {
        if ($book->customers()->find($customer->id) == null) {
            throw new CustomerNotBelongsToBook;
        }
    }
}
