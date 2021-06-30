@extends('layouts.front-app')

@section('content')

    @if($trainingToday)
        <div class="row">
            <div class="col-md-12 my-4">
                <h3>
                    <span class="text-success"><i class="fe fe-check-circle mr-2"></i></span>
                    You are attending for training: {{ $trainingToday->trainingSchedule->training->name }}
                </h3>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="">
                            <span class="text-success"><i class="fe fe-calendar mr-2"></i></span> Today Training
                        </h5>
                        <hr>

                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                <tr>
                                    <th>Training</th>
                                    <th>Lecture</th>
                                    <th>Days</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $trainingToday->trainingSchedule->training->name }}</td>
                                    <td>{{ $trainingToday->trainer->lecture_name }}</td>
                                    <td>{{ $trainingToday->days }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @if($trainingTomorrow)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="">
                                <span><i class="fe fe-calendar mr-2"></i></span> Tomorrow Schedule
                            </h5>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-striped table-borderless">
                                    <thead>
                                    <tr>
                                        <th>Lecture</th>
                                        <th>Trainer</th>
                                        <th>Phone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $trainingToday->trainer->lecture_name }}</td>
                                        <td>{{ $trainingToday->trainer->name }}</td>
                                        <td>{{ $trainingToday->trainer->phone }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Schedule List</h3>
                    </div>
                    <div class="card-table table-responsive">
                        <table class="table table-vcenter">
                            <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>Training Lecture</th>
                                <th>Trainer</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trainingTimelines as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->trainer->lecture_name }}</td>
                                    <td>{{ $item->trainer->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->schedule_date)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}</td>
                                    <td>
                                        @if($item->schedule_date < \Carbon\Carbon::now()->format('Y-m-d 00:00:00'))
                                            <span class="text-success"><i class="fe fe-check-circle"></i></span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if(count($trainingTimelines))
            <div class="col-md-12">
                <div class="alert alert-success">
                    Your training will start on : {{ \Carbon\Carbon::parse($trainingTimelines[0]->schedule_date)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="">
                            <span class="text-muted"><i class="fe fe-calendar mr-2"></i></span> You not have any training today...
                        </h5>
                        <hr>

                        <button class="btn btn-primary">
                            <span><i class="fe fe-search mr-2"></i></span> Find Training
                        </button>
                    </div>
                </div>
            </div>

            @if($trainingSchedule)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            Nearest training schedule : <strong>{{ $trainingSchedule->training->name }}</strong>

                            <hr>

                            <button class="btn btn-primary">
                                <span><i class="fe fe-file-plus mr-2"></i></span> Register Training
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif
@endsection
