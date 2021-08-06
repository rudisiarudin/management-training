@extends('layouts.front-app')

@section('content')
    <div class="row">
        <div class="col-md-12 my-4">
            <h3>Daftar Pelatihan</h3>
        </div>

        <div class="col-md-12">
            @forelse($trainingSchedule as $key => $item)
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <span><i class="fe fe-calendar mr-2"></i></span>
                                {{ \Carbon\Carbon::parse($item->schedule_date)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                            </div>

                            <div class="col">
                                Pelatihan :
                                <strong>{{ $item->training->name }}</strong>
                            </div>

                            <div class="col">
                               Peserta Terdaftar :
                                <strong>{{ $item->registrations->count() }} Peserta</strong>
                            </div>

                            <div class="col">
                                Biaya :
                                <strong>IDR {{ number_format($item->estimate_budget) }}</strong>
                            </div>

                            <div class="col">
                                <a href="{{ route('front-app-register', ['id' => $item->id]) }}" class="btn btn-outline-primary btn-pill">
                                    Daftar Pelatihan
                                </a>
                            </div>
                        </div>
                        <hr>

                        <small>
                            <span><i class="fe fe-map-pin mr-2"></i></span>
                            Lokasi : {{ $item->location }}
                        </small>
                    </div>
                </div>
            @empty
               Saat ini tidak ada jadwal pelatihan, hubungi admin kami jika anda meminta pelatihan.
            @endforelse
        </div>
    </div>
@endsection
