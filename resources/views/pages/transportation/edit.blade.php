@extends('layouts.app')
@section('title', 'Edit Transportasi')
@section('content')
<main class="w-full">
    <h1 class="font-bold text-3xl">Edit Transportasi</h1>
    <div class="bg-white shadow-sm rounded-xl mt-4">
        <form action="{{ route('transportations.update', $transportation->id) }}" method="POST" enctype="multipart/form-data" class="" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-6">
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="name">Nama Transportasi</label> <br>
                    <input type="text" class="w-full border-gray-400 rounded @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $transportation->name) }}" placeholder="Masukkan Nama Transportasi">

                    <!-- error message untuk name -->
                    @error('name')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="type">Tipe</label> <br>
                    <input type="text" class="w-full border-gray-400 rounded @error('type') is-invalid @enderror" name="type" id="type" value="{{ old('type', $transportation->type) }}" placeholder="Masukkan Tipe Transportasi">

                    <!-- error message untuk type -->
                    @error('type')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="provider">Perusahaan</label> <br>
                    <input type="text" class="w-full border-gray-400 rounded @error('provider') is-invalid @enderror" name="provider" id="provider" value="{{ old('provider', $transportation->provider) }}" placeholder="Masukkan Nama Perusahaan">

                    <!-- error message untuk provider -->
                    @error('provider')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="price">Harga</label> <br>
                    <input type="number" class="w-full border-gray-400 rounded @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price', $transportation->price) }}" placeholder="Masukkan harga">

                    <!-- error message untuk price -->
                    @error('price')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="location_id">Lokasi</label> <br>
                    <select name="location_id" id="location_id" class="form-control">
                        <option value="">Pilih Lokasi</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}" {{ old('location_id', $transportation->location_id) == $location->id ? 'selected' : '' }}>
                                {{ $location->city }}, {{ $location->country }}
                            </option>
                        @endforeach
                    </select>

                    <!-- error message untuk location_id -->
                    @error('location_id')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="px-5 pt-5 col-span-6 flex justify-end">
                <button type="submit" class="bg-blue-500 px-3 py-2 rounded me-3 mb-3 text-white w-full">Update</button>
                <button type="reset" class="bg-gray-400 px-3 py-2 rounded mb-3 text-white w-full">Reset</button>
            </div>
        </form>
    </div>
</main>
@endsection
