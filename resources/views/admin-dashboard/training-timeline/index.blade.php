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
                                <th>Training</th>
                                <th>Schedule</th>
                                <th>Location</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trainingTimelines as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->trainingSchedule->training->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->trainingSchedule->schedule_date)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}</td>
                                    <td>{{ $item->trainingSchedule->location }}</td>
                                    <td>
                                        <a href="{{ route('training-timeline-show', ['id' => $item->trainingSchedule->id]) }}"><span><i class="fas fa-eye"></i></span></a>
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
@endsection
