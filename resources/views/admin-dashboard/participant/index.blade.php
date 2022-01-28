@extends('layouts.admin-dasboard')

@section('title', 'TMS | Participant Data')

@section('content')
    <div class="">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Participant List</h3>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <input name="participantsFilter" id="participantsFilter" class="form-control">
                
            </div>
            <div class="col-md-3">
                <button id="applyFilter" class="btn btn-primary">
                    Search
                </button>

                <button id="clearFilter" class="btn btn-secondary">
                    Clear
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('components.alert-notification')

                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-hover">
                            <thead class="">
                            <tr>
                                <th>
                                    #
                                    <button class="btn btn-link p-0 pl-3" id="sortDataUp">
                                        <i class="fas fa-arrow-up"></i>
                                    </button> 
                                </th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Last Training Attended</th>
                                <th>KTP</th>
                                <th>Diploma Certificate</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($participants as $key => $item)
                                <tr>
                                    <td>{{ ($participants->currentPage() - 1) * 10 + $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->companies->name ? $item->companies->name : ($item->raw_company ?: '-') }}</td>
                                    <td>{{ $item->trainingSchedule->training->name ?: '-' }}</td>
                                    <td>
                                        @if($item->ktp)
                                            <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                        @else
                                            <span class="text-danger"><i class="fas fa-times-circle"></i></span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->ijazah)
                                            <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                        @else
                                            <span class="text-danger"><i class="fas fa-times-circle"></i></span>
                                        @endif
                                    </td>
                                    <td>
                                    <td class="d-flex">
                                        <form action="{{ route('participant-delete', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn p-0 m-1" title="Delete">
                                                <span class="text-danger small"><i class="fa fa-fw fa-trash"></i></span>
                                            </button>
                                        </form>

                                        <a href="{{ route('participant-edit', ['id' => $item->id]) }}" class="m-1" title="Edit">
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
                                {!! $participants->render() !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('participant-create') }}" type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-user-plus mr-2"></i> Add Participant
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#applyFilter').click(function (e) {
                e.preventDefault()
                let searchName = $('#participantsFilter').val()
                let url = location.href.split('?')[0]
                location.href = `${url}?searchName=${searchName}`
                console.log(location.href)
            })

            $('#clearFilter').click(function(e) {
                e.preventDefault()
                location.href = location.pathname
            })

            $('#sortDataUp').click(function (e) {
                e.preventDefault()
                let url = location.href.split('?')[0]
                location.href = `${url}?sortData=desc`
                console.log(location.href)
            })
        })
    </script>
@endsection
