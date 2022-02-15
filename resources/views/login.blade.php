@extends('template')

@section('konten')
    <div class="container-fluid col-md-3">
        <div class="row mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="card-text">
                        Masuk Ke sistem
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email" aria-describedby="helpId" class="form-control">
                        <small class="text-muted" id="helpId">Email</small>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password" aria-describedby="helppass" class="form-control">
                        <small class="text-muted" id="helppass">Password</small>
                    </div>
                    <button class="btn btn-sm btn-primary float-end" id="btn-login">Login</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('/assets/pages/login.js', []) }}"></script>
@endsection