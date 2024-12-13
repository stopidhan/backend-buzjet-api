<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="BuzJet API Documentation",
 *     description="Swagger documentation for BuzJet API"
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000/api"
 * )
 *
 * @OA\Schema(
 *     schema="Package",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="price", type="number"),
 *     @OA\Property(property="duration", type="integer"),
 *     @OA\Property(property="night", type="integer"),
 *     @OA\Property(property="capacity", type="integer"),
 *     @OA\Property(property="created_by", type="integer"),
 *     @OA\Property(property="destinations", type="array", @OA\Items(type="object")),
 *     @OA\Property(property="hotels", type="array", @OA\Items(type="object")),
 *     @OA\Property(property="user", type="object")
 * )
 *
 * @OA\Schema(
 *     schema="PackageInput",
 *     type="object",
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="price", type="number"),
 *     @OA\Property(property="duration", type="integer"),
 *     @OA\Property(property="night", type="integer"),
 *     @OA\Property(property="capacity", type="integer"),
 *     @OA\Property(property="created_by", type="integer"),
 *     @OA\Property(property="destination_ids", type="array", @OA\Items(type="integer")),
 *     @OA\Property(property="hotel_ids", type="array", @OA\Items(type="integer"))
 * )
 */
class PackageController extends Controller
{
    /**
     * @OA\Get(
     *     path="/packages",
     *     tags={"Packages"},
     *     summary="Get list of packages",
     *     description="Retrieve all packages along with their related data",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Package"))
     *     )
     * )
     */
    public function index()
    {
        $packages = Package::with(['destinations', 'hotels', 'user'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditemukan',
            'data' => $packages,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/packages",
     *     tags={"Packages"},
     *     summary="Create a new package",
     *     description="Add a new package along with destinations and hotels",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PackageInput")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Package created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Package")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(type="object", @OA\Property(property="errors", type="array", @OA\Items(type="string")))
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'night' => 'required|integer',
            'capacity' => 'required|integer',
            'created_by' => 'required|exists:users,id',
            'destination_ids' => 'required|array',
            'destination_ids.*' => 'exists:destinations,id',
            'hotel_ids' => 'required|array',
            'hotel_ids.*' => 'exists:hotels,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal ditambahkan',
                'errors' => $validator->errors(),
            ], 422);
        }

        $package = Package::create($request->except(['destination_ids', 'hotel_ids']));

        // Sync relationships
        $package->destinations()->sync($request->destination_ids);
        $package->hotels()->sync($request->hotel_ids);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $package->load(['destinations', 'hotels', 'user']),
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/packages/{id}",
     *     tags={"Packages"},
     *     summary="Get package by ID",
     *     description="Retrieve a specific package along with its related data",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the package",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Package")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Package not found",
     *     )
     * )
     */
    public function show(string $id)
    {
        $package = Package::with(['destinations', 'hotels', 'user'])->find($id);

        if (!$package) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditemukan',
            'data' => $package,
        ]);
    }

    /**
     * @OA\Put(
     *     path="/packages/{id}",
     *     tags={"Packages"},
     *     summary="Update package by ID",
     *     description="Update the details of an existing package",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the package to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(ref="#/components/schemas/PackageInput")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Package updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Package")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Package not found",
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'duration' => 'nullable|integer',
            'night' => 'nullable|integer',
            'capacity' => 'nullable|integer',
            'created_by' => 'nullable|exists:users,id',
            'destination_ids' => 'nullable|array',
            'destination_ids.*' => 'exists:destinations,id',
            'hotel_ids' => 'nullable|array',
            'hotel_ids.*' => 'exists:hotels,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal diubah',
                'errors' => $validator->errors(),
            ], 422);
        }

        $package = Package::find($id);

        if (!$package) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $package->update($request->except(['destination_ids', 'hotel_ids']));

        // Update relationships if provided
        if ($request->has('destination_ids')) {
            $package->destinations()->sync($request->destination_ids);
        }
        if ($request->has('hotel_ids')) {
            $package->hotels()->sync($request->hotel_ids);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diubah',
            'data' => $package->load(['destinations', 'hotels', 'user']),
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/packages/{id}",
     *     tags={"Packages"},
     *     summary="Delete package by ID",
     *     description="Remove a package and its relationships from the database",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the package to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Package deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Package not found",
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $package = Package::findOrFail($id);

        // Delete related pivot table entries
        $package->destinations()->detach();
        $package->hotels()->detach();
        $package->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}
