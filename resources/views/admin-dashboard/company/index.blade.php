@extends('layouts.admin-dasboard')

@section('title', 'TMS | Company Data')

@section('content')
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Company List</h3>
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
                                <th>Company</th>
                                <th>Agent</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Fax</th>
                                <th>Description</th>
                                <th>Registered</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->agent_name }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->fax ?: '-' }}</td>
                                    <td>{{ $item->description ?: '-' }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                    <td class="d-flex">
                                        <form action="{{ route('company-delete', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn p-0 m-1" title="Delete">
                                                <span class="text-danger small"><i class="fa fa-fw fa-trash"></i></span>
                                            </button>
                                        </form>

                                        <a href="{{ route('company-edit', ['id' => $item->id]) }}" class="m-1" title="Edit">
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
                                <a href="{{ route('company-create') }}" type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-folder-plus mr-2"></i> Add Company Data
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
