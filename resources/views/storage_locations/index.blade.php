@extends('layouts.app')
@section('title')
    Storage Location
@endsection
@section('content')
    <div class="page-header user-shadow">
        <h3 class="page-title ">Storage Locations </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Storage Locations</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">

                    <div>
                        <h4 class="card-title ">Storage Locations</h4>
                    </div>

                    <div>

                        <a id="create_storage_location_btn" class="btn btn-primary  btn-icon-text">
                            <i class="mdi mdi-plus btn-icon-prepend"></i> Create New Storage Location
                        </a>

                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="users-listing" class="table">
                            <thead>
                                <tr>
                                    <th class="sorting text-center  sorting_asc">Order #</th>
                                    <th class="sorting text-center ">Storage Location  Name</th>
                                    <th class="sorting text-center ">Storage Location Contact </th>
                                    <th class="sorting text-center ">Storage Location Email</th>
                                    <th class="sorting text-center ">Adress Line 1</th>
                                    <th class="sorting text-center ">Address Line 2</th>
                                    <th class="sorting text-center ">City</th>
                                    <th class="sorting text-center ">State</th>
                                    <th class="sorting text-center ">Zip Code</th>
                                    <th class="sorting text-center ">Country</th>
                                    <th class="sorting text-center ">option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($storage_locations as $key => $storage_location)
                                    <tr class="odd text-center  ">

                                        <td class="sorting_1">{{ $key + 1 }} </td>
                                        <td> {{ $storage_location->name }} </td>
                                        <td> {{ $storage_location->contact }} </td>
                                        <td> {{ $storage_location->email }} </td>
                                        <td> {{ $storage_location->adress_1 }} </td>
                                        <td> {{ $storage_location->adress_2 }} </td>
                                        <td> {{ $storage_location->cite }} </td>
                                        <td> {{ $storage_location->state }} </td>
                                        <td> {{ $storage_location->zip_code }} </td>
                                        <td> {{ $storage_location->country }} </td>
                                        <td>
                                            <button data-id="{{ $storage_location->id }}" type="button" class="btn btn-inverse-warning btn-icon m-1 edit"><i class="mdi mdi-border-color "></i></button>
                                            <button data-id="{{ $storage_location->id }}" type="button" class="btn btn-inverse-danger btn-icon m-1 delete"><i class="mdi mdi-delete-forever "></i></button>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="create_storage_location_modal" class="modal hide fade" role="dialog" aria-labelledby="edit_user_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  ">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5>Create New Storage Location </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div class="">
                        <form method="POST" id="create_storage_location_form" class="needs-validation" novalidate >
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Storage Location  Name </label>
                                        <input type="text" class="form-control" placeholder="Storage Location  Name "
                                            name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address" class="w-100 " style="text-align: left">Storage Location Adress</label>
                                        <textarea class="form-control" id="address" name="address" rows="4" placeholder="Storage Location Adress"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Storage Location Contact  </label>
                                        <input type="text" class="form-control" placeholder="Storage Location Contact  "
                                            name="contact" id="contact" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Storage Location Email </label>
                                        <input type="text" class="form-control" placeholder="Storage Location Email "
                                            name="email" id="email" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Adress Line 1</label>
                                        <input type="text" class="form-control" placeholder="Adress Line 1 "
                                            name="adress_1" id="adress_1" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Address Line 2</label>
                                        <input type="text" class="form-control" placeholder="Address Line 2 "
                                            name="adress_2" id="adress_2" >
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> City </label>
                                        <input type="text" class="form-control" placeholder="City "
                                            name="city" id="city" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> State </label>
                                        <input type="text" class="form-control" placeholder="State "
                                            name="state" id="state" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Zip Code</label>
                                        <input type="text" class="form-control" placeholder="Zip Code "
                                            name="zip_code" id="zip_code" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="country"  class="w-100 " style="text-align: left"> Country </label>
                                        <select class="form-control form-select" id="country" name="country" required>
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
                                            <option value="Malaysia " selected> Malaysia </option>
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

                                    </div>
                                </div>


                                <div class=" m-2">
                                    <button type="submit" class="btn btn-success me-2">Submit</button>
                                    <button class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close" type="button" >Cancel</button>

                                </div>

                                <br />
                                <br />
                                <br />
                                <br />
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <!--end modal-content-->
        </div>
    </div>


    <!-- Edit  user -->
    <div id="edit_storage_location_modal" class="modal hide fade" role="dialog" aria-labelledby="edit_user_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  ">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5>Edit Storage Location</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body minauto text-center p-4">
                    <div class="">
                        <form method="PUT" class="needs-validation" novalidate id="edit_storage_location_form">
                            <input type="hidden" id="storage_location_id" value="">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Storage Location  Name </label>
                                        <input type="text" class="form-control" placeholder="Storage Location  Name "
                                            name="name" id="name" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Storage Location Contact  </label>
                                        <input type="text" class="form-control" placeholder="Storage Location Contact  "
                                            name="contact" id="contact" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Storage Location Email </label>
                                        <input type="text" class="form-control" placeholder="Storage Location Email "
                                            name="email" id="email" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Adress Line 1</label>
                                        <input type="text" class="form-control" placeholder="Adress Line 1 "
                                            name="adress_1" id="adress_1" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Address Line 2</label>
                                        <input type="text" class="form-control" placeholder="Address Line 2 "
                                            name="adress_2" id="adress_2" >
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> City </label>
                                        <input type="text" class="form-control" placeholder="City "
                                            name="city" id="city" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> State </label>
                                        <input type="text" class="form-control" placeholder="State "
                                            name="state" id="state" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Zip Code</label>
                                        <input type="text" class="form-control" placeholder="Zip Code "
                                            name="zip_code" id="zip_code" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="country"  class="w-100 " style="text-align: left"> Country </label>
                                        <select class="form-control form-select" id="country" name="country" required>
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
                                            <option value="Malaysia " selected> Malaysia </option>
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

                                    </div>
                                </div>

                                <div class=" m-2">
                                    <button type="submit" class="btn btn-success me-2">Submit</button>
                                    <button class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close" type="button" >Cancel</button>

                                </div>

                                <br />
                                <br />
                                <br />
                                <br />
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <!--end modal-content-->
        </div>
    </div>


@endsection

@section('custom_script')
    <!-- ------- DATA TABLE ---- -->
    <script src="{{ asset('/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>

        // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms =$( "#edit_storage_location_form, #create_storage_location_form" )

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



    <script>
        (function($) {
            'use strict';
            $(function() {
                $('#location-listing').DataTable({
                    "aLengthMenu": [
                        [5, 10, 15, -1],
                        [5, 10, 15, "All"]
                    ],
                    "iDisplayLength": 10,
                    "language": {
                        search: "_INPUT_",
                        searchPlaceholder: "Search..."
                    }
                });

            });
        })(jQuery);
    </script>
    <!-- -------END  DATA TABLE ---- -->


    <script src="{{ asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/assets/js/select2.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#location').select2({
                placeholder: "Select a location",
                allowClear: true
            });
        });
    </script>


    <script src="{{ asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script>
        (function($) {

            @if (session('message'))

                $.toast({
                    heading: 'Success',
                    text: '{{ session('message') }}',
                    showHideTransition: 'slide',
                    icon: 'success',
                    loaderBg: '#f96868',
                    position: 'top-right',
                    timeout: 5000
                })
            @endif
        })(jQuery);
    </script>




    <script>
        (function($) {
            'use strict';
            $(function() {
                $('#order-listing').DataTable({
                    "aLengthMenu": [
                        [5, 10, 15, -1],
                        [5, 10, 15, "All"]
                    ],
                    "iDisplayLength": 10,
                    "language": {
                        search: ""
                    }
                });
                $('#order-listing').each(function() {
                    var datatable = $(this);
                    // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                    var search_input = datatable.closest('.dataTables_wrapper').find(
                        'div[id$=_filter] input');
                    search_input.attr('placeholder', 'Search');
                    search_input.removeClass('form-control-sm');
                    // LENGTH - Inline-Form control
                    var length_sel = datatable.closest('.dataTables_wrapper').find(
                        'div[id$=_length] select');
                    length_sel.removeClass('form-control-sm');
                });
            });
        })(jQuery);


        function get_storage_locations() {

            $("#users-listing").dataTable().fnDestroy();
            var loader_content =
                '<div class="jumping-dots-loader">' +
                '<span></span>' +
                '<span></span>' +
                '<span></span>' +
                '</div>'
            $('#users-listing tbody').html(loader_content)

            var url = "{{ url('') }}" + '/storage_location/get_storage_locations';
            var result = " ";
            console.log(url)
            $.ajax({
                url: url,
                method: 'GET',

                success: function(response) {

                    $.each(response.storage_locations, function(index, value) {
                        console.log(value)
                        index++;

                        result = result +
                            '<tr class="odd text-center">' +
                                '<td class="text-body align-middle fw-medium text-decoration-none">' +
                                index + ' </td>' +
                                '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                                .name + ' </td>' +
                                '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                                .contact + ' </td>' +
                                '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                                .email + ' </td>' +
                                '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                                .adress_1 + '</td>' +
                                '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                                .adress_2 + '</td>' +
                                '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                                .city + '</td>' +
                                '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                                .state + '</td>' +
                                '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                                .zip_code + '</td>' +
                                '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                                .country + '</td>' +

                                '<td>'+
                                    '<button data-id="'+value.id+'" type="button" class="btn btn-inverse-warning btn-icon m-1 edit"><i class="mdi mdi-border-color "></i></button>'+
                                    '<button data-id="'+value.id+'" type="button" class="btn btn-inverse-danger btn-icon m-1 delete"><i class="mdi mdi-delete-forever "></i></button>'+
                                '</td>'+

                            '</tr>';
                    });
                    console.log(result)
                    $('#users-listing tbody').html(result)

                    /***** refresh datatable **** **/

                    var spl_datatable = $('#users-listing').DataTable({
                        "iDisplayLength": 10,
                        destroy: true,
                        "bDestroy": true,
                        "language": {
                            search: "_INPUT_",
                            searchPlaceholder: "Search..."
                        }
                    });

                },
                error: function(response) {

                }
            })

        }

        get_storage_locations();
        //Delete NOC SPLs
        $(document).on('click', '.delete', function() {

            var id = $(this).attr('data-id');
            var url = '{{ url('') }}' + '/storage_location/' + id + '/destroy';

            swal({
                showCancelButton: true,
                title: 'Storage Location Deletion!',
                text: 'You are sure you want to delete this Storage Location',
                icon: 'warning',
                buttons: {
                    cancel: {
                        text: "Cancel",
                        value: null,
                        visible: true,
                        className: "btn btn-primary",
                        closeModal: true,
                    },

                    Confirm: {
                        text: "Yes, delete it!",
                        value: true,
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: true,
                    },
                }
            }).then((result) => {

                if (result) {

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        method: 'DELETE',
                        data: {
                            id: id,
                            "_token": "{{ csrf_token() }}",
                        },

                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            "_token": "{{ csrf_token() }}",
                        },
                        beforeSend: function() {
                            swal({
                                title: 'Refreshing',
                                allowEscapeKey: false,
                                allowOutsideClick: true,
                                onOpen: () => {
                                    swal.showLoading();
                                }
                            });
                        },
                        success: function(response) {
                            swal.close();

                            if (response == 'Success') {
                                get_storage_locations()
                                swal({
                                    title: 'Done!',
                                    text: 'Storage Location Deleted Successfully ',
                                    icon: 'success',
                                    button: {
                                        text: "Continue",
                                        value: true,
                                        visible: true,
                                        className: "btn btn-primary"
                                    }
                                })

                            } else {
                                swal({
                                    title: 'Failed',
                                    text: "Error occurred while sending the request.",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3f51b5',
                                    cancelButtonColor: '#ff4081',
                                    confirmButtonText: 'Great ',
                                    buttons: {
                                        cancel: {
                                            text: "Cancel",
                                            value: null,
                                            visible: true,
                                            className: "btn btn-danger",
                                            closeModal: true,
                                        },
                                    }
                                })
                            }

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            swal.close();
                            swal({
                                    title: 'Failed',
                                    text: "Error occurred while sending the request.",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3f51b5',
                                    cancelButtonColor: '#ff4081',
                                    confirmButtonText: 'Great ',
                                    buttons: {
                                        cancel: {
                                            text: "Cancel",
                                            value: null,
                                            visible: true,
                                            className: "btn btn-danger",
                                            closeModal: true,
                                        },
                                    }
                                })
                          //  showSwal('warning-message-and-cancel');

                            console.log(response) ;
                        }
                    })


                }

            })

        })

        $(document).on('click', '.edit', function() {

            $('#edit_storage_location_modal #edit_storage_location_form')[0].reset();
            $('#edit_storage_location_modal #storage_location_id').val("")

            var id = $(this).attr('data-id');
            var url = '{{ url('') }}' + '/storage_location/' + id + '/show';

            $('#edit_storage_location_modal').modal('show');


            $.ajax({
                url: url,
                type: 'GET',
                method: 'GET',
                data: {
                    id: id,
                },

                success: function(response) {
                    $('#edit_storage_location_modal #name').val(response.storage_location.name)
                    $('#edit_storage_location_modal #address').val(response.storage_location.address)
                    $('#edit_storage_location_modal #contact').val(response.storage_location.contact)
                    $('#edit_storage_location_modal #email').val(response.storage_location.email)
                    $('#edit_storage_location_modal #storage_location_id').val(response.storage_location.id)

                    $('#edit_storage_location_modal #adress_1').val(response.storage_location.adress_1);
                    $('#edit_storage_location_modal #adress_2').val(response.storage_location.adress_2);
                    $('#edit_storage_location_modal #city').val(response.storage_location.city);
                    $('#edit_storage_location_modal #state').val(response.storage_location.state);
                    $('#edit_storage_location_modal #zip_code').val(response.storage_location.zip_code);
                    $('#edit_storage_location_modal #country').val(response.storage_location.country);




                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })
        })

        $(document).on('click', '#create_storage_location_btn', function() {
            $('#create_storage_location_modal #create_storage_location_form')[0].reset();
            $('#create_storage_location_modal').modal('show');
        })

        $(document).on("submit","#create_storage_location_form" , function(event) {

            event.preventDefault();

            var name = $('#create_storage_location_modal #name').val();
            var address = $('#create_storage_location_modal #address').val();
            var contact = $('#create_storage_location_modal #contact').val();
            var email = $('#create_storage_location_modal #email').val();

            var adress_1 = $('#create_storage_location_modal #adress_1').val();
            var adress_2 = $('#create_storage_location_modal #adress_2').val();
            var city = $('#create_storage_location_modal #city').val();
            var state = $('#create_storage_location_modal #state').val();
            var zip_code = $('#create_storage_location_modal #zip_code').val();
            var country = $('#create_storage_location_modal #country').val();


            var url = '{{ url('') }}' + '/storage_location/store';
            console.log(url)
            //$('#edit_user_modal').modal('show');
            $.ajax({
                url: url,
                type: 'POST',
                method: 'POST',
                data: {
                    name: name,
                    address: address,
                    contact: contact,
                    email: email,
                    adress_1:adress_1,
                    adress_2:adress_2,
                    city:city,
                    state:state,
                    zip_code:zip_code,
                    country:country,

                    "_token": "{{ csrf_token() }}",
                },

                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {

                    get_storage_locations()
                        swal({
                            title: 'Done!',
                            text: 'Storage Location Created Successfully ',
                            icon: 'success',
                            button: {
                                text: "Continue",
                                value: true,
                                visible: true,
                                className: "btn btn-primary"
                            }
                        })
                        $('#create_storage_location_modal').modal('hide') ;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })


        })

        $(document).on("submit","#edit_storage_location_form" , function(event) {

            event.preventDefault();

            var name = $('#edit_storage_location_modal #name').val();
            var address = $('#edit_storage_location_modal #address').val();
            var contact = $('#edit_storage_location_modal #contact').val();
            var email = $('#edit_storage_location_modal #email').val();

            var adress_1 = $('#edit_storage_location_modal #adress_1').val();
            var adress_2 = $('#edit_storage_location_modal #adress_2').val();
            var city = $('#edit_storage_location_modal #city').val();
            var state = $('#edit_storage_location_modal #state').val();
            var zip_code = $('#edit_storage_location_modal #zip_code').val();
            var country = $('#edit_storage_location_modal #country').val();

            var id = $('#edit_storage_location_modal #storage_location_id').val()


            var url = '{{ url('') }}' + '/storage_location/update';

            $.ajax({
                url: url,
                type: 'PUT',
                method: 'PUT',
                data: {
                    name:name,
                    address:address,
                    contact:contact,
                    email:email,
                    adress_1:adress_1,
                    adress_2:adress_2,
                    city:city,
                    state:state,
                    zip_code:zip_code,
                    country:country,

                    id: id,
                    "_token": "{{ csrf_token() }}",
                },

                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {

                    get_storage_locations()
                        swal({
                            title: 'Done!',
                            text: 'Category Updated Successfully ',
                            icon: 'success',
                            button: {
                                text: "Continue",
                                value: true,
                                visible: true,
                                className: "btn btn-primary"
                            }
                        })

                        $('#edit_storage_location_modal').modal('hide');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })

        })


        var t = $(window).height();
        $("#content_page").css("height", t - 300);
        $("#content_page").css("max-height", t - 300);
        $("#content_page").css("overflow-y", 'auto');
    </script>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* ***** Select 2 **** */

        .select2.select2-container.select2-container--default {
            width: 90% !important;
            background: #2a3038;
        }

        .select2-container--default .select2-selection--multiple {
            border: none;
            background: #2a3038;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice,
        .select2-container--default .select2-selection--multiple .select2-selection__choice:nth-child(5n+1) {
            font-size: 14px;
            background: #2a3038;
        }

        .select2-container--default .select2-results__option--selected {
            background-color: #297eee;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            padding: 5px;
            padding-left: 21px;

        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            padding: 5px;
        }

        .select2-container--open .select2-dropdown--below {
            z-index: 999999999;
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            width: 100%;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice,
        .select2-container--default .select2-selection--multiple .select2-selection__choice:nth-child(5n+1) {
            float: left;
        }

        #edit_user_modal .select2.select2-container.select2-container--default {
            width: 100% !important;
            background: #2a3038;
        }
        #create_user_modal .select2.select2-container.select2-container--default ,
        #edit_user_modal .select2.select2-container.select2-container--default
        {
            width: 100% !important;

        }
        #create_storage_location_modal .modal-body
        {
            min-height: auto !important;
        }
    </style>
@endsection
