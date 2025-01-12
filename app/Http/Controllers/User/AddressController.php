<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filter['search'] = request()->keyword;

        $addresses = Address::query()
            ->where('user_id', auth()->id())
            ->filter($filter)
            ->latest()
            ->paginate(10);

        return view('pages.user.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request)
    {
        if ($request->is_default) {
            Address::where('user_id', auth()->id())->update(['is_default' => 0]);
        }

        Address::create($request->validated());

        $request->session()->flash('success', 'address created successfully');

        return redirect()->route('user.addresses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        return view('pages.user.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAddressRequest $request, Address $address)
    {
        if ($request->is_default) {
            Address::where('user_id', auth()->id())->update(['is_default' => 0]);

            $address->update(['is_default' => 0]);

            $address->update(['is_default' => 1]);
        }

        $address->update($request->except('is_default'));


        $request->session()->flash('success', 'Address updated successfully');

        return redirect()->route('user.addresses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route('user.addresses.index')->with('success', 'Address deleted successfully');
    }

    public function setDefault(Address $address)
    {
        Address::where('user_id', auth()->id())->update(['is_default' => 0]);

        $address->update(['is_default' => 1]);

        return redirect()->route('user.addresses.index')->with('success', 'Address set as default successfully');
    }
}
