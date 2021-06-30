@extends('layouts.front-app')

@section('content')
    <div class="row">
        <div class="col-md-12 my-4">
            <h3>
                Your Profile
            </h3>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')  }}">
                            @error('name')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" id="company" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company')  }}">
                            @error('company')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company">Address</label>
                            <input type="text" id="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">
                            @error('address')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company">Email</label>
                            <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                            @error('email')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="ktp">ID Card (Image)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="ktp" name="ktp" accept="image/*">
                                <label class="custom-file-label" for="ktp">Choose file...</label>
                                @error('ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ijazah">Diploma Certificate (Image)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="ijazah" name="ijazah" accept="image/*">
                                <label class="custom-file-label" for="ijazah">Choose file...</label>
                                @error('ijazah')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="surat_pengantar">Permission Letter From Office (Image)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="surat_pengantar" name="surat_pengantar" accept="image/*">
                                <label class="custom-file-label" for="surat_pengantar">Choose file...</label>
                                @error('surat_pengantar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa fa-fw fa-file-upload mr-2"></i> Submit Participant
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
