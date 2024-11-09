<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $records = Client::where(function ($query) use ($request) {
            if ($request->filled('keyword')) {
                $query->where(function ($query) use ($request) {
                    $keyword = $request->input('keyword');
                    $query->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('phone', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%')
                        ->orWhereHas('city', function ($city) use ($keyword) {
                            $city->where('name', 'like', '%' . $keyword . '%');
                        });
                });
            }

            if ($request->filled('blood_type_id')) {
                $query->where('blood_type_id', $request->input('blood_type_id'));
            }
        })->paginate(20);

        return view('clients.index', compact('records'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Add your store logic here if needed.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Add your update logic here if needed.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record = Client::find($id);

        // Check for related data before deleting
//        if ($record->requests()->exists() || $record->contacts()->exists()) {
//            return Response::json([
//                'status' => 0,
//                'message' => 'يوجد عمليات مرتبطة بهذا العميل',
//            ], 400);
//        }
        flash()->success("Deleted Clint Successfully");

        $record->delete();
        return redirect()->route('clients.index');
//        return Response::json([
//            'status' => 1,
//            'message' => 'تم الحذف بنجاح',
//            'id' => $id,
//        ], 200);
    }

    public function activate($id)
    {
        $client = Client::findOrFail($id);
        $client->update(['is_active' => 1]);
        flash()->success('تم التفعيل');
        return back();
    }

    public function deactivate($id)
    {
        $client = Client::findOrFail($id);
        $client->update(['is_active' => 0]);
        flash()->success('Deactivate Successfully');
        return back();
    }

    public function toggleActivation($id)
    {
        $client = Client::findOrFail($id);
        $msg = 'Activate Successfully';

        if ($client->is_active) {
            $msg = 'Deactivate Successfully';
            $client->update(['is_active' => 0]);
        } else {
            $client->update(['is_active' => 1]);
        }

        flash()->success($msg);
        return back();
    }
}
