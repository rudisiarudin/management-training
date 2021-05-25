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
                        <form action="{{ route('participant-save') }}" method="POST">
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
                                <input type="text" id="company" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}">
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
                                <label for="company">Phone</label>
                                <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phon') }}">
                                @error('phone')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
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
                            <a href="" class="btn btn-secondary">
                                Try Bulk Create
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
