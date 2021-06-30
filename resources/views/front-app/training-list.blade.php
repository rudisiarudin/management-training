@extends('layouts.front-app')

@section('content')
    <div class="row">
        <div class="col-md-12 my-4">
            <h3>Training List</h3>
        </div>

        <div class="col-md-12">
            @foreach($trainingSchedule as $key => $item)
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <span><i class="fe fe-calendar mr-2"></i></span>
                                {{ \Carbon\Carbon::parse($item->schedule_date)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                            </div>

                            <div class="col">
                                Training :
                                <strong>{{ $item->training->name }}</strong>
                            </div>

                            <div class="col">
                                Registered participant :
                                <strong>{{ $item->registrations->count() }}</strong>
                            </div>

                            <div class="col">
                                Cost :
                                <strong>IDR {{ number_format($item->estimate_budget) }}</strong>
                            </div>

                            <div class="col">
                                <a href="{{ route('front-app-register', ['id' => $item->id]) }}" class="btn btn-outline-primary btn-pill">
                                    Register Training
                                </a>
                            </div>
                        </div>
                        <hr>

                        <small>
                            <span><i class="fe fe-map-pin mr-2"></i></span>
                            Location : {{ $item->location }}
                        </small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
