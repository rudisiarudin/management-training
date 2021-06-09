@extends('layouts.admin-dasboard')

@section('title', 'TMS | Create Registration Data')

@section('content')
    <div class="mb-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Create Registration Data</h3>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="training_id">Training</label>
                                <input type="text" id="training_id" class="form-control @error('training_id') is-invalid @enderror" name="training_id" value="{{ old('training_id') }}">
                                @error('training_id')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="participant_id">Participant</label>
                                <input type="text" id="participant_id" class="form-control @error('participant_id') is-invalid @enderror" name="participant_id" value="{{ old('participant_id') }}">
                                @error('participant_id')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Register Name</label>
                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Register Email</label>
                                <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Register Phone</label>
                                <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <hr>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa fa-fw fa-file-upload mr-2"></i> Submit Registration Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
