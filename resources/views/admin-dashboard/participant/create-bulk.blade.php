@extends('layouts.admin-dasboard')

@section('content')
    <div class="mb-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Create Bulk Participant</h3>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('participant-save-bulk') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="participant_data">Upload Excel File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="participant_data" name="participant_data" required>
                                    <label class="custom-file-label" for="participant_data">Choose file...</label>
                                    @error('participant_data')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa fa-fw fa-file-upload mr-2"></i> Submit Participant
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
