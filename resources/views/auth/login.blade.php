@extends('layouts.app_login')
@section('title') connexion  @endsection
@section('content')
<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="row w-100">
      <div class="content-wrapper full-page-wrapper auth login-2 login-bg">
        <div class="card col-lg-4">
          <div class="card-body px-5 py-5">

            <div class="row m-5">
              <div class="sidebar-brand-wrapper d-lg-flex align-items-center justify-content-center ">
                <a class="sidebar-brand brand-logo" href="index.html"><img src="{{asset('assets/images/logo.png')}}" alt="logo"></a>
              </div>
            </div>
            <h3 class="card-title text-start mb-3">Login</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf()
              <div class="form-group">
                <label>Email *</label>
                <input type="email" class="form-control p_input @error('email') is-invalid @enderror " id="email" name="email" aria-describedby="emailHelp"  >
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Password *</label>
                <input  class="form-control p_input @error('password') is-invalid @enderror" name="password"  id="password" type="password" >
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
              </div>
              <p>
                Admin Access : Email : admin@gmail.com | password : admin<br /><br />
                Manager Access : Email : manager@gmail.com | password : manager</p>

            </form>
          </div>

        </div>
        <div class="col-lg-8"></div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- row ends -->
  </div>


<!-- end row -->

      </div>



@endsection
