@extends('layouts.app')
@section('title') connexion  @endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Location </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Location</li>
        </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('location.store') }}" class="needs-validation example-form"  novalidate>
                    @csrf

                        <div>
                        <h3>Server</h3>
                          <section >
                            <div class="row">
                            <h3 class="mb-2">Info</h3>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Server name</label>
                                  <input type="text" class="form-control"  placeholder="Server name" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-sm-12 col-form-label">Network Server Type</label>
                                  <div class="col-sm-4">
                                    <div class="form-check m-0">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="" id="" value="screen" checked=""> screen <i class="input-helper"></i></label>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div>
                            <div class="row">
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Screen Model </label>
                                  <select class="form-control" id="screen-model">
                                    <option>Dolby</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Audiotorium </label>
                                  <select class="form-control" id="screen-model">
                                    <option>Dolby</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Playback </label>
                                  <select class="form-control" id="screen-model">
                                    <option>Dolby</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Sound </label>
                                  <select class="form-control" id="screen-model">
                                    <option>3D</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <h3 class="mb-2 mt-5">Server Group ( Request for Ingest )</h3>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Server IP</label>
                                  <input type="text" class="form-control"  placeholder="Server name">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Ingest Protocol</label>
                                  <input type="text" class="form-control"  placeholder="Server name">
                                </div>
                              </div>

                            </div>
                            <div class="row">

                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Username</label>
                                  <input type="text" class="form-control"  placeholder="Server name">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Password</label>
                                  <input type="password" class="form-control"  placeholder="Server name">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Remote Path</label>
                                  <input type="text" class="form-control"  placeholder="Server name">
                                </div>
                              </div>

                            </div>
                            <div class="row">
                              <h3 class="mb-2 mt-5">Admin Group ( Required For Administration )</h3>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Management IP </label>
                                  <input type="text" class="form-control"  placeholder="Management IP">
                                </div>
                              </div>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Ingest Protocol </label>
                                  <select class="form-control" id="screen-model">
                                    <option>FTP</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Username </label>
                                  <input type="text" class="form-control"  placeholder="Username">
                                </div>
                              </div>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Password </label>
                                  <input type="password" class="form-control"  placeholder="Password">
                                </div>
                              </div>
                            </div>
                          </section>
                          <h3>Server</h3>
                          <section >
                            <div class="row">
                            <h3 class="mb-2">Info</h3>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Server name</label>
                                  <input type="text" class="form-control"  placeholder="Server name">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-sm-12 col-form-label">Network Server Type</label>
                                  <div class="col-sm-4">
                                    <div class="form-check m-0">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="" id="" value="screen" checked=""> screen <i class="input-helper"></i></label>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div>
                            <div class="row">
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Screen Model </label>
                                  <select class="form-control" id="screen-model">
                                    <option>Dolby</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Audiotorium </label>
                                  <select class="form-control" id="screen-model">
                                    <option>Dolby</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Playback </label>
                                  <select class="form-control" id="screen-model">
                                    <option>Dolby</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Sound </label>
                                  <select class="form-control" id="screen-model">
                                    <option>3D</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <h3 class="mb-2 mt-5">Server Group ( Request for Ingest )</h3>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Server IP</label>
                                  <input type="text" class="form-control"  placeholder="Server name">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Ingest Protocol</label>
                                  <input type="text" class="form-control"  placeholder="Server name">
                                </div>
                              </div>

                            </div>
                            <div class="row">

                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Username</label>
                                  <input type="text" class="form-control"  placeholder="Server name">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Password</label>
                                  <input type="password" class="form-control"  placeholder="Server name">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Remote Path</label>
                                  <input type="text" class="form-control"  placeholder="Server name">
                                </div>
                              </div>

                            </div>
                            <div class="row">
                              <h3 class="mb-2 mt-5">Admin Group ( Required For Administration )</h3>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Management IP </label>
                                  <input type="text" class="form-control"  placeholder="Management IP">
                                </div>
                              </div>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Ingest Protocol </label>
                                  <select class="form-control" id="screen-model">
                                    <option>FTP</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Username </label>
                                  <input type="text" class="form-control"  placeholder="Username">
                                </div>
                              </div>
                              <div class="col-xl-3">
                                <div class="form-group">
                                  <label for="screen-model"> Password </label>
                                  <input type="password" class="form-control"  placeholder="Password">
                                </div>
                              </div>
                            </div>
                          </section>

                        </div>

                </form>

            </div>
          </div>
        </div>
      </div>



@endsection

@section('custom_script')
<script src="{{asset('/assets/vendors/jquery-steps/jquery.steps.min.js')}}"></script>
<script src="{{asset('/assets/js/wizard.js')}}"></script>
    <script>

    // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script>

@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
@endsection
