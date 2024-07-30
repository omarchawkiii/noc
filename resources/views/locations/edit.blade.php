@extends('layouts.app')
@section('title') Edit Location  @endsection
@section('content')



    <div class="page-header playbck-shadow">
        <h3 class="page-title"> Location </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Location</li>
        </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('location.update', $location) }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <h3 class="m-4 text-center">Location Configuration</h3>
                        <div class="col-md-4">
                            <div class="form-group  has-validation">
                                <label>Location Name</label>
                                <input type="text" class="form-control" placeholder="Location Name"  value="{{ $location->name }}"  name="name"  required>
                                @error('name')
                                    <div class="text-danger mt-1 ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Connection IP</label>
                                <input type="text" class="form-control" placeholder="Connection IP"  value="{{ $location->connection_ip }}"  name="connection_ip" required>
                                @error('connection_ip')
                                    <div class="text-danger mt-1 ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="screen-model"> TMS System </label>
                                <select class="form-control" id="screen-model"   name="tms_system" required>
                                    <option value="Expersys TMS" {{ $location->tms_system == 'Expersys TMS' ? 'selected' : '' }} >Expersys TMS </option>
                                    <option value="TMS" {{ $location->tms_system == 'TMS' ? 'selected' : '' }}>TMS</option>

                                </select>
                                @error('tms_system')
                                    <div class="text-danger mt-1 ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <h3 class="m-4 text-center">Location KDM Receiver</h3>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" placeholder="Username"  value=" {{  $location->email }}"  name="email">
                                @error('email')
                                    <div class="text-danger mt-1 ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" placeholder="Password"  value="{{ $location->password }}"  name="password">
                                @error('password')
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
                            <input type="text" class="form-control" placeholder="Location E-mail"  value="{{ $location->location_email }}"  name="location_email">
                            @error('location_email')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" placeholder="Phone Number"  value="{{ $location->phone }}"  name="phone">
                            @error('phone')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" placeholder="Address"  value="{{ $location->address }}"  name="address" required>
                            @error('address')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" placeholder="City"  value="{{ $location->city }}"  name="city" required>
                            @error('city')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Zip Code</label>
                            <input type="text" class="form-control" placeholder="Zip Code"  value="{{ $location->zip }}"  name="zip" required>
                            @error('zip')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="screen-model"> Country </label>
                            <select class="form-control form-select" id="screen-model"  value="{{ $location->country }}"  name="country" required>
                                <option selected disabled value=""> Select Country</option>
                                <option {{ $location->country == 'Afghanistan' ? 'selected' : '' }} value="Afghanistan"> Afghanistan </option>
                                <option {{ $location->country == 'Albania' ? 'selected' : '' }} value="Albania"> Albania </option>
                                <option {{ $location->country == 'Algeria' ? 'selected' : '' }} value="Algeria"> Algeria </option>
                                <option {{ $location->country == 'Andorra' ? 'selected' : '' }} value="Andorra"> Andorra </option>
                                <option {{ $location->country == 'Angola' ? 'selected' : '' }} value="Angola"> Angola </option>
                                <option {{ $location->country == 'Argentina' ? 'selected' : '' }} value="Argentina"> Argentina </option>
                                <option {{ $location->country == 'Armenia' ? 'selected' : '' }} value="Armenia"> Armenia </option>
                                <option {{ $location->country == 'Australia' ? 'selected' : '' }} value="Australia"> Australia </option>
                                <option {{ $location->country == 'Austria' ? 'selected' : '' }} value="Austria"> Austria </option>
                                <option {{ $location->country == 'Azerbaijan' ? 'selected' : '' }} value="Azerbaijan"> Azerbaijan </option>
                                <option {{ $location->country == 'Bahamas' ? 'selected' : '' }} value="Bahamas"> Bahamas </option>
                                <option {{ $location->country == 'Bahrain' ? 'selected' : '' }} value="Bahrain"> Bahrain </option>
                                <option {{ $location->country == 'Bangladesh' ? 'selected' : '' }} value="Bangladesh"> Bangladesh </option>
                                <option {{ $location->country == 'Barbados' ? 'selected' : '' }} value="Barbados"> Barbados </option>
                                <option {{ $location->country == 'Belarus' ? 'selected' : '' }} value="Belarus"> Belarus </option>
                                <option {{ $location->country == 'Belgium' ? 'selected' : '' }} value="Belgium"> Belgium </option>
                                <option {{ $location->country == 'Belize' ? 'selected' : '' }} value="Belize"> Belize </option>
                                <option {{ $location->country == 'Benin' ? 'selected' : '' }} value="Benin"> Benin </option>
                                <option {{ $location->country == 'Bhutan' ? 'selected' : '' }} value="Bhutan"> Bhutan </option>
                                <option {{ $location->country == 'Bolivia' ? 'selected' : '' }} value="Bolivia"> Bolivia </option>
                                <option {{ $location->country == 'Botswana' ? 'selected' : '' }} value="Botswana"> Botswana </option>
                                <option {{ $location->country == 'Brazil' ? 'selected' : '' }} value="Brazil"> Brazil </option>
                                <option {{ $location->country == 'Brunei' ? 'selected' : '' }} value="Brunei "> Brunei  </option>
                                <option {{ $location->country == 'Bulgaria' ? 'selected' : '' }} value="Bulgaria"> Bulgaria </option>
                                <option {{ $location->country == ' BurkiFaso' ? 'selected' : '' }} value=""> BurkiFaso na Faso </option>
                                <option {{ $location->country == 'Burundi' ? 'selected' : '' }} value="Burundi"> Burundi </option>
                                <option {{ $location->country == ' CôteIvoire' ? 'selected' : '' }} value=""> CôteIvoire  d'Ivoire </option>
                                <option {{ $location->country == ' CaVerde' ? 'selected' : '' }} value=""> CaVerde bo Verde </option>
                                <option {{ $location->country == 'Cambodia' ? 'selected' : '' }} value="Cambodia"> Cambodia </option>
                                <option {{ $location->country == 'Cameroon' ? 'selected' : '' }} value="Cameroon"> Cameroon </option>
                                <option {{ $location->country == 'Canada' ? 'selected' : '' }} value="Canada"> Canada </option>
                                <option {{ $location->country == ' Central' ? 'selected' : '' }} value=""> Central AfricRepublic an Republic </option>
                                <option {{ $location->country == 'Chad' ? 'selected' : '' }} value="Chad"> Chad </option>
                                <option {{ $location->country == 'Chile' ? 'selected' : '' }} value="Chile"> Chile </option>
                                <option {{ $location->country == 'China' ? 'selected' : '' }} value="China"> China </option>
                                <option {{ $location->country == 'Colombia' ? 'selected' : '' }} value="Colombia"> Colombia </option>
                                <option {{ $location->country == 'Comoros' ? 'selected' : '' }} value="Comoros"> Comoros </option>
                                <option {{ $location->country == 'Congo' ? 'selected' : '' }} value="Congo (Brazzaville)"> Congo (Brazzaville)  </option>
                                <option {{ $location->country == 'Costa' ? 'selected' : '' }} value="Costa Rica"> Costa Rica </option>
                                <option {{ $location->country == 'Croatia' ? 'selected' : '' }} value="Croatia"> Croatia </option>
                                <option {{ $location->country == 'Cuba' ? 'selected' : '' }} value="Cuba"> Cuba </option>
                                <option {{ $location->country == 'Cyprus' ? 'selected' : '' }} value="Cyprus"> Cyprus </option>
                                <option {{ $location->country == 'Democratic' ? 'selected' : '' }} value="Democratic Republic of Congo"> Democratic Republic of Congo </option>
                                <option {{ $location->country == 'Denmark' ? 'selected' : '' }} value="Denmark"> Denmark </option>
                                <option {{ $location->country == 'Djibouti' ? 'selected' : '' }} value="Djibouti"> Djibouti </option>
                                <option {{ $location->country == 'Dominica' ? 'selected' : '' }} value="Dominica"> Dominica </option>
                                <option {{ $location->country == 'Dominic' ? 'selected' : '' }} value="Dominic Republic"> Dominic Republic </option>
                                <option {{ $location->country == 'Ecuador' ? 'selected' : '' }} value="Ecuador"> Ecuador </option>
                                <option {{ $location->country == 'Egypt' ? 'selected' : '' }} value="Egypt"> Egypt </option>
                                <option {{ $location->country == 'Salvador' ? 'selected' : '' }} value="Salvador"> Salvador </option>
                                <option {{ $location->country == 'Eritrea' ? 'selected' : '' }} value="Eritrea"> Eritrea </option>
                                <option {{ $location->country == 'Estonia' ? 'selected' : '' }} value="Estonia"> Estonia </option>
                                <option {{ $location->country == 'Ethiopia' ? 'selected' : '' }} value="Ethiopia"> Ethiopia </option>
                                <option {{ $location->country == 'Fiji' ? 'selected' : '' }} value="Fiji"> Fiji </option>
                                <option {{ $location->country == 'Finland' ? 'selected' : '' }} value="Finland"> Finland </option>
                                <option {{ $location->country == 'France' ? 'selected' : '' }} value="France"> France </option>
                                <option {{ $location->country == 'Gabon' ? 'selected' : '' }} value="Gabon"> Gabon </option>
                                <option {{ $location->country == 'Gambia' ? 'selected' : '' }} value="Gambia"> Gambia </option>
                                <option {{ $location->country == 'Georgia' ? 'selected' : '' }} value="Georgia"> Georgia </option>
                                <option {{ $location->country == 'Germany' ? 'selected' : '' }} value="Germany"> Germany </option>
                                <option {{ $location->country == 'Ghana' ? 'selected' : '' }} value="Ghana"> Ghana </option>
                                <option {{ $location->country == 'Greece' ? 'selected' : '' }} value="Greece"> Greece </option>
                                <option {{ $location->country == 'Grenada' ? 'selected' : '' }} value="Grenada"> Grenada </option>
                                <option {{ $location->country == 'Guatemala' ? 'selected' : '' }} value="Guatemala"> Guatemala </option>
                                <option {{ $location->country == 'Guinea' ? 'selected' : '' }} value="Guinea"> Guinea </option>
                                <option {{ $location->country == 'Guyana' ? 'selected' : '' }} value="Guyana"> Guyana </option>
                                <option {{ $location->country == 'Haiti' ? 'selected' : '' }} value="Haiti"> Haiti </option>
                                <option {{ $location->country == 'Honduras' ? 'selected' : '' }} value="Honduras"> Honduras </option>
                                <option {{ $location->country == 'Hungary' ? 'selected' : '' }} value="Hungary"> Hungary </option>
                                <option {{ $location->country == 'Iceland' ? 'selected' : '' }} value="Iceland"> Iceland </option>
                                <option {{ $location->country == 'India' ? 'selected' : '' }} value="India"> India </option>
                                <option {{ $location->country == 'Indonesia' ? 'selected' : '' }} value="Indonesia"> Indonesia </option>
                                <option {{ $location->country == 'Iran' ? 'selected' : '' }} value="Iran"> Iran </option>
                                <option {{ $location->country == 'Iraq' ? 'selected' : '' }} value="Iraq"> Iraq </option>
                                <option {{ $location->country == 'Ireland' ? 'selected' : '' }} value="Ireland"> Ireland </option>
                                <option {{ $location->country == 'Italy' ? 'selected' : '' }} value="Italy"> Italy </option>
                                <option {{ $location->country == 'Jamaica' ? 'selected' : '' }} value="Jamaica"> Jamaica </option>
                                <option {{ $location->country == 'Japan' ? 'selected' : '' }} value="Japan"> Japan </option>
                                <option {{ $location->country == 'Jordan' ? 'selected' : '' }} value="Jordan"> Jordan </option>
                                <option {{ $location->country == 'Kazakhstan' ? 'selected' : '' }} value="Kazakhstan"> Kazakhstan </option>
                                <option {{ $location->country == 'Kenya' ? 'selected' : '' }} value="Kenya"> Kenya </option>
                                <option {{ $location->country == 'Kiribati' ? 'selected' : '' }} value="Kiribati"> Kiribati </option>
                                <option {{ $location->country == 'Kuwait' ? 'selected' : '' }} value="Kuwait"> Kuwait </option>
                                <option {{ $location->country == 'Kyrgyzstan' ? 'selected' : '' }} value="Kyrgyzstan"> Kyrgyzstan </option>
                                <option {{ $location->country == 'Laos' ? 'selected' : '' }} value="Laos"> Laos </option>
                                <option {{ $location->country == 'Latvia' ? 'selected' : '' }} value="Latvia"> Latvia </option>
                                <option {{ $location->country == 'Lebanon' ? 'selected' : '' }} value="Lebanon"> Lebanon </option>
                                <option {{ $location->country == 'Lesotho' ? 'selected' : '' }} value="Lesotho"> Lesotho </option>
                                <option {{ $location->country == 'Liberia' ? 'selected' : '' }} value="Liberia"> Liberia </option>
                                <option {{ $location->country == 'Libya' ? 'selected' : '' }} value="Libya"> Libya </option>
                                <option {{ $location->country == 'Liechtenstein' ? 'selected' : '' }} value="Liechtenstein"> Liechtenstein </option>
                                <option {{ $location->country == 'Lithuania' ? 'selected' : '' }} value="Lithuania"> Lithuania </option>
                                <option {{ $location->country == 'Luxembourg' ? 'selected' : '' }} value="Luxembourg"> Luxembourg </option>
                                <option {{ $location->country == 'Madagascar' ? 'selected' : '' }} value="Madagascar"> Madagascar </option>
                                <option {{ $location->country == 'Malawi' ? 'selected' : '' }} value="Malawi"> Malawi </option>
                                <option {{ $location->country == 'Malaysia' ? 'selected' : '' }} value="Malaysia"> Malaysia </option>
                                <option {{ $location->country == 'Maldives' ? 'selected' : '' }} value="Maldives"> Maldives </option>
                                <option {{ $location->country == 'Mali' ? 'selected' : '' }} value="Mali"> Mali </option>
                                <option {{ $location->country == 'Malta' ? 'selected' : '' }} value="Malta"> Malta </option>
                                <option {{ $location->country == 'Mauritania' ? 'selected' : '' }} value="Mauritania"> Mauritania </option>
                                <option {{ $location->country == 'Mauritius' ? 'selected' : '' }} value="Mauritius"> Mauritius </option>
                                <option {{ $location->country == 'Mexico' ? 'selected' : '' }} value="Mexico"> Mexico </option>
                                <option {{ $location->country == 'Micronesia' ? 'selected' : '' }} value="Micronesia"> Micronesia </option>
                                <option {{ $location->country == 'Moldova' ? 'selected' : '' }} value="Moldova"> Moldova </option>
                                <option {{ $location->country == 'Monaco' ? 'selected' : '' }} value="Monaco"> Monaco </option>
                                <option {{ $location->country == 'Mongolia' ? 'selected' : '' }} value="Mongolia"> Mongolia </option>
                                <option {{ $location->country == 'Montenegro' ? 'selected' : '' }} value="Montenegro"> Montenegro </option>
                                <option {{ $location->country == 'Morocco' ? 'selected' : '' }} value="Morocco"> Morocco </option>
                                <option {{ $location->country == 'Mozambique' ? 'selected' : '' }} value="Mozambique"> Mozambique </option>
                                <option {{ $location->country == 'Namibia' ? 'selected' : '' }} value="Namibia"> Namibia </option>
                                <option {{ $location->country == 'Nauru' ? 'selected' : '' }} value="Nauru"> Nauru </option>
                                <option {{ $location->country == 'Nepal' ? 'selected' : '' }} value="Nepal"> Nepal </option>
                                <option {{ $location->country == 'Netherlands' ? 'selected' : '' }} value="Netherlands"> Netherlands </option>
                                <option {{ $location->country == ' NZealand' ? 'selected' : '' }} value=""> NZealand ew Zealand </option>
                                <option {{ $location->country == 'Nicaragua' ? 'selected' : '' }} value="Nicaragua"> Nicaragua </option>
                                <option {{ $location->country == 'Niger' ? 'selected' : '' }} value="Niger"> Niger </option>
                                <option {{ $location->country == 'Nigeria' ? 'selected' : '' }} value="Nigeria"> Nigeria </option>
                                <option {{ $location->country == ' NorKorea' ? 'selected' : '' }} value=""> NorKorea th Korea </option>
                                <option {{ $location->country == ' NorMacedonia' ? 'selected' : '' }} value=""> NorMacedonia th Macedonia </option>
                                <option {{ $location->country == 'Norway' ? 'selected' : '' }} value="Norway"> Norway </option>
                                <option {{ $location->country == 'Oman' ? 'selected' : '' }} value="Oman"> Oman </option>
                                <option {{ $location->country == 'Pakistan' ? 'selected' : '' }} value="Pakistan"> Pakistan </option>
                                <option {{ $location->country == 'Palau' ? 'selected' : '' }} value="Palau"> Palau </option>
                                <option {{ $location->country == 'Palestine' ? 'selected' : '' }} value="Palestine"> Palestine </option>
                                <option {{ $location->country == 'Panama' ? 'selected' : '' }} value="Panama"> Panama </option>
                                <option {{ $location->country == 'Paraguay' ? 'selected' : '' }} value="Paraguay"> Paraguay </option>
                                <option {{ $location->country == 'Peru' ? 'selected' : '' }} value="Peru"> Peru </option>
                                <option {{ $location->country == 'Philippines' ? 'selected' : '' }} value="Philippines"> Philippines </option>
                                <option {{ $location->country == 'Poland' ? 'selected' : '' }} value="Poland"> Poland </option>
                                <option {{ $location->country == 'Portugal' ? 'selected' : '' }} value="Portugal"> Portugal </option>
                                <option {{ $location->country == 'Qatar' ? 'selected' : '' }} value="Qatar"> Qatar </option>
                                <option {{ $location->country == 'Romania' ? 'selected' : '' }} value="Romania"> Romania </option>
                                <option {{ $location->country == 'Russia' ? 'selected' : '' }} value="Russia"> Russia </option>
                                <option {{ $location->country == 'Rwanda' ? 'selected' : '' }} value="Rwanda"> Rwanda </option>
                                <option {{ $location->country == 'Samoa' ? 'selected' : '' }} value="Samoa"> Samoa </option>
                                <option {{ $location->country == 'Saudi' ? 'selected' : '' }} value="Saudi Arabia"> Saudi Arabia </option>
                                <option {{ $location->country == 'Senegal' ? 'selected' : '' }} value="Senegal"> Senegal </option>
                                <option {{ $location->country == 'Serbia' ? 'selected' : '' }} value="Serbia"> Serbia </option>
                                <option {{ $location->country == 'Seychelles' ? 'selected' : '' }} value="Seychelles"> Seychelles </option>
                                <option {{ $location->country == 'Singapore' ? 'selected' : '' }} value="Singapore"> Singapore </option>
                                <option {{ $location->country == 'Slovakia' ? 'selected' : '' }} value="Slovakia"> Slovakia </option>
                                <option {{ $location->country == 'Slovenia' ? 'selected' : '' }} value="Slovenia"> Slovenia </option>
                                <option {{ $location->country == 'Somalia' ? 'selected' : '' }} value="Somalia"> Somalia </option>
                                <option {{ $location->country == ' SouAfrica' ? 'selected' : '' }} value=""> SouAfrica th Africa </option>
                                <option {{ $location->country == 'SouKorea' ? 'selected' : '' }} value="SouKorea"> SouKorea </option>
                                <option {{ $location->country == 'South' ? 'selected' : '' }} value="South Sudan"> South Sudan </option>
                                <option {{ $location->country == 'Spain' ? 'selected' : '' }} value="Spain"> Spain </option>
                                <option {{ $location->country == ' SLanka' ? 'selected' : '' }} value=""> SLanka ri Lanka </option>
                                <option {{ $location->country == 'Sudan' ? 'selected' : '' }} value="Sudan"> Sudan </option>
                                <option {{ $location->country == 'Suriname' ? 'selected' : '' }} value="Suriname"> Suriname </option>
                                <option {{ $location->country == 'Sweden' ? 'selected' : '' }} value="Sweden"> Sweden </option>
                                <option {{ $location->country == 'Switzerland' ? 'selected' : '' }} value="Switzerland"> Switzerland </option>
                                <option {{ $location->country == 'Syria' ? 'selected' : '' }} value="Syria"> Syria </option>
                                <option {{ $location->country == 'Tajikistan' ? 'selected' : '' }} value="Tajikistan"> Tajikistan </option>
                                <option {{ $location->country == 'Tanzania' ? 'selected' : '' }} value="Tanzania"> Tanzania </option>
                                <option {{ $location->country == 'Thailand' ? 'selected' : '' }} value="Thailand"> Thailand </option>
                                <option {{ $location->country == 'Togo' ? 'selected' : '' }} value="Togo"> Togo </option>
                                <option {{ $location->country == 'Tonga' ? 'selected' : '' }} value="Tonga"> Tonga </option>
                                <option {{ $location->country == 'Tunisia' ? 'selected' : '' }} value="Tunisia"> Tunisia </option>
                                <option {{ $location->country == 'Turkey' ? 'selected' : '' }} value="Turkey"> Turkey </option>
                                <option {{ $location->country == 'Turkmenistan' ? 'selected' : '' }} value="Turkmenistan"> Turkmenistan </option>
                                <option {{ $location->country == 'Tuvalu' ? 'selected' : '' }} value="Tuvalu"> Tuvalu </option>
                                <option {{ $location->country == 'Uganda' ? 'selected' : '' }} value="Uganda"> Uganda </option>
                                <option {{ $location->country == 'Ukraine' ? 'selected' : '' }} value="Ukraine"> Ukraine </option>
                                <option {{ $location->country == 'United' ? 'selected' : '' }} value="United Emirates"> United Emirates </option>
                                <option {{ $location->country == 'United' ? 'selected' : '' }} value="United Kingdom"> United Kingdom </option>
                                <option {{ $location->country == ' United' ? 'selected' : '' }} value=" United States  of America"> United States  of America </option>
                                <option {{ $location->country == 'Uruguay' ? 'selected' : '' }} value="Uruguay"> Uruguay </option>
                                <option {{ $location->country == 'Uzbekistan' ? 'selected' : '' }} value="Uzbekistan"> Uzbekistan </option>
                                <option {{ $location->country == 'Vanuatu' ? 'selected' : '' }} value="Vanuatu"> Vanuatu </option>
                                <option {{ $location->country == 'Venezuela' ? 'selected' : '' }} value="Venezuela"> Venezuela </option>
                                <option {{ $location->country == 'Vietnam' ? 'selected' : '' }} value="Vietnam"> Vietnam </option>
                                <option {{ $location->country == 'Yemen' ? 'selected' : '' }} value="Yemen"> Yemen </option>
                                <option {{ $location->country == 'Zambia' ? 'selected' : '' }} value="Zambia"> Zambia </option>
                                <option {{ $location->country == 'Zimbabwe' ? 'selected' : '' }} value="Zimbabwe"> Zimbabwe </option>
                            </select>
                            @error('country')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="screen-model"> status </label>
                            <select class="form-control" id="screen-model"  value="{{ $location->state }}"  name="state" required>
                                <option value="Activate" {{ $location->state == 'Activate' ? 'selected' : '' }}> Activate </option>
                                <option value="Pending" {{ $location->state == 'Pending' ? 'selected' : '' }}> Pending </option>

                            </select>
                            @error('state')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Company / Owner </label>
                            <input type="text" class="form-control" placeholder="Company / Owner"  value="{{ $location->company }}"  name="company">
                            @error('company')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Latitude </label>
                            <input type="text" class="form-control" placeholder="Latitude"  value="{{ $location->latitude }}"  name="latitude">
                            @error('latitude')
                                <div class="text-danger mt-1 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" class="form-control" placeholder="Longitude" value="{{ $location->longitude }}"  name="longitude">
                            @error('longitude')
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

        (function () {
        'use strict'

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


