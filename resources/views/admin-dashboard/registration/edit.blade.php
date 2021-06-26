@extends('layouts.admin-dasboard')

@section('content')
    <div class="mb-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Edit Data Registration</h3>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('registration-update', ['id' => $registration->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $registration->name }}">
                                @error('name')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="training_schedule_id">Participant For Training (Optional)</label>
                                <select id="training_schedule_id" class="form-control @error('training_schedule_id') is-invalid @enderror" name="training_schedule_id">
                                    <option value=""></option>
                                    @foreach($trainingSchedules as $training)
                                        <option value="{{ $training['id'] }}" {{ $training['id'] == $registration->training_schedule_id ? 'selected' : '' }}>{{ $training['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('training_schedule_id')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="company">Email</label>
                                <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $registration->email }}" disabled>
                                @error('email')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="company">Phone</label>
                                <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $registration->phone }}">
                                @error('phone')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="is_paid">Paid Status</label>
                                <select id="is_paid" class="form-control @error('is_paid') is-invalid @enderror" name="is_paid">
                                    <option value=""></option>
                                    <option value="1" {{ $registration->is_paid == 1 ? 'selected' : '' }}>Not Paid</option>
                                    <option value="2" {{ $registration->is_paid == 2 ? 'selected' : '' }}>Paid</option>
                                </select>
                                @error('is_paid')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="proof_transfer">Proof Transfer</label>
                                <div class="w-50 mb-3">
                                    <img src="{{ asset($registration->proof_transfer) }}" class="w-100">
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="proof_transfer" name="proof_transfer" accept="image/*">
                                    <label class="custom-file-label" for="proof_transfer">Choose file...</label>
                                    @error('proof_transfer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="certificate_progress">Certificate Progress</label>
                                <select id="certificate_progress" class="form-control @error('certificate_progress') is-invalid @enderror" name="certificate_progress">
                                    <option value=""></option>
                                    <option value="1" {{ $registration->certificate_progress == 1 ? 'selected' : '' }}>Not Submit</option>
                                    <option value="2" {{ $registration->certificate_progress == 2 ? 'selected' : '' }}>Submitted</option>
                                    <option value="3" {{ $registration->certificate_progress == 3 ? 'selected' : '' }}>Released</option>
                                </select>
                                @error('certificate_progress')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <hr>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa fa-fw fa-file-upload mr-2"></i> Update Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.custom-file-input').on('change', function(e) {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>
@endsection
