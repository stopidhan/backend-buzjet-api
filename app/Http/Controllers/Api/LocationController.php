<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditemukan',
            'data' => $locations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal ditambahkan',
                'errors' => $validator->errors()
            ], 422);
        }

        $location = Location::create($request->all());
        return response()->json([
           'status' => true,
           'message' => 'Data berhasil ditambahkan',
            'data' => $location
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
               'status' => false,
               'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
           'status' => true,
           'message' => 'Data berhasil ditemukan',
            'data' => $location
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
               'status' => false,
               'message' => 'Data gagal diubah',
                'errors' => $validator->errors()
            ], 422);
        }

        $location = Location::find($id);

        if (!$location) {
            return response()->json([
               'status' => false,
               'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $location->update($request->all());
        return response()->json([
           'status' => true,
           'message' => 'Data berhasil diubah',
            'data' => $location
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::findorFail($id);
        $location->delete();
        return response()->json([
           'status' => true,
           'message' => 'Data berhasil dihapus'
        ],204);
    }
}
