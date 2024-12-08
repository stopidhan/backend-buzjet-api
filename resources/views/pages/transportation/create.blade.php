@extends('layouts.app')
@section('title', 'Tambah Transportasi')
@section('content')
<main class="w-full">
    <h1 class="font-bold text-3xl">Buat Transportasi</h1>
                <div class="bg-white shadow-sm rounded-xl mt-4">
                        <form action="{{ route('transportations.store') }}" method="POST" enctype="multipart/form-data" class="" autocomplete="off">
                            <div class="grid grid-cols-6 ">
                                @csrf
                                <div class="px-5 pt-5 col-span-6">
                                    <label class="font-weight-bold" for="name">Nama Transportasi</label> <br>
                                    <input type="text" class="w-full border-gray-400 rounded @error('title') is-invalid @enderror" name="name" id="name" value="" placeholder="Masukkan Nama Transportasi">

                                    <!-- error message untuk title -->
                                    @error('name')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="px-5 pt-5 col-span-6">
                                    <label class="font-weight-bold" for="type">Tipe</label> <br>
                                    <input type="text" class="w-full border-gray-400 rounded @error('title') is-invalid @enderror" name="type" id="type" value="" placeholder="Masukkan Tipe Transportasi">

                                    <!-- error message untuk title -->
                                    @error('type')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="px-5 pt-5 col-span-6">
                                    <label class="font-weight-bold" for="provider">Perusahaan</label> <br>
                                    <input type="text" class="w-full border-gray-400 rounded @error('title') is-invalid @enderror" name="provider" id="provider" value="" placeholder="Masukkan Nama Perusahaan">

                                    <!-- error message untuk title -->
                                    @error('provider')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="px-5 pt-5 col-span-6">
                                    <label class="font-weight-bold" for="price">Harga</label> <br>
                                    <input type="number" class="w-full border-gray-400 rounded @error('title') is-invalid @enderror" name="price" id="price" value="" placeholder="Masukkan harga">

                                    <!-- error message untuk title -->
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
                                            <option value="{{ $location->id }}">{{ $location->city }},  {{ $location->province }}</option>
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
                                <button type="submit" class="bg-blue-500 px-3 py-2 rounded me-3 mb-3 text-white w-full">Save</button>
                                <button type="reset" class="bg-gray-400 px-3 py-2 rounded mb-3 text-white w-full">Reset</button>
                            </div>
                        </form>
                    </div>
</main>
@endsection
