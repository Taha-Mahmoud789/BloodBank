<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Contact::latest()->simplePaginate(8);
        return view('contacts.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy(string $id): RedirectResponse
//    {
//        $record = Contact::find($id);
//        $record->delete();
//        flash()->success('Contact Deleted Successfully');
//        return redirect()->route('contacts.index');
//    }
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();
        flash()->success('Contact Deleted Successfully');
        return redirect()->route('contacts.index');
    }
}
