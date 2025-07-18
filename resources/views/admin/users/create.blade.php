@extends('layout.app')

@section('content')
    <h2>Tambah User</h2>
    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="supervisor">Supervisor</option>
                <option value="operator">Operator</option>
            </select>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
@endsection
