@extends('layouts.admin-dasboard')

@section('content')
    <div class="mb-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Create Single Participant</h3>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('participant-save') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')  }}">
                                @error('name')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="company_id">Company</label>
                                <select id="company_id" class="form-control @error('company_id') is-invalid @enderror" name="company_id">
                                    <option value=""></option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
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

                            <div class="form-group">
                                <label for="training_id">Participant For Training (Optional)</label>
                                <select id="training_id" class="form-control @error('training_id') is-invalid @enderror" name="training_id">
                                    <option value=""></option>
                                    @foreach($trainingSchedules as $training)
                                        <option value="{{ $training['id'] }}">{{ $training['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('training_id')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

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

            <div class="col-md-5">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="my-3">
                            <p>
                                Try new bulk add participant feature.
                                You can easily generate participant data with pre-templated excel.
                            </p>
                            <a href="{{ route('participant-create-bulk') }}" class="btn btn-secondary">
                                Try Bulk Create
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
