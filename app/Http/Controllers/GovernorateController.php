<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $records = Governorate::where(function ($q)use($request){
            $q->where('name','LIKE', '%' . $request->name . '%');
        })->paginate(10);
        return view('governorates.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('governorates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:governorates,name'
        ]);

        // Create a new governorate using the validated data
        $record = Governorate::create($validatedData);

        // Flash a success message and redirect to the governorates index
        session()->flash('success', 'تم إضافة المحافظة بنجاح');
        return redirect()->route('governorates.index');
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
    public function edit($id)
    {
        $governorate = Governorate::findOrFail($id); // Retrieve the governorate by ID
        return view('governorates.edit', compact('governorate'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $governorate = Governorate::findOrFail($id);
        $governorate->update($request->all());
        flash()->success("Edited Successfully");
        return redirect()->route('governorates.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        // Find the governorate by ID
        $governorate = Governorate::findOrFail($id);

        // Delete the governorate
        $governorate->delete();
        flash()->success("Deleted Successfully");
        // Redirect back with a success message
        return redirect()->route('governorates.index');
    }

}
