@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">
                    Kalender Peminjaman Ruangan
                </h1>

                <!-- Kalender akan tampil di sini -->
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pastikan Anda menggunakan FullCalendar v5+ -->
<!-- FullCalendar CSS dan JS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<!-- SweetAlert2 CSS dan JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.js"></script>

<!-- Toastr CSS dan JS -->
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var peminjaman = @json($peminjaman);  // Data dari controller
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        slotMinTime: '07:00:00',  // Set waktu awal pemilihan
        slotMaxTime: '21:00:00',  // Set waktu akhir pemilihan
        events: peminjaman.map(function(event) {
            return {
                title: event.deskripsi_peminjaman,
                start: event.tanggal_peminjaman + 'T' + event.jam_mulai,
                end: event.tanggal_peminjaman + 'T' + event.jam_selesai,
                id: event.id,
                ruangan_id: event.ruangan_id,
                user_id: event.user_id,
                status: event.status,
                color: event.status === 'Pending' ? 'blue' : 'green'
            };
        }),

        selectable: true,  // Mengaktifkan pilihan tanggal/waktu
        selectHelper: true,  // Membantu dalam pemilihan rentang waktu
        select: function(info) {
            // Menampilkan SweetAlert2 modal untuk input data
            var userId = @json(Auth::id()); 
            Swal.fire({
                title: 'Input Data Peminjaman',
                html: `
                    <form id="peminjamanForm">
                        <div class="swal2-input-group">
                            <label for="deskripsi_peminjaman">Deskripsi Peminjaman</label>
                            <input type="text" id="deskripsi_peminjaman" class="swal2-input" placeholder="Deskripsi Peminjaman" required>
                        </div>
                        <div class="swal2-input-group">
    <label for="ruangan_id">Ruangan</label>
    <select id="ruangan_id" class="swal2-input" required>
        <option value="" disabled selected>Pilih Ruangan</option>
        @foreach($ruangans as $ruangan)
            <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
        @endforeach
    </select>
</div>

               
                        <div class="swal2-input-group">
                            <label for="jam_mulai">Jam Mulai (HH:MM)</label>
                            <input type="time" id="jam_mulai" class="swal2-input" required>
                        </div>
                        <div class="swal2-input-group">
                            <label for="jam_selesai">Jam Selesai (HH:MM)</label>
                            <input type="time" id="jam_selesai" class="swal2-input" required>
                        </div>
                    </form>
                `,
                confirmButtonText: 'Simpan',
                preConfirm: () => {
                    // Ambil data dari form input di modal
                    const deskripsi_peminjaman = Swal.getPopup().querySelector('#deskripsi_peminjaman').value;
                    const ruangan_id = Swal.getPopup().querySelector('#ruangan_id').value;
                    const jam_mulai = Swal.getPopup().querySelector('#jam_mulai').value;
                    const jam_selesai = Swal.getPopup().querySelector('#jam_selesai').value;
                    const tanggal_peminjaman = info.startStr.split('T')[0]; // Tanggal yang dipilih

                    if (!deskripsi_peminjaman || !ruangan_id || !jam_mulai || !jam_selesai) {
                        Swal.showValidationMessage('Semua kolom harus diisi!');
                        return false;
                    }

                    return {
                        deskripsi_peminjaman,
                        ruangan_id,
                        user_id: userId, 
                        jam_mulai,
                        jam_selesai,
                        tanggal_peminjaman
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim data via AJAX ke server
                    fetch('{{ route('fullcalenderAjax') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            deskripsi_peminjaman: result.value.deskripsi_peminjaman,
                            tanggal_peminjaman: result.value.tanggal_peminjaman,
                            jam_mulai: result.value.jam_mulai,
                            jam_selesai: result.value.jam_selesai,
                            ruangan_id: result.value.ruangan_id,
                            user_id: result.value.user_id,
                            status: 'Pending',
                            type: 'add'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        calendar.addEvent({
                            id: data.id,
                            title: data.deskripsi_peminjaman,
                            start: data.tanggal_peminjaman + 'T' + data.jam_mulai,
                            end: data.tanggal_peminjaman + 'T' + data.jam_selesai,
                            color: 'blue',  // Menggunakan warna sesuai status
                        });
                        toastr.success("Event Created Successfully");
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        },

        eventClick: function(info) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                fetch('{{ route('fullcalenderAjax') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: info.event.id,
                        type: 'delete'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    info.event.remove();  // Menghapus event dari kalender
                    toastr.success("Event Deleted Successfully");
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    });

    calendar.render();
});
</script>


@endsection
