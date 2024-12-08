@extends('layouts.app')
@section('title', 'Tambah Paket')
@section('content')
<main class="w-full">
    <h1 class="font-bold text-3xl">Tambah Paket</h1>
    <div class="bg-white shadow-sm rounded-xl mt-4">
        <form action="{{ route('packages.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="grid grid-cols-6 px-5 pt-5">
                <!-- Nama Paket -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="name">Nama Paket</label>
                    <input type="text" class="w-full border-gray-400 rounded @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan Nama Paket">
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="description">Deskripsi</label><br>
                    <textarea class="w-full border-gray-400 rounded @error('description') is-invalid @enderror" name="description" id="description" rows="5" placeholder="Masukkan Deskripsi Paket">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="price">Harga</label>
                    <input type="number" class="w-full border-gray-400 rounded @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price') }}" placeholder="Masukkan Harga Paket">
                    @error('price')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Durasi -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="duration">Durasi (Hari)</label>
                    <input type="number" class="w-full border-gray-400 rounded @error('duration') is-invalid @enderror" name="duration" id="duration" value="{{ old('duration') }}" placeholder="Masukkan Durasi Paket">
                    @error('duration')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Malam -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="night">Malam</label>
                    <input type="number" class="w-full border-gray-400 rounded @error('night') is-invalid @enderror" name="night" id="night" value="{{ old('night') }}" placeholder="Masukkan Jumlah Malam">
                    @error('night')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kapasitas -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="capacity">Kapasitas</label>
                    <input type="number" class="w-full border-gray-400 rounded @error('capacity') is-invalid @enderror" name="capacity" id="capacity" value="{{ old('capacity') }}" placeholder="Masukkan Kapasitas Paket">
                    @error('capacity')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Tersembunyi untuk created_by -->
                <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">

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
