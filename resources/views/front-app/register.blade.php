@extends('layouts.front-app')

@section('content')
    <div class="row">
        <div class="col-md-12 my-4">
            <h3>
                Pendaftaran Pelatihan {{ $trainingSchedule->training->name }}
            </h3>
        </div>

        <div class="col-md-7">
            @include('components.alert-notification')

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('front-app-registration-save', ['id' => $trainingSchedule->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="training_schedule_id">Pelatihan yang dipilih</label>
                            <input type="text" id="training_schedule_id" class="form-control @error('training_schedule_id') is-invalid @enderror" name="training_schedule_id" value="{{ $trainingSchedule->training->name . ' / ' . $trainingSchedule->schedule_date }}" readonly>
                            @error('training_schedule_id')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                            @error('name')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                            @error('email')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Telepon</label>
                            <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa fa-fw fa-file-upload mr-2"></i> Kirim Pendaftaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
