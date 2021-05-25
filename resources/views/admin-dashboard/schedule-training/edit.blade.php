@extends('layouts.admin-dasboard')

@section('title', 'TMS | Create Training Schedule')

@section('content')
    <div class="mb-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Create Training Schedule</h3>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('training-schedule-update', ['id' => $trainingSchedule->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="training_id">Training</label>
                                <select id="training_id" class="form-control @error('training_id') is-invalid @enderror" name="training_id">
                                    <option value="">- Choose Training -</option>
                                    @foreach($trainings as $key => $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $trainingSchedule->training_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('training_id')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="schedule_date">Schedule Date</label>
                                <input type="date" id="schedule_date" class="form-control @error('schedule_date') is-invalid @enderror" name="schedule_date" value="{{ $trainingSchedule->schedule_date }}">
                                @error('schedule_date')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="location">Location</label>
                                <textarea id="location" class="form-control @error('location') is-invalid @enderror" name="location" cols="30" rows="4">{{ $trainingSchedule->location }}</textarea>
                                @error('location')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pic">PIC</label>
                                <input type="email" id="pic" class="form-control @error('pic') is-invalid @enderror" name="pic" value="{{ $trainingSchedule->pic }}">
                                @error('pic')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="estimate_budget">Estimate Budget</label>
                                <input type="number" id="estimate_budget" class="form-control @error('estimate_budget') is-invalid @enderror" name="estimate_budget" value="{{ $trainingSchedule->estimate_budget }}">
                                @error('estimate_budget')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="minimum_participant">Min. Participant</label>
                                <input type="number" id="minimum_participant" class="form-control @error('minimum_participant') is-invalid @enderror" name="minimum_participant" value="{{ $trainingSchedule->minimum_participant }}">
                                @error('minimum_participant')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="permission_document">Permission Document</label>

                                <iframe src="{{ asset('') . $trainingSchedule->permission_document }}" width="100%" height="600" style="border: none;"></iframe>

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="permission_document" name="permission_document">
                                    <label class="custom-file-label" for="permission_document">Choose file...</label>
                                    @error('permission_document')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa fa-fw fa-file-upload mr-2"></i> Submit Training Schedule
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
