@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">
                    Daftar Peminjaman
                </h1>

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Deskripsi Peminjaman
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Tanggal Peminjaman
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Ruangan
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                User
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Jam Mulai
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Jam Selesai
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
                        @foreach ($peminjamans as $peminjaman)
                        <tr>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $peminjaman->deskripsi_peminjaman }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $peminjaman->tanggal_peminjaman }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $peminjaman->ruangan->nama_ruangan }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $peminjaman->user->name }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $peminjaman->jam_mulai }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $peminjaman->jam_selesai }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $peminjaman->status }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">
                                
                                @if(auth()->user()->role == 'admin' && $peminjaman->status == 'Pending')
                                <form action="{{ route('peminjaman.updateStatus', $peminjaman->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="status" value="Disetujui" class="btn btn-success bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Setujui</button>
                                </form>
                                <form action="{{ route('peminjaman.updateStatus', $peminjaman->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="status" value="Ditolak" class="btn btn-danger bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">Tolak</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $peminjamans->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection