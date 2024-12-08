<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('user')->get(); // Relasi user di-load
        return view('pages.package.index', compact('packages'));
    }    

    public function create()
    {
        $admins = User::where('role', 'admin')->get();
        return view('pages.package.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'capacity' => 'required|numeric',
            'created_by' => 'required|exists:users,id',
        ]);

        Package::create($request->all());
        return redirect()->route('packages.index');
    }

    public function edit(Package $package)
    {
        $admins = User::where('role', 'admin')->get();
        return view('pages.package.edit', compact('package', 'admins'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'capacity' => 'required|numeric',
            'created_by' => 'required|exists:users,id',
        ]);

        $package->update($request->all());
        return redirect()->route('packages.index');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index');
    }
}
