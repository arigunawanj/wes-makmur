@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Data Pengguna</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Pengguna</th>
                                    <th scope="col">Email Pengguna</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->password }}</td>
                                        <td><span class="badge bg-danger">{{ $item->role }}</span></td>
                                        <td>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" class="btn btn-warning">Edit</a>
                                            <a href="/user/{{ $item->id }}" class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                    {{-- Modal Edit --}}
                                    <!-- Modal -->
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Role Pengguna</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('user.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label class="form-label">Role</label>
                                                            <select name="role" id="" class="form-select">
                                                                <option value="Admin"  @if("Admin" == $item->role) @selected ($item->role == 'Admin' )@endif>Admin</option>
                                                                <option value="Editor"  @if("Editor" == $item->role) @selected ($item->role == 'Editor' )@endif>Editor</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
