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
                <div class="alert flex items-center p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
                    <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 0C3.58 0 0 3.58 0 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zm0 13c-2.48 0-4.5-2.02-4.5-4.5S5.52 4 8 4s4.5 2.02 4.5 4.5S10.48 13 8 13zm-.5-6V7h1v1.5h-.5zM7 9.5V7h2v1.5H7z" />
                    </svg>
                    <span class="flex-1">{{ session('success') }}</span>
                    <button type="button" class="ml-4 -mx-1.5 -my-1.5 text-green-500 hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-300 rounded-lg close-alert" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.293 3.293a1 1 0 011.414 0L8 5.586l2.293-2.293a1 1 0 111.414 1.414L9.414 7l2.293 2.293a1 1 0 01-1.414 1.414L8 8.414l-2.293 2.293a1 1 0 01-1.414-1.414L6.586 7 4.293 4.707a1 1 0 010-1.414z" />
                        </svg>
                    </button>
                </div>
                @endif

                <script>
                    // Menutup alert setelah 5 detik
                    setTimeout(function() {
                        const alert = document.querySelector('.alert');
                        if (alert) {
                            alert.classList.add('hidden'); // Menyembunyikan alert setelah 5 detik
                        }
                    }, 5000); // 5 detik

                    // Menambahkan event listener untuk menutup alert ketika tombol close diklik
                    const closeButton = document.querySelector('.close-alert');
                    if (closeButton) {
                        closeButton.addEventListener('click', function() {
                            const alert = this.closest('.alert');
                            if (alert) {
                                alert.classList.add('hidden'); // Menyembunyikan alert ketika tombol close diklik
                            }
                        });
                    }
                </script>

                @if(session('error'))
                <div class="alert flex items-center p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
                    <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 0C3.58 0 0 3.58 0 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zm0 13c-2.48 0-4.5-2.02-4.5-4.5S5.52 4 8 4s4.5 2.02 4.5 4.5S10.48 13 8 13zm-.5-6V7h1v1.5h-.5zM7 9.5V7h2v1.5H7z" />
                    </svg>
                    <span class="flex-1">{{ session('error') }}</span>
                    <button type="button" class="ml-4 -mx-1.5 -my-1.5 text-red-500 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-300 rounded-lg close-alert" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.293 3.293a1 1 0 011.414 0L8 5.586l2.293-2.293a1 1 0 111.414 1.414L9.414 7l2.293 2.293a1 1 0 01-1.414 1.414L8 8.414l-2.293 2.293a1 1 0 01-1.414-1.414L6.586 7 4.293 4.707a1 1 0 010-1.414z" />
                        </svg>
                    </button>
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
                                PIC
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                NIM
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
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $peminjaman->user->nim }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $peminjaman->jam_mulai }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $peminjaman->jam_selesai }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $peminjaman->status }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">
                                @if ($peminjaman->status == 'Disetujui KADEP')
                                <!-- Tombol Export PDF -->
                                <a href="{{ route('peminjaman.exportPdf', $peminjaman->id) }}" class="btn btn-success bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                                    Export PDF
                                </a>
                                @else
                                <!-- Status lainnya (misalnya Pending atau Ditolak) -->
                                @if ($peminjaman->status == 'Ditolak')
                                <span class="bg-red-600 text-white px-4 py-2 rounded">Ditolak</span>
                                @else
                                <span class="bg-yellow-600 text-white px-4 py-2 rounded">Pending</span>
                                @endif
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