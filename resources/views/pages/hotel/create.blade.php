@extends('layouts.app')
@section('title', 'Tambah Hotel')
@section('content')
<main class="w-full">
    <h1 class="font-bold text-3xl">Tambah Hotel</h1>
    <div class="bg-white shadow-sm rounded-xl mt-4">
        <form action="{{ route('hotels.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="grid grid-cols-6 px-5 pt-5">
                <!-- Nama Hotel -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="name">Nama Hotel</label>
                    <input type="text" class="w-full border-gray-400 rounded @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan Nama Hotel">
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Destinasi -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="location_id">Lokasi</label>
                    <select name="location_id" id="location_id" class="w-full border-gray-400 rounded @error('location_id') is-invalid @enderror">
                        <option value="">Pilih Lokasi</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                {{ $location->city }}, {{ $location->province }}
                            </option>
                        @endforeach
                    </select>
                    @error('location_id')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Harga per Malam -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="price_per_night">Harga per Malam</label>
                    <input type="number" class="w-full border-gray-400 rounded @error('price_per_night') is-invalid @enderror" name="price_per_night" id="price_per_night" value="{{ old('price_per_night') }}" placeholder="Masukkan Harga per Malam">
                    @error('price_per_night')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Rating -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="rating">Rating</label>
                    <input type="number" step="0.1" min="0" max="5" class="w-full border-gray-400 rounded @error('rating') is-invalid @enderror" name="rating" id="rating" value="{{ old('rating') }}" placeholder="Masukkan Rating (0 - 5)">
                    @error('rating')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="px-5 pt-5 col-span-6 flex justify-end">
                    <button type="submit" class="bg-blue-500 px-3 py-2 rounded me-3 mb-3 text-white w-full">Save</button>
                    <button type="reset" class="bg-gray-400 px-3 py-2 rounded mb-3 text-white w-full">Reset</button>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
