@extends('layouts.app')

@section('content')

    <div class="container my-5">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {{--                    <label for="type" class="form-label">Choose Type</label>--}}
                    <select name="type" id="type" class="form-control">
                        <option label="Choose Type"></option>
                        <option value="admin">Admin</option>
                        <option value="user">user</option>
                    </select>
                </div>
                @if(session()->has('login-error'))
                    <div class="alert alert-danger">
                        <p>{{ session()->get('login-error') }}</p>
                    </div>
                @endif
                <div class="panel" id="admin">
                    <h2>Login as Admin</h2>
                    <form action="{{ route('login.admin') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember" id="remember" class="form-check">
                            <label for="remember" class="form-check-label">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
                <div class="panel" id="user">
                    <h2>Login as User</h2>
                    <form action="{{ url('/login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember" id="remember" class="form-check">
                            <label for="remember" class="form-check-label">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra-js')

    <script>
        let type = document.querySelector('#type')
        type.addEventListener('change', event => {
            let typeID = event.target.value
            let forms = document.querySelectorAll('.panel')
            forms.forEach(item => {
                item.getAttribute('id') === typeID ? item.style.display = 'block' : item.style.display = 'none'
            })
        })

    </script>

@endsection
