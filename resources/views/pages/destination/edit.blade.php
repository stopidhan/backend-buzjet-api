@extends('layouts.app')
@section('title', 'Edit Destinasi')
@section('content')
<main class="w-full">
    <h1 class="font-bold text-3xl">Edit Destinasi</h1>
    <div class="bg-white shadow-sm rounded-xl mt-4">
        <form action="{{ route('destinations.update', $destination->id) }}" method="POST" enctype="multipart/form-data" class="" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-6">
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="name">Nama Destinasi</label> <br>
                    <input type="text" class="w-full border-gray-400 rounded @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $destination->name) }}" placeholder="Masukkan Nama Destinasi">

                    <!-- error message untuk name -->
                    @error('name')
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
                            <option value="{{ $location->id }}" {{ old('location_id', $destination->location_id) == $location->id ? 'selected' : '' }}>
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

                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="description">Deskripsi</label> <br>
                    <textarea class="w-full border-gray-400 rounded @error('description') is-invalid @enderror" name="description" id="description" rows="5" placeholder="Masukkan Deskripsi Destinasi">{{ old('description', $destination->description) }}</textarea>

                    <!-- error message untuk description -->
                    @error('description')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="px-5 pt-5 col-span-3">
                    <label class="font-weight-bold">Image</label>
                    <input type="file" class="w-full border-gray-400 rounded @error('img') is-invalid @enderror" name="img">
                    <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>

                    <!-- error message untuk img -->
                    @error('img')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                    @if ($destination->img)
                        <img src="{{ asset('storage/' . $destination->img) }}" alt="Image" class="mt-3 w-48 h-32 object-cover">
                    @endif
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
