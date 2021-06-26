@extends('layouts.admin-dasboard')

@section('title', 'TMS | Trainer Data')

@section('content')
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Training Timeline Data</h3>
        </div>

        <div class="row">
            <div class="col-md-12">
                @include('components.alert-notification')

                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-hover">
                            <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Schedule</th>
                                <th>Lecture</th>
                                <th>Trainer</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trainingTimelines as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->schedule_date)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}</td>
                                    <td>{{ $item->trainer->lecture_name }}</td>
                                    <td>{{ $item->trainer->name }}</td>
                                    <td>
                                        <a type="button" class="text-primary" data-toggle="modal" data-target="#exampleModal" data-schedule-id="{{ $item->id }}" data-trainer-id="{{ $item->trainer_id }}">
                                            <span><i class="fas fa-edit"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="trainer_id">Trainer</label>
                                <input name="id" id="timeline_schedule_id" type="hidden" value="id">
                                <select id="trainer_id" class="form-control" name="trainer_id">
                                    <option value="">- Choose Trainers -</option>
                                    @foreach($trainers as $key => $item)
                                        <option value="{{ $item->id }}" {{ $item->id == old('trainer_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var scheduleId = button.data('schedule-id')
            var trainerId = button.data('trainer-id')
            var modal = $(this)
            modal.find('#trainer_id').val(trainerId)
            modal.find('#timeline_schedule_id').val(scheduleId)
        })
    </script>
@endsection
