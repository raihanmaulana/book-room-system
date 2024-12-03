@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">
                    Daftar Ruangan
                </h1>

                <a href="{{ route('ruangans.create') }}" class="btn btn-primary mb-4 text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md">
                    Tambah Ruangan
                </a>

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Nama Ruangan
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Tipe Ruangan
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Kapasitas
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Fasilitas
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($ruangans as $ruangan)
                        <tr>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $ruangan->nama_ruangan }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $ruangan->tipe_ruangan }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $ruangan->kapasitas }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $ruangan->fasilitas }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $ruangan->status_ruangan }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">
                                <a href="{{ route('ruangans.edit', $ruangan->id) }}" class="btn btn-warning bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-md">Edit</a>
                                <form action="{{ route('ruangans.destroy', $ruangan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $ruangans->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
