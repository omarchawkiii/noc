@extends('layouts.app')
@section('title') connexion  @endsection
@section('content')
    <div class="page-header playbck-shadow">
        <h3 class="page-title "> Location </h3>
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
                <form method="POST" action="{{ route('location.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                    <h3 class="m-4 text-center">Location Configuration</h3>
                    <div class="col-md-4">
                        <div class="form-group  has-validation">
                            <label>Location Name</label>
                            <input type="text" class="form-control" placeholder="Location Name"  value="{{ old('name') }}"  name="name"  required>
                            @error('name')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Report Folder Title</label>
                            <input type="text" class="form-control" placeholder="Report Folder Title"  value="{{ old('folder_title') }}"  name="folder_title" required>
                            @error('folder_title')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Connection IP</label>
                            <input type="text" class="form-control" placeholder="Connection IP"  value="{{ old('connection_ip') }}"  name="connection_ip" required>
                            @error('connection_ip')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="screen-model"> TMS System </label>
                            <select class="form-control" id="screen-model"   name="tms_system" required>
                                <option value="Doremi TMS" {{ old('tms_system') == 'Doremi TMS' ? 'selected' : '' }} >Doremi TMS </option>
                                <option value="TMS" {{ old('tms_system') == 'TMS' ? 'selected' : '' }}>TMS</option>

                            </select>
                            @error('tms_system')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Rentrak ID</label>
                            <input type="text" class="form-control" placeholder="Rentrak ID"    value="{{ old('connection_ip') }}"   name="rentrak_id" required>
                            @error('rentrak_id')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    </div>

                    <div class="row">
                        <h3 class="m-4 text-center">Location KDM Receiver</h3>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="screen-model"> Type </label>
                                <select class="form-control" id="screen-model"   name="type">
                                    <option value="IMAP" {{ old('type') == 'IMAP' ? 'selected' : '' }}>IMAP </option>
                                    <option value="POP" {{ old('type') == 'POP' ? 'selected' : '' }}>POP</option>
                                </select>
                                @error('type')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hostname</label>
                                <input type="text" class="form-control" placeholder="Hostname"  value="{{ old('hostname') }}"  name="hostname">
                                @error('hostname')
                                    <div class="text-danger mt-1 ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>E-mail Account</label>
                                <input type="email" class="form-control" placeholder="E-mail Account"  value="{{ old('email') }}"  name="email">
                                @error('email')
                                    <div class="text-danger mt-1 ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" placeholder="Password"  value="{{ old('password') }}"  name="password">
                                @error('password')
                                    <div class="text-danger mt-1 ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Port</label>
                                <input type="text" class="form-control" placeholder="Port"  value="{{ old('port') }}"  name="port">
                                @error('port')
                                    <div class="text-danger mt-1 ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    <h3 class="m-4 text-center">Contact Informations</h3>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Location E-mail</label>
                            <input type="text" class="form-control" placeholder="Location E-mail"  value="{{ old('location_email') }}"  name="location_email">
                            @error('location_email')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" placeholder="Phone Number"  value="{{ old('phone') }}"  name="phone">
                            @error('phone')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Support E-mail</label>
                            <input type="text" class="form-control" placeholder="Support E-mail"  value="{{ old('support_email') }}"  name="support_email">
                            @error('support_email')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" placeholder="Address"  value="{{ old('address') }}"  name="address" required>
                            @error('address')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" placeholder="City"  value="{{ old('city') }}"  name="city" required>
                            @error('city')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Zip Code</label>
                            <input type="text" class="form-control" placeholder="Zip Code"  value="{{ old('zip') }}"  name="zip" required>
                            @error('zip')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="screen-model"> Country </label>
                            <select class="form-control form-select" id="screen-model"  value="{{ old('country') }}"  name="country" required>
                                <option selected disabled value=""> Select Country</option>
                                <option value="Afghanistan "> Afghanistan </option>
                                <option value="Albania "> Albania </option>
                                <option value="Algeria "> Algeria </option>
                                <option value="Andorra "> Andorra </option>
                                <option value="Angola "> Angola </option>

                                <option value="Argentina "> Argentina </option>
                                <option value="Armenia "> Armenia </option>
                                <option value="Australia "> Australia </option>
                                <option value="Austria "> Austria </option>
                                <option value="Azerbaijan "> Azerbaijan </option>
                                <option value="Bahamas "> Bahamas </option>
                                <option value="Bahrain "> Bahrain </option>
                                <option value="Bangladesh "> Bangladesh </option>
                                <option value="Barbados "> Barbados </option>
                                <option value="Belarus "> Belarus </option>
                                <option value="Belgium "> Belgium </option>
                                <option value="Belize "> Belize </option>
                                <option value="Benin "> Benin </option>
                                <option value="Bhutan "> Bhutan </option>
                                <option value="Bolivia "> Bolivia </option>

                                <option value="Botswana "> Botswana </option>
                                <option value="Brazil "> Brazil </option>
                                <option value="Brunei  "> Brunei  </option>
                                <option value="Bulgaria "> Bulgaria </option>
                                <option value=""> BurkiFaso na Faso </option>
                                <option value="Burundi "> Burundi </option>
                                <option value=""> CôteIvoire  d'Ivoire </option>
                                <option value=""> CaVerde bo Verde </option>
                                <option value="Cambodia "> Cambodia </option>
                                <option value="Cameroon "> Cameroon </option>
                                <option value="Canada "> Canada </option>
                                <option value=""> Central AfricRepublic an Republic </option>
                                <option value="Chad "> Chad </option>
                                <option value="Chile "> Chile </option>
                                <option value="China "> China </option>
                                <option value="Colombia "> Colombia </option>
                                <option value="Comoros "> Comoros </option>
                                <option value="Congo (Brazzaville) "> Congo (Brazzaville)  </option>
                                <option value="Costa Rica"> Costa Rica </option>
                                <option value="Croatia "> Croatia </option>
                                <option value="Cuba "> Cuba </option>
                                <option value="Cyprus "> Cyprus </option>

                                <option value="Democratic Republic of Congo "> Democratic Republic of Congo </option>
                                <option value="Denmark "> Denmark </option>
                                <option value="Djibouti "> Djibouti </option>
                                <option value="Dominica "> Dominica </option>
                                <option value="Dominic Republic"> Dominic Republic </option>
                                <option value="Ecuador "> Ecuador </option>
                                <option value="Egypt "> Egypt </option>
                                <option value="Salvador"> Salvador </option>

                                <option value="Eritrea "> Eritrea </option>
                                <option value="Estonia "> Estonia </option>

                                <option value="Ethiopia "> Ethiopia </option>
                                <option value="Fiji "> Fiji </option>
                                <option value="Finland "> Finland </option>
                                <option value="France "> France </option>
                                <option value="Gabon "> Gabon </option>
                                <option value="Gambia "> Gambia </option>
                                <option value="Georgia "> Georgia </option>
                                <option value="Germany "> Germany </option>
                                <option value="Ghana "> Ghana </option>
                                <option value="Greece "> Greece </option>
                                <option value="Grenada "> Grenada </option>
                                <option value="Guatemala "> Guatemala </option>
                                <option value="Guinea "> Guinea </option>

                                <option value="Guyana "> Guyana </option>
                                <option value="Haiti "> Haiti </option>

                                <option value="Honduras "> Honduras </option>
                                <option value="Hungary "> Hungary </option>
                                <option value="Iceland "> Iceland </option>
                                <option value="India "> India </option>
                                <option value="Indonesia "> Indonesia </option>
                                <option value="Iran "> Iran </option>
                                <option value="Iraq "> Iraq </option>
                                <option value="Ireland "> Ireland </option>
                                <option value="Italy "> Italy </option>
                                <option value="Jamaica "> Jamaica </option>
                                <option value="Japan "> Japan </option>
                                <option value="Jordan "> Jordan </option>
                                <option value="Kazakhstan "> Kazakhstan </option>
                                <option value="Kenya "> Kenya </option>
                                <option value="Kiribati "> Kiribati </option>
                                <option value="Kuwait "> Kuwait </option>
                                <option value="Kyrgyzstan "> Kyrgyzstan </option>
                                <option value="Laos "> Laos </option>
                                <option value="Latvia "> Latvia </option>
                                <option value="Lebanon "> Lebanon </option>
                                <option value="Lesotho "> Lesotho </option>
                                <option value="Liberia "> Liberia </option>
                                <option value="Libya "> Libya </option>
                                <option value="Liechtenstein "> Liechtenstein </option>
                                <option value="Lithuania "> Lithuania </option>
                                <option value="Luxembourg "> Luxembourg </option>
                                <option value="Madagascar "> Madagascar </option>
                                <option value="Malawi "> Malawi </option>
                                <option value="Malaysia "> Malaysia </option>
                                <option value="Maldives "> Maldives </option>
                                <option value="Mali "> Mali </option>
                                <option value="Malta "> Malta </option>
                                <option value="Mauritania "> Mauritania </option>
                                <option value="Mauritius "> Mauritius </option>
                                <option value="Mexico "> Mexico </option>
                                <option value="Micronesia "> Micronesia </option>
                                <option value="Moldova "> Moldova </option>
                                <option value="Monaco "> Monaco </option>
                                <option value="Mongolia "> Mongolia </option>
                                <option value="Montenegro "> Montenegro </option>
                                <option value="Morocco "> Morocco </option>
                                <option value="Mozambique "> Mozambique </option>
                                <option value="Namibia "> Namibia </option>
                                <option value="Nauru "> Nauru </option>
                                <option value="Nepal "> Nepal </option>
                                <option value="Netherlands "> Netherlands </option>
                                <option value=""> NZealand ew Zealand </option>
                                <option value="Nicaragua "> Nicaragua </option>
                                <option value="Niger "> Niger </option>
                                <option value="Nigeria "> Nigeria </option>
                                <option value=""> NorKorea th Korea </option>
                                <option value=""> NorMacedonia th Macedonia </option>
                                <option value="Norway "> Norway </option>
                                <option value="Oman "> Oman </option>
                                <option value="Pakistan "> Pakistan </option>
                                <option value="Palau "> Palau </option>
                                <option value="Palestine "> Palestine </option>
                                <option value="Panama "> Panama </option>
                                <option value="Paraguay "> Paraguay </option>
                                <option value="Peru "> Peru </option>
                                <option value="Philippines "> Philippines </option>
                                <option value="Poland "> Poland </option>
                                <option value="Portugal "> Portugal </option>
                                <option value="Qatar "> Qatar </option>
                                <option value="Romania "> Romania </option>
                                <option value="Russia "> Russia </option>
                                <option value="Rwanda "> Rwanda </option>
                                <option value="Samoa "> Samoa </option>
                                <option value="Saudi Arabia"> Saudi Arabia </option>
                                <option value="Senegal "> Senegal </option>
                                <option value="Serbia "> Serbia </option>
                                <option value="Seychelles "> Seychelles </option>
                                <option value="Singapore "> Singapore </option>
                                <option value="Slovakia "> Slovakia </option>
                                <option value="Slovenia "> Slovenia </option>
                                <option value="Somalia "> Somalia </option>
                                <option value=""> SouAfrica th Africa </option>
                                <option value="SouKorea"> SouKorea </option>
                                <option value="South Sudan"> South Sudan </option>
                                <option value="Spain "> Spain </option>
                                <option value=""> SLanka ri Lanka </option>
                                <option value="Sudan "> Sudan </option>
                                <option value="Suriname "> Suriname </option>
                                <option value="Sweden "> Sweden </option>
                                <option value="Switzerland "> Switzerland </option>
                                <option value="Syria "> Syria </option>
                                <option value="Tajikistan "> Tajikistan </option>
                                <option value="Tanzania "> Tanzania </option>
                                <option value="Thailand "> Thailand </option>
                                <option value="Togo "> Togo </option>
                                <option value="Tonga "> Tonga </option>
                                <option value="Tunisia "> Tunisia </option>
                                <option value="Turkey "> Turkey </option>
                                <option value="Turkmenistan "> Turkmenistan </option>
                                <option value="Tuvalu "> Tuvalu </option>
                                <option value="Uganda "> Uganda </option>
                                <option value="Ukraine "> Ukraine </option>
                                <option value="United Emirates"> United Emirates </option>
                                <option value="United Kingdom "> United Kingdom </option>
                                <option value=" United States  of America"> United States  of America </option>
                                <option value="Uruguay "> Uruguay </option>
                                <option value="Uzbekistan "> Uzbekistan </option>
                                <option value="Vanuatu "> Vanuatu </option>
                                <option value="Venezuela "> Venezuela </option>
                                <option value="Vietnam "> Vietnam </option>
                                <option value="Yemen "> Yemen </option>
                                <option value="Zambia "> Zambia </option>
                                <option value="Zimbabwe "> Zimbabwe </option>
                            </select>
                            @error('country')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="screen-model"> State </label>
                            <select class="form-control" id="screen-model"  value="{{ old('state') }}"  name="state" required>
                                <option value="Pending" {{ old('state') == 'Pending' ? 'selected' : '' }}> Pending </option>

                            </select>
                            @error('state')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Company / Owner </label>
                            <input type="text" class="form-control" placeholder="Company / Owner"  value="{{ old('company') }}"  name="company">
                            @error('company')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Language</label>
                            <input type="text" class="form-control" placeholder="Language"  value="{{ old('language') }}"  name="language">
                            @error('language')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    </div>
                    <div class=" m-2">
                    <button type="submit" class="btn btn-success me-2">Submit</button>
                    <button class="btn btn-dark">Cancel</button>
                    </div>

                </form>

            </div>
          </div>
        </div>
      </div>



@endsection

@section('custom_script')

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
