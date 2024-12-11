<?php

namespace App\Http\Controllers\Api;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with(['location', 'packages'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditemukan',
            'data' => $hotels,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location_id' => 'required|integer|exists:locations,id',
            'price_per_night' => 'required|numeric',
            'rating' => 'required|numeric|min:0|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal ditambahkan',
                'errors' => $validator->errors(),
            ], 422);
        }

        $hotel = Hotel::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $hotel,
        ], 201);
    }

    public function show(string $id)
    {
        $hotel = Hotel::with(['location', 'packages'])->find($id);

        if (!$hotel) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditemukan',
            'data' => $hotel,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'location_id' => 'nullable|integer|exists:locations,id',
            'price_per_night' => 'nullable|numeric',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal diubah',
                'errors' => $validator->errors(),
            ], 422);
        }

        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $hotel->update($request->only(['name', 'location_id', 'price_per_night', 'rating']));

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diubah',
            'data' => $hotel,
        ]);
    }

    public function destroy(string $id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}
