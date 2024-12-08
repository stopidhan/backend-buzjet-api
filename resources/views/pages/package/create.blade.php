@extends('layouts.app')
@section('title', 'Buat Paket')
@section('content')
<main class="w-full" x-data="{
    destinations: [
        {
            destination_id: '',
            hotel_id: '',
            hotels: [],
            transportation_id: '',
            transportations: []
        }
    ],
    async getHotelsAndTransportations(destinationId, index) {
        if (!destinationId) {
            this.destinations[index].hotels = [];
            this.destinations[index].transportations = [];
            this.destinations[index].hotel_id = '';
            this.destinations[index].transportation_id = '';
            return;
        }
        try {
            // Fetch hotels for the selected destination's location
            const hotelsResponse = await fetch(`/api/hotels-by-destination/${destinationId}`);
            const hotels = await hotelsResponse.json();
            this.destinations[index].hotels = hotels;
            this.destinations[index].hotel_id = '';

            // Fetch transportations for the selected destination's location
            const transportationsResponse = await fetch(`/api/transportations-by-destination/${destinationId}`);
            const transportations = await transportationsResponse.json();
            this.destinations[index].transportations = transportations;
            this.destinations[index].transportation_id = '';
        } catch (error) {
            console.error('Error:', error);
            this.destinations[index].hotels = [];
            this.destinations[index].transportations = [];
        }
    },
    addDestination() {
        this.destinations.push({
            destination_id: '',
            hotel_id: '',
            hotels: [],
            transportation_id: '',
            transportations: []
        });
    },
    removeDestination(index) {
        this.destinations = this.destinations.filter((_, i) => i !== index);
    }
}">
    <h1 class="font-bold text-3xl">Buat Paket</h1>
    <div class="bg-white shadow-sm rounded-xl mt-4">
        <form action="{{ route('packages.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="grid grid-cols-12 gap-4">
                <!-- Nama Paket -->
                <div class="px-5 pt-5 col-span-12">
                    <label class="font-weight-bold" for="name">Nama Paket</label>
                    <input type="text"
                           class="w-full border-gray-400 rounded @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Masukkan Nama paket">
                    @error('name')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="px-5 pt-5 col-span-12">
                    <label class="font-weight-bold" for="description">Deskripsi Paket</label>
                    <textarea 
                           class="w-full border-gray-400 rounded @error('description') is-invalid @enderror"
                           name="description"
                           rows="4"
                           placeholder="Masukkan deskripsi paket">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="price">Harga</label>
                    <input type="number"
                           class="w-full border-gray-400 rounded @error('price') is-invalid @enderror"
                           name="price"
                           value="{{ old('price') }}"
                           placeholder="Masukkan harga paket">
                    @error('price')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Durasi -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="duration">Durasi (Hari)</label>
                    <input type="number"
                           class="w-full border-gray-400 rounded @error('duration') is-invalid @enderror"
                           name="duration"
                           value="{{ old('duration') }}"
                           placeholder="Masukkan durasi paket">
                    @error('duration')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Malam -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="night">Malam</label>
                    <input type="number"
                           class="w-full border-gray-400 rounded @error('night') is-invalid @enderror"
                           name="night"
                           value="{{ old('night') }}"
                           placeholder="Masukkan jumlah malam">
                    @error('night')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kapasitas -->
                <div class="px-5 pt-5 col-span-6">
                    <label class="font-weight-bold" for="capacity">Kapasitas</label>
                    <input type="number"
                           class="w-full border-gray-400 rounded @error('capacity') is-invalid @enderror"
                           name="capacity"
                           value="{{ old('capacity') }}"
                           placeholder="Masukkan kapasitas paket">
                    @error('capacity')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Destinasi Section -->
                <div class="px-5 pt-5 col-span-12">
                    <div class="flex justify-between items-center mb-4">
                        <label class="font-weight-bold text-lg">Destinasi</label>
                        <button type="button"
                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                                @click="addDestination">
                            + Tambah Destinasi
                        </button>
                    </div>

                    <template x-for="(dest, index) in destinations" :key="index">
                        <div class="border rounded-lg p-4 mb-4 bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Destinasi Select -->
                                <div>
                                    <label class="font-weight-bold">
                                        Destinasi <span x-text="index + 1"></span>
                                    </label>
                                    <select :name="'destinations['+index+'][destination_id]'"
                                            x-model="dest.destination_id"
                                            @change="getHotelsAndTransportations($event.target.value, index)"
                                            class="w-full border-gray-400 rounded">
                                        <option value="">Pilih Destinasi</option>
                                        @foreach ($destinations as $destination)
                                            <option value="{{ $destination->id }}">
                                                {{ $destination->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Hotel Select -->
                                <div>
                                    <label class="font-weight-bold">
                                        Hotel untuk Destinasi <span x-text="index + 1"></span>
                                    </label>
                                    <select :name="'destinations['+index+'][hotel_id]'"
                                            x-model="dest.hotel_id"
                                            class="w-full border-gray-400 rounded">
                                        <option value="">
                                            <span x-text="dest.destination_id ? 'Pilih Hotel' : 'Pilih Destinasi dulu'"></span>
                                        </option>
                                        <template x-for="hotel in dest.hotels" :key="hotel.id">
                                            <option :value="hotel.id" x-text="hotel.name + ' (' + hotel.price_per_night + '/malam)'"></option>
                                        </template>
                                    </select>
                                </div>

                                <!-- Transportation Select -->
                                <div>
                                    <label class="font-weight-bold">
                                        Transportasi untuk Destinasi <span x-text="index + 1"></span>
                                    </label>
                                    <select :name="'destinations['+index+'][transportation_id]'"
                                            x-model="dest.transportation_id"
                                            class="w-full border-gray-400 rounded">
                                        <option value="">
                                            <span x-text="dest.destination_id ? 'Pilih Transportasi' : 'Pilih Destinasi dulu'"></span>
                                        </option>
                                        <template x-for="transport in dest.transportations" :key="transport.id">
                                            <option :value="transport.id" x-text="transport.type + ' - ' + transport.name + ' (' + transport.provider + ')'"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>

                            <!-- Remove Button -->
                            <template x-if="destinations.length > 1">
                                <button type="button"
                                        class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                                        @click="removeDestination(index)">
                                    Hapus Destinasi
                                </button>
                            </template>
                        </div>
                    </template>
                </div>

                <!-- Submit Buttons -->
                <div class="px-5 pt-5 col-span-12 grid grid-cols-2 gap-4 mb-5">
                    <button type="submit" class="bg-blue-500 px-3 py-2 rounded text-white">
                        Simpan
                    </button>
                    <button type="reset" class="bg-gray-400 px-3 py-2 rounded text-white">
                        Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection