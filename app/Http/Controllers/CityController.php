<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $records = City::where(function ($q) use ($request) {
            if ($request->name) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            }
            if ($request->governorate_id) {
                $q->where('governorate_id', $request->input('governorate_id'));
            }
        })->paginate(10);

        return view('cities.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $governorates = Governorate::pluck('name', 'id')->toArray();
        return view('cities.create', compact('governorates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:cities,name',
            'governorate_id' => 'required|exists:governorates,id'
        ], [
            'name.required' => 'The name is required.',
            'name.unique' => 'The city name is already in use.',
            'governorate_id.required' => 'The governorate is required.',
        ]);

        City::create($request->all());
        flash()->success("Add City Successfully");
        return redirect()->route('cities.index')->with('success', 'City added successfully.');
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
    public function edit(City $city)
    {
        $governorates = Governorate::pluck('name', 'id')->toArray();
        return view('cities.edit', compact('city', 'governorates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|unique:cities,name,' . $city->id,
            'governorate_id' => 'required|exists:governorates,id'
        ]);

        $city->update($request->all());

        return redirect()->route('cities.index')->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
//        return response()->json([
//            'status' => 1,
//            'message' => 'City deleted successfully',
//            'id' => $city->id
//        ]);
        flash()->success("Delete City Successfully");
        return redirect()->route('cities.index');
    }
}
