@extends('layouts.main')

@section('title', 'Contact App | Settings | Edit Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/jasny-bootstrap.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
@endpush

@section('content')
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Settings
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action {{ request()->routeIs('settings.profile.*') ? 'active' : '' }}">Profile</a>
                            <a href="#" class="list-group-item list-group-item-action {{ request()->routeIs('settings.account.*') ? 'active' : '' }}">Account</a>
                            <a href="#" class="list-group-item list-group-item-action">Import & Export</a>
                        </div>
                    </div>
                </div><!-- /.col-md-3 -->

                <div class="col-md-9">
                    @include('layouts._message')
                    <form action="{{ route('settings.profile.update', $user) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card">
                            <div class="card-header card-title">
                                <strong>Edit Profile</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user) }}" class="form-control @error('first_name') is-invalid @enderror">
                                            @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user) }}" class="form-control @error('last_name') is-invalid @enderror">
                                            @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="company">Company</label>
                                            <input type="text" name="company" id="company" value="{{ old('company', $user) }}" class="form-control @error('company') is-invalid @enderror">
                                            @error('company')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="bio">Bio</label>
                                            <textarea name="bio" id="biod" rows="3" class="form-control @error('bio') is-invalid @enderror">{{ old('bio', $user) }}</textarea>
                                            @error('bio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="offset-md-1 col-md-3">
                                        <div class="form-group">
                                            <label for="bio">Profile picture</label>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new img-thumbnail" style="width: 150px; height: 150px;">
                                                    <img src="{{ $user->profileUrl() }}" alt="{{ $user->name }}">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 150px; max-height: 150px;"></div>
                                                <div class="mt-2">
                                                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="profile_picture" accept="image/*"></span>
                                                    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                            @error('bio')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-6">
                                                <button type="submit" class="btn btn-success">Update Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
