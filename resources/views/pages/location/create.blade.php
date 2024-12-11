@extends('layouts.app')
@section('title', 'Tambah Lokasi')
@section('content')
<main class="w-full">
    <h1 class="font-bold text-3xl">Tambah Lokasi</h1>
    <div class="bg-white shadow-sm rounded-xl mt-4">
        <form action="{{ route('locations.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="grid grid-cols-6 px-5 pt-5">
                <!-- Nama Lokasi -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="city">Kota</label>
                    <input type="text" class="w-full border-gray-400 rounded @error('city') is-invalid @enderror" name="city" id="city" value="{{ old('city') }}" placeholder="Masukkan Nama Kota">
                    @error('city')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="province">Provinsi</label>
                    <input type="text" class="w-full border-gray-400 rounded @error('province') is-invalid @enderror" name="province" id="province" value="{{ old('province') }}" placeholder="Masukkan Nama Provinsi">
                    @error('province')
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
