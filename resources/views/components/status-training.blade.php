<div class="row">
    <div class="col-md-4">
        <div class="card card-sm bg-transparent">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                                    <span class="bg-blue text-white p-3 rounded">
                                       <i class="fe fe-map-pin"></i>
                                    </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            Lokasi Pelatihan
                        </div>
                        <div class="text-muted">
                            {{ $trainingSchedule->location }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-sm bg-transparent">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                                    <span class="bg-secondary text-white p-3 rounded">
                                       <i class="fe fe-users"></i>
                                    </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            Jumlah Peserta Sementara
                        </div>
                        <div class="text-muted">
                            {{ $trainingSchedule->registrations->count() }} Peserta
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-sm bg-transparent border {{ $registrations[0]->is_paid == 2 ? 'border-success' : 'border-danger' }}">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="{{ $registrations[0]->is_paid == 2 ? 'bg-success' : 'bg-danger' }} text-white p-3 rounded">
                            @if($registrations[0]->is_paid == 2)
                                <i class="fe fe-check-circle"></i>
                            @else
                                <i class="fe fe-minus-circle"></i>
                            @endif
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            Status Pembayaran
                        </div>
                        <div class="text-muted">
                            {{ $registrations[0]->is_paid == 2 ? 'Lunas' : 'Upload Bukti Transfer di Profil Anda' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
