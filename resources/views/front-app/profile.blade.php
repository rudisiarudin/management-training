@extends('layouts.front-app')

@section('content')
    <form action="{{ route('front-app-profile-update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-12 my-4">
                <h3>
                    Detail Profil
                </h3>
            </div>

            <div class="col-md-7">
                @include('components.alert-notification')

                <div class="card">
                    <div class="card-body">
                        @if($registration)
                            <div class="form-group">
                                <div class="alert alert-danger">
                                    Pembayaran anda untuk pelatihan
                                    <strong>{{ $registration->trainingSchedule->training->name . ' / ' .  $registration->trainingSchedule->schedule_date }}</strong>
                                    belum lunas.
                                    <hr>

                                    Silahkan lunasi dan upload bukti pembayaran disini, lalu simpan data.
                                    <div id="msg"></div>
                                    <input type="file" name="proof_transfer" class="file" id="proof_transfer" accept="image/*">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" disabled placeholder="Upload Bukti Pembayaran">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-primary" data-id="#proof_transfer">Browse...</button>
                                        </div>
                                        <div class="mb-4">
                                            <img src="" id="preview_proof_transfer" class="W-50">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    @if($user->participant->profile_image)
                                        <div class="mb-4">
                                            <img src="{{ asset($user->participant->profile_image) }}" id="preview_profile_image" class="w-100 rounded">
                                        </div>
                                    @else
                                        <div class="mb-4">
                                            <img src="{{ asset('img/profile/default.png') }}" id="preview_profile_image" class="W-75">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-8">
                                    <label for="">Foto Profil</label>

                                    <div id="msg"></div>
                                    <input type="file" name="profile_image" class="file" id="profile_image" accept="image/*">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" disabled placeholder="Upload Foto Profil">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-primary" data-id="#profile_image">Browse...</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ $user->name  }}">
                            @error('name')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="raw_company">Perusahaan</label>
                            <input type="text" id="raw_company" class="form-control @error('raw_company') is-invalid @enderror"
                                   name="raw_company" value="{{ $user->participant->raw_company  }}">
                            @error('raw_company')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="text" id="address" class="form-control @error('address') is-invalid @enderror"
                                   name="address" value="{{ $user->participant->address }}">
                            @error('address')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Telepon</label>
                            <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" value="{{ $user->participant->phone }}">
                            @error('phone')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <hr>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa fa-fw fa-file-upload mr-2"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <h4 class="">Dokumen Persyaratan</h4>
                <hr>

                <div class="form-group">
                    <label for="ktp">KTP (Image)</label>

                    <div id="msg"></div>
                    <input type="file" name="ktp" class="file" id="ktp" accept="image/*">
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload KTP">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary" data-id="#ktp">Browse...</button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <img src="{{ asset($user->participant->ktp) }}" id="preview_ktp" class="W-75">
                    </div>
                </div>
                <hr>

                <div class="form-group">
                    <label for="ijazah">Ijazah (Image)</label>

                    <div id="msg"></div>
                    <input type="file" name="ijazah" class="file" id="ijazah" accept="image/*">
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload Ijazah">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary" data-id="#ijazah">Browse...</button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <img src="{{ asset($user->participant->ijazah) }}" id="preview_ijazah" class="W-75">
                    </div>
                </div>
                <hr>

                <div class="form-group">
                    <label for="surat_pengantar">Surat Pengantar Perusahaan (Image)</label>

                    <div id="msg"></div>
                    <input type="file" name="surat_pengantar" class="file" id="surat_pengantar" accept="image/*">
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload Surat Pengantar">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary" data-id="surat_pengantar">Browse...</button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <img src="{{ asset($user->participant->surat_pengantar) }}" id="preview_surat_pengantar" class="W-75">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
