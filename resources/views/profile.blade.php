<!-- profile.blade.php -->

@extends('layouts.dashboard')

@section('content')

<!-- Profile Information -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    <!-- Display Profile Picture -->
<div class="text-center mb-4">
    <img  src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('sb-admin/img/undraw_profile.svg') }}" class="img-fluid rounded-circle" style="width: 150px; height: 150px;" alt="Profile Picture">
</div>

                    <!-- Change Profile Picture Form -->
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Pilih Foto</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" required>
                        </div>

                        <!-- Update Name -->
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>
                        </div>

                        <!-- Update Username -->
                        <div class="form-group">
                            <label for="username">{{ __('Username') }}</label>
                            <input id="username" type="text" class="form-control" name="username" value="{{ Auth::user()->username }}" required autocomplete="username">
                        </div>

                        <!-- Update Full Name -->
                        <div class="form-group">
                            <label for="namalengkap">{{ __('Full Name') }}</label>
                            <input id="namalengkap" type="text" class="form-control" name="namalengkap" value="{{ Auth::user()->namalengkap }}" required autocomplete="namalengkap">
                        </div>

                        <!-- Update Address -->
                        <div class="form-group">
                            <label for="alamat">{{ __('Address') }}</label>
                            <input id="alamat" type="text" class="form-control" name="alamat" value="{{ Auth::user()->alamat }}" required autocomplete="alamat">
                        </div>

                        <!-- Optionally Update Email -->
                        @if(Auth::user()->email)
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">
                        </div>
                        @endif

                        <!-- Submit Button -->
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
