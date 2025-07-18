@extends('layout.app')

@section('content')
    <h2>Data User</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">+ Tambah User</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('users.index') }}" method="GET" class="mb-4 d-flex align-items-center gap-2">
    <input type="text" name="search" value="{{ request('search') }}"
        placeholder="Cari User"
        class="form-control">

    <button type="submit" class="btn btn-primary text-white">
        Cari
    </button>

    @if(request('search'))
        <a href="{{ route('users.index') }}" class="btn btn-primary text-sm text-white ms-2">Reset</a>
    @endif
  </form>



    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
