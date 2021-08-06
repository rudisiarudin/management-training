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
                                <label for="training_id">Participant For Training</label>
                                <select id="training_id" class="form-control @error('training_id') is-invalid @enderror" name="training_id">
                                    <option value=""></option>
                                    @foreach($trainingSchedules as $training)
                                        <option value="{{ $training['id'] }}">{{ $training['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('training_id')
                                <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

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

            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h5>Example</h5>
                        <p>
                            Uploaded excel file must not be with header, and follow this order.
                            Dont forget to choose training schedule.
                        </p>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td><i>Name</i></td>
                                    <td><i>Address</i></td>
                                    <td><i>Email</i></td>
                                    <td><i>Phone</i></td>
                                    <td><i>Company</i></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
