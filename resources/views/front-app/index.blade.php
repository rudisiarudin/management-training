@extends('layouts.front-app')

@section('content')
    <div class="row">
        <div class="col-md-12 my-4">
            <h4>
                Halo, {{ auth()->user()->name }}.
            </h4>

            @include('components.alert-notification')
        </div>
    </div>

    @if($trainingToday)
        <div class="row">
            <div class="col-md-12 my-4">
                <div class="d-flex">
                    <h3 class="text-success"><i class="fe fe-check-circle mr-2"></i></h3>
                    <h3>Pelatihan {{ $trainingToday->trainingSchedule->training->name }} saat ini sedang berlangsung.</h3>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="">
                            Pelatihan Hari Ini
                        </h5>
                        <hr>

                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                <tr>
                                    <th>Pelatihan</th>
                                    <th>Narasumber</th>
                                    <th>Hari Ke</th>
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
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="">
                                <span><i class="fe fe-calendar mr-2"></i></span> Detail Materi Selanjutnya
                            </h5>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-striped table-borderless">
                                    <thead>
                                    <tr>
                                        <th>Materi Pelatihan</th>
                                        <th>Narasumber</th>
                                        <th>Telepon</th>
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

        @include('components.status-training')

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jadwal Materi Pelatihan Berjalan</h3>
                    </div>
                    <div class="card-table table-responsive">
                        <table class="table table-vcenter">
                            <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>Materi Pelatihan</th>
                                <th>Narasumber</th>
                                <th>Hari & Tanggal</th>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        Pelatihan anda akan mulai pada : {{ \Carbon\Carbon::parse($trainingTimelines[0]->schedule_date)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                    </div>
                </div>
            </div>
        @endif

        @if($trainingSchedule)
            @include('components.status-training')

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <p>
                                Anda telah mendaftar untuk pelatihan : <strong>{{ $trainingSchedule->training->name }}</strong>,
                                Mohon lengkapi dokumen persyaratan dan upload di halaman profil.
                            </p>

                            <hr>
                            <a href="{{ route('front-app-profile') }}" class="btn btn-outline-primary btn-pill">
                                <span><i class="fe fe-user-check mr-2"></i></span> Perbarui Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p class="">
                                <span class="text-muted"><i class="fe fe-calendar mr-2"></i></span> Anda tidak memiliki pelatihan apapun saat ini...
                            </p>
                            <hr>

                            <a href="{{ route('front-app-training-list') }}" class="btn btn-primary">
                                <span><i class="fe fe-search mr-2"></i></span> Cari Pelatihan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

    @if($finishedTraining)
        <div class="row">
            <div class="col-sm-12">
                <div class="card bg-blue-lighter">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <strong>Download sertifikat sementara dari pelatihan terakhir anda disini</strong>

                        <form action="{{ route('front-app-generate-certificate', ['id' => $finishedTraining->id]) }}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-primary">
                                <span><i class="fe fe-download-cloud mr-2"></i></span> Download Sertifikat Sementara
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
