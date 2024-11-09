<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Setting $model)
    {
        if ($model->all()->count() > 0) {
            $model = Setting::findorfail(1);
        }
        return view('settings.index', compact('model'));
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
    public function update(Request $request)
    {
        {
            $this->validate($request, [
                'fb_link'  => 'url',
                'tw_link'   => 'url',
                'ins_link' => 'url',
                'yt_link'    => 'url',
            ]);
            if (Setting::all()->count() > 0) {
                Setting::find(1)->update($request->all());
            } else {
                Setting::create($request->all());
            }
            flash()->success('saved successfully');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
