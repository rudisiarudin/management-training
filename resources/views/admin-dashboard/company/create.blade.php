@extends('layouts.admin-dasboard')

@section('content')
    <div class="mb-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Create Company Data</h3>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('company-save') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')  }}">
                                @error('name')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="agent_name">Agent Name</label>
                                <input type="text" id="agent_name" class="form-control @error('agent_name') is-invalid @enderror" name="agent_name" value="{{ old('agent_name') }}">
                                @error('company')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Company Address</label>
                                <input type="text" id="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">
                                @error('address')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Company Email</label>
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="[phone]">Phone</label>
                                <input type="number" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="fax">Fax</label>
                                <input type="number" id="fax" class="form-control @error('fax') is-invalid @enderror" name="fax" value="{{ old('fax') }}">
                                @error('fax')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" cols="30" rows="6">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>

                            <hr>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa fa-fw fa-file-upload mr-2"></i> Submit Company Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="my-3">
                            <p>
                                Try new bulk add participant feature.
                                You can easily generate participant data with pre-templated excel.
                            </p>
                            <a href="" class="btn btn-secondary">
                                Try Bulk Create
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
