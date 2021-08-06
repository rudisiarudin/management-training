@extends('layouts.admin-dasboard')

@section('content')
    <div class="mb-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Update Admin Data</h3>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('admin-update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name  }}">
                                @error('name')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email  }}" disabled>
                                @error('email')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            @can('isSuperAdmin')
                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <select id="role_id" class="form-control @error('role_id') is-invalid @enderror" name="role_id">
                                        <option value=""></option>
                                        <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>User</option>
                                        <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Admin</option>
                                        <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Super Admin</option>
                                    </select>
                                    @error('role_id')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endcan

                            <div class="form-group">
                                <label for="user_photo">User Photo (Image)</label>
                                <div class="w-50 mb-3">
                                    <img src="{{ asset($user->user_photo) }}" class="w-100">
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="user_photo" name="user_photo" accept="image/*">
                                    <label class="custom-file-label" for="user_photo">Choose file...</label>
                                    @error('user_photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa fa-fw fa-file-upload mr-2"></i> Update Admin Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
