@extends('layouts.admin-dasboard')

@section('title', 'TMS | Training Schedule')

@section('content')
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Training Schedule</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('components.alert-notification')

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Time</th>
                            <th>Location</th>
                            <th>PIC</th>
                            <th>Min. Participant</th>
                            <th>Est. Budget</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($trainingSchedule as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->training->name }}</td>
                                <td>{{ $item->schedule_date }}</td>
                                <td>{{ $item->location }}</td>
                                <td>{{ $item->pic }}</td>
                                <td>{{ $item->minimum_participant }}</td>
                                <td>{{ 'IDR ' . number_format($item->estimate_budget) }}</td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="badge badge-secondary">Planning</span>
                                    @elseif($item->status == 2)
                                        <span class="badge badge-primary">On Running</span>
                                    @elseif($item->status == 3)
                                        <span class="badge badge-success">Finish</span>
                                    @endif
                                </td>
                                </td>
                                <td class="d-flex">
                                    <form action="{{ route('training-schedule-delete', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn p-0 m-1" title="Delete">
                                            <span class="text-danger small"><i class="fa fa-fw fa-trash"></i></span>
                                        </button>
                                    </form>

                                    <a href="{{ route('training-schedule-edit', ['id' => $item->id]) }}" class="m-1" title="Edit">
                                        <span class="text-primary small"><i class="fa fa-fw fa-edit"></i></span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td align="center" colspan="7">Data is empty</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="{{ route('training-schedule-create') }}" type="submit" class="btn btn-primary">
                                <i class="fa fa-fw fa-folder-plus mr-2"></i> Add New Schedule
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
