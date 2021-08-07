@extends('layouts.admin-dasboard')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Participant Registered
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $participants->count() }} Persons</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Scheduled Training
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $trainingSchedule->count() }} Trainings</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Unpaid Bills</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">IDR {{ number_format($unpaidRegistrations->sum('trainingSchedule.estimate_budget')) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Company Partners
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $companiesCount }} Companies</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Scheduled Training Details</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Schedule Date</th>
                                <th>Cost</th>
                                <th>Participant (Temporary)</th>
                            </tr>
                            </thead>
                            @forelse($trainingSchedule as $key => $item)
                                <tbody>
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->training->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->schedule_date)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}</td>
                                    <td>IDR {{ number_format($item->estimate_budget) }}</td>
                                    <td>{{ $item->registrations->count() }} Participants</td>
                                </tr>
                                </tbody>
                            @empty
                                No scheduled training found.
                            @endforelse
                        </table>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-12">
                            <a href="{{ route('training-schedule-create') }}" class="btn btn-primary">
                                <span><i class="fas fa-folder-plus mr-2"></i></span> Create Schedule
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Unpaid Bills Detail</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Training</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            @forelse($unpaidRegistrations as $key => $item)
                                <tbody>
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->trainingSchedule->training->name  }}</td>
                                    <td>IDR {{ number_format($item->trainingSchedule->estimate_budget) }}</td>
                                </tr>
                                </tbody>
                            @empty
                                No unpaid bills from training.
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
