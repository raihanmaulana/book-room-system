@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Peminjaman</h1>

        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="deskripsi_peminjaman">Deskripsi Peminjaman</label>
                <input type="text" name="deskripsi_peminjaman" id="deskripsi_peminjaman" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="ruangan_id">Ruangan</label>
                <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                    @foreach($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}">{{ $ruangan->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jam_mulai">Jam Mulai</label>
                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="jam_selesai">Jam Selesai</label>
                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="date" name="status" id="status" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
@endsection
