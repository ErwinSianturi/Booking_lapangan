@extends('layout.admin')

@section('title', 'Home manager List')

@section('contents')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <h1>manager List</h1>

        <!-- Add manager Button -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="addmanagerModalLabel" >
            Add manager
        </button>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Jenis Pengguna</th>
                    <th>Last Login</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($managers as $manager)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $manager->id_pengguna }}</td>
                        <td>{{ $manager->username_pengguna }}</td>
                        <td>{{ $manager->jenis_pengguna }}</td>
                        <td>{{ $manager->last_login }}</td>
                        <td>
                            {{-- View Button --}}
                            <a href="{{ route('pengelola.show', $manager->id_pengguna) }}" class="btn btn-primary">View</a>

                            {{-- Delete Form --}}
                            <form action="{{ route('pengelola.destroy', $manager->id_pengguna) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this manager?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add manager Modal -->
    <div class="modal fade" id="addmanagerModal" tabindex="-1" role="dialog" aria-labelledby="addmanagerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addmanagerModalLabel">Add manager</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pengelola.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
