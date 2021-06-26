@extends('layouts.admin-dasboard')

@section('title', 'TMS | Registration Data')

@section('content')
    <div class="">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Training Registration List</h3>
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
                                <th>Training Name</th>
                                <th>Participant Name</th>
                                <th>Register Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Paid Status</th>
                                <th>Certificate Progress</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($registrations as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->trainingSchedule->training->name }}</td>
                                    <td>{{ $item->participant->name ?: '-' }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                        @if($item->is_paid == 1)
                                            <span class="badge badge-danger">Not Paid</span>
                                        @elseif($item->is_paid == 2)
                                            <span class="badge badge-success">Paid</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->certificate_progress == 1)
                                            <span class="badge badge-dark">Not Submit</span>
                                        @elseif($item->certificate_progress == 2)
                                            <span class="badge badge-primary">Submitted</span>
                                        @elseif($item->certificate_progress == 3)
                                            <span class="badge badge-success">Released</span>
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <form action="{{ route('registration-delete', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn p-0 m-1" title="Delete">
                                                <span class="text-danger small"><i class="fa fa-fw fa-trash"></i></span>
                                            </button>
                                        </form>

                                        <a href="{{ route('registration-edit', ['id' => $item->id]) }}" class="m-1" title="Edit">
                                            <span class="text-primary small"><i class="fa fa-fw fa-edit"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('registration-create') }}" type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-user-plus mr-2"></i> Add Registration Data
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
