@extends('layouts.admin-dasboard')

@section('title', 'TMS | Trainer Data')

@section('content')
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Trainer Data</h3>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Organization</th>
                                <th>Training Lecture</th>
                                <th>Training</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($trainers as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->company }}</td>
                                        <td>{{ $item->lecture_name }}</td>
                                        <td>{{ $item->lecture_name }}</td>
                                        <td class="d-flex">
                                            <form action="{{ route('trainer-delete', ['id' => $item->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn p-0 m-1" title="Delete">
                                                    <span class="text-danger small"><i class="fa fa-fw fa-trash"></i></span>
                                                </button>
                                            </form>

                                            <a href="{{ route('trainer-edit', ['id' => $item->id]) }}" class="m-1" title="Edit">
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
                                <a href="{{ route('trainer-create') }}" type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-user-plus mr-2"></i> Add New Trainer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
