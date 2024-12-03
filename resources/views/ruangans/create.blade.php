@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">
                    Tambah Ruangan
                </h1>

                <form action="{{ route('ruangans.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nama_ruangan" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Ruangan</label>
                        <input type="text" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" id="nama_ruangan" name="nama_ruangan" required>
                    </div>

                    <div class="mb-4">
                        <label for="tipe_ruangan" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tipe Ruangan</label>
                        <input type="text" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" id="tipe_ruangan" name="tipe_ruangan" required>
                    </div>

                    <div class="mb-4">
                        <label for="kapasitas" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Kapasitas</label>
                        <input type="text" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" id="kapasitas" name="kapasitas" required>
                    </div>

                    <div class="mb-4">
                        <label for="fasilitas" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Fasilitas</label>
                        <input type="text" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" id="fasilitas" name="fasilitas" required>
                    </div>

                    <div class="mb-4">
                        <label for="status_ruangan" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status Ruangan</label>
                        <input type="text" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" id="status_ruangan" name="status_ruangan" required>
                    </div>

                    <button type="submit" class="mt-4 w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
