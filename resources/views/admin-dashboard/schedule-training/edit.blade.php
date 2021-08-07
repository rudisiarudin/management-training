@extends('layouts.admin-dasboard')

@section('title', 'TMS | Create Training Schedule')

@section('content')
    <div class="mb-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Detail Training Schedule</h3>
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
                                <label for="status">Training Status</label>
                                <select id="status" class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value=""></option>
                                    <option value="1" {{ $trainingSchedule->status == 1 ? 'selected' : '' }}>Planning</option>
                                    <option value="2" {{ $trainingSchedule->status == 2 ? 'selected' : '' }}>On Running</option>
                                    <option value="3" {{ $trainingSchedule->status == 3 ? 'selected' : '' }}>Finish</option>
                                </select>
                                @error('status')
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
                                    <i class="fa fa-fw fa-file-upload mr-2"></i> Update Training Schedule
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-body">
                        Download training BAP permission for Kemenaker

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('training-schedule-bap', ['id' => $trainingSchedule->id]) }}" target="_blank" class="btn btn-primary w-100">
                                    <i class="fa fa-fw fa-file-download mr-2"></i> Download BAP
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        Download Training Absence Form

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('training-schedule-absence', ['id' => $trainingSchedule->id]) }}" target="_blank" class="btn btn-primary w-100">
                                    <i class="fa fa-fw fa-file-download mr-2"></i> Download Absence Form
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        Download Participant Requirement Document

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('training-schedule-requirement', ['id' => $trainingSchedule->id]) }}" target="_blank" class="btn btn-primary w-100">
                                    <i class="fa fa-fw fa-file-download mr-2"></i> Download Requirement Document
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

               <div class="card">
                   <div class="card-header">
                       Registered : <strong>{{ $trainingSchedule->registrations->count() }} Participant</strong>
                   </div>
                   <div class="card-body">
                       <div class="table-responsive">
                           <table class="table table-striped">
                               <tr>
                                   <th>#</th>
                                   <th>Name</th>
                                   <th>Registered At</th>
                               </tr>
                               @foreach($trainingSchedule->registrations as $key => $item)
                                   <tr>
                                       <td>{{ ++$key }}</td>
                                       <td>{{ $item->participant->name }}</td>
                                       <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                   </tr>
                               @endforeach
                           </table>
                       </div>

                       <hr>
                       <div class="row">
                           <div class="col-md-12">
                               <a href="{{ route('training-schedule-report', ['id' => $trainingSchedule->id]) }}" target="_blank" class="btn btn-primary w-100">
                                   <i class="fa fa-fw fa-file-pdf mr-2"></i> Generate Biodata Report
                               </a>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
@endsection
