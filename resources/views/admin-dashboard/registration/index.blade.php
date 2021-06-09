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
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($registrations as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->trainingSchedule->training->alname }}</td>
                                    <td>{{ $item->participant->name ?: '-' }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->is_paid }}</td>
                                    <td>{{ $item->certificate_progress }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td class="d-flex">
                                        <form action="" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn p-0 m-1" title="Delete">
                                                <span class="text-danger small"><i class="fa fa-fw fa-trash"></i></span>
                                            </button>
                                        </form>

                                        <a href="" class="m-1" title="Edit">
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
                                <a href="" type="submit" class="btn btn-primary">
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
