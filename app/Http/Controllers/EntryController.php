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
        // $this->middleware(function ($request, $next) {
        //     $this->authorize('owner', $request->book);
        //     $this->CustomerBookCheck($request->book, $request->customer);
        //     return $next($request);
        // });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $customer_uuid)
    {
        $customer = Customer::where('uuid', $customer_uuid)->first();
        return view('entries.create', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEntryRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreEntryRequest $request, Customer $customer)
    // {
    //     $entry = new Entry($request->all());
    //     $customer->entries()->save($entry);
    //     return new EntriesResource($entry);
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    // public function show(Book $book, Customer $customer, Entry $entry)
    // {
    //     return new EntriesResource($entry);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(string $customer_uuid, string $entry_uuid)
    {
        $customer   = Customer::where('uuid', $customer_uuid)->first();
        $entry      = Entry::where('uuid', $entry_uuid)->first();
        return view('entries.edit', compact(['customer', 'entry']));
    }
}
