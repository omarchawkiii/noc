@extends('layouts.app')
@section('title')
    Storage Report
@endsection
@section('content')
    <div class="page-header library-shadow">
        <h3 class="page-title">Storage Report </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Storage Report </li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link  active " id="statistics-tab" data-bs-toggle="tab" href="#statistics" role="tab" aria-controls="home" aria-selected="true">Storage Device Statistics</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  id="list-tab" data-bs-toggle="tab" href="#list" role="tab" aria-controls="profile" aria-selected="false">Storage Device List</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade  show active " id="statistics" role="tabpanel" aria-labelledby="home-tab">
                    <h4 class="mt-3 mb-3">Storage Device Statistics</h4>

                    <div class="row mb-3">
                        <div class="col-md-12 row">
                            <div class="col-xl-4">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="mdi mdi-home-map-marker"></i></div>
                                    </div>
                                    <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="location">
                                        <option selected="">Locations</option>
                                        <option value="1">BPJ</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="mdi mdi-monitor"></i></div>
                                    </div>
                                    <select class="form-control" id="screenSelect">
                                        <option value="all">All Screens</option>
                                        <option value="Screen-01">Screen-01</option>
                                        <option value="Screen-02">Screen-02</option>
                                        <option value="Screen-03">Screen-03</option>
                                        <option value="Screen-04">Screen-04</option>
                                        <option value="Screen-05">Screen-05</option>
                                        <option value="Screen-06">Screen-06</option>
                                        <option value="Screen-07">Screen-07</option>
                                        <option value="Screen-08">Screen-08</option>
                                        <option value="Screen-09">Screen-09</option>
                                        <option value="Beanie-01">Beanie-01</option>
                                        <option value="Beanie-02">Beanie-02</option>
                                        <option value="Junior">Junior</option>
                                        <option value="Indulge-01">Indulge-01</option>
                                        <option value="Indulge-02">Indulge-02</option>
                                        <option value="Indulge-03">Indulge-03</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="chart-container">
                        <h2>Storage Devices By Model</h2>
                        <p id="deviceModelIndicators"></p>
                        <canvas id="deviceModelChart"></canvas>
                    </div>

                    <div class="chart-container">
                        <h2>Storage Devices by Working State</h2>
                        <p id="workingStateIndicators">
                            <span class="indicator-box" style="background-color: grey;"></span> State Undefined
                            <span class="indicator-box" style="background-color: darkgrey;"></span> State Not Applicable
                            <span class="indicator-box" style="background-color: green;"></span> State Normal
                            <span class="indicator-box" style="background-color: yellow;"></span> State Warning
                            <span class="indicator-box" style="background-color: red;"></span> State Error
                        </p>
                        <canvas id="workingStateChart"></canvas>
                    </div>

                    <div class="chart-container">
                        <h2>SMART Statistics</h2>
                        <p id="smartStatisticsIndicators">
                            <span class="indicator-box" style="background-color: #1f77b4;"></span> Raw Read Error
                            <span class="indicator-box" style="background-color: #ff7f0e;"></span> Reallocated Sector Count
                            <span class="indicator-box" style="background-color: #2ca02c;"></span> Reallocated Event
                            <span class="indicator-box" style="background-color: #d62728;"></span> Seek Error Rate
                            <span class="indicator-box" style="background-color: #9467bd;"></span> UDMA Error
                            <span class="indicator-box" style="background-color: #8c564b;"></span> Power On Hours
                        </p>
                        <canvas id="smartStatisticsChart"></canvas>
                    </div>

                    <div class="chart-container">
                        <h2>Average Lifespan of Drives</h2>
                        <div class="stat-box" style="background-color: #1f77b4;">
                            <div class="label">Hours</div>
                            <div class="value" id="hoursLifespan">3,843</div>
                        </div>
                        <div class="stat-box" style="background-color: #ff7f0e;">
                            <div class="label">Days</div>
                            <div class="value" id="daysLifespan">214</div>
                        </div>
                        <div class="stat-box" style="background-color: #2ca02c;">
                            <div class="label">Years</div>
                            <div class="value" id="yearsLifespan">0.58</div>
                        </div>
                    </div>


                </div>
                <div class="tab-pane fade " id="list" role="tabpanel" aria-labelledby="profile-tab">
                    <h4 class="mt-3 mb-3">Storage Device List</h4>
                    <div class="row mb-3">
                        <div class="col-md-12 row">
                            <div class="col-xl-4">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="mdi mdi-home-map-marker"></i></div>
                                    </div>
                                    <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="locationSelect2">
                                        <option value="all">All Locations</option>
                                        <option value="PBJ">PBJ</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="mdi mdi-monitor"></i></div>
                                    </div>
                                    <select class="form-control" id="screenSelect2">
                                        <option value="all">All Screens</option>
                                        <option value="PBJ-Screen-01">PBJ - Screen-01</option>
                                        <option value="PBJ-Screen-02">PBJ - Screen-02</option>
                                        <option value="PBJ-Screen-03">PBJ - Screen-03</option>
                                        <option value="PBJ-Screen-04">PBJ - Screen-04</option>
                                        <option value="PBJ-Screen-05">PBJ - Screen-05</option>
                                        <option value="PBJ-Screen-06">PBJ - Screen-06</option>
                                        <option value="PBJ-Screen-07">PBJ - Screen-07</option>
                                        <option value="PBJ-Screen-08">PBJ - Screen-08</option>
                                        <option value="PBJ-Screen-09">PBJ - Screen-09</option>
                                        <option value="PBJ-Beanie-01">PBJ - Beanie-01</option>
                                        <option value="PBJ-Beanie-02">PBJ - Beanie-02</option>
                                        <option value="PBJ-Junior">PBJ - Junior</option>
                                        <option value="PBJ-Indulge-01">PBJ - Indulge-01</option>
                                        <option value="PBJ-Indulge-02">PBJ - Indulge-02</option>
                                        <option value="PBJ-Indulge-03">PBJ - Indulge-03</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table mt-3  ">
                                    <thead>
                                        <tr>
                                            <th>Location</th>
                                            <th>Screen</th>
                                            <th>Device ID</th>
                                            <th>Device Model</th>
                                            <th>Device Serial</th>
                                            <th>Working State</th>
                                            <th>Smart Raw Read Error</th>
                                            <th>Reallocated Sector Count</th>
                                            <th>Reallocated Event</th>
                                            <th>Seek Error Rate</th>
                                            <th>UDMA Error</th>
                                            <th>Overall Health</th>
                                            <th>Power On Hours</th>
                                        </tr>
                                    </thead>
                                    <tbody id="deviceList2">
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20221020AA10H086A076"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080275"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4107</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080274"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4103</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080276"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4103</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20200316AA200079E010"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080520"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4146</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080521"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4142</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080519"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4151</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20221020AA10H0521028"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080549"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4189</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080550"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4193</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080551"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4203</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20221021AA10I03B8026"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080557"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3792</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080558"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3783</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080559"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3813</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20221020AA10H0521029"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080192"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3659</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080202"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3655</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080191"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3651</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20221020AA10H0521060"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G893231018"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4249</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G893231302"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4247</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G893231300"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4256</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-07</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20221020AA10H0521076"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-07</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080211"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3785</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-07</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080212"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3779</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-07</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080127"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3782</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20221020AA10H0521046"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080200"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3759</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080198"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3772</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080199"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3773</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20221020AA10H059B126"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080189"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3960</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080188"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3963</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080187"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3967</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Beanie-01</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20221020AA10H086A070"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Beanie-01</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080123"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3887</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Beanie-01</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080124"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3860</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Beanie-01</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080125"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3862</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Beanie-02</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20221020AA10H086A074"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Beanie-02</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080268"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3944</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Beanie-02</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080271"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3946</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Beanie-02</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080267"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3960</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Junior</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20220422AA10H97E1021"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Junior</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080179"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4053</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Junior</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080183"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4063</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Junior</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080182"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>4060</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Indulge-01</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20221020AA10H086A006"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Indulge-01</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G893231373"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3533</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Indulge-01</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G893231375"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3528</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Indulge-01</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G893231374"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3536</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Indulge-02</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20221020AA10H0521059"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Indulge-02</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G893230826"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3510</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Indulge-02</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G893230822"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3510</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Indulge-02</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G893230825"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3508</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Indulge-03</td>
                                            <td>Device-1</td>
                                            <td>"USB EDC H 3SE2 Innodisk"</td>
                                            <td>"20220219AA10H8617056"</td>
                                            <td>stateNormal</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Indulge-03</td>
                                            <td>Device-10</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080201"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3068</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Indulge-03</td>
                                            <td>Device-11</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080205"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3064</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Indulge-03</td>
                                            <td>Device-12</td>
                                            <td>"TS2TSSD452K-DOL"</td>
                                            <td>"G883080203"</td>
                                            <td>stateNormal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>"PASSED"</td>
                                            <td>3063</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    </div>


@endsection

@section('custom_script')
    <!-- ------- DATA TABLE ---- -->
    <script src="{{ asset('/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deviceList = document.getElementById('deviceList2');
            const locationSelect = document.getElementById('locationSelect2');
            const screenSelect = document.getElementById('screenSelect2');

            function filterTable() {
                const selectedLocation = locationSelect.value;
                const selectedScreen = screenSelect.value;
                const rows = deviceList.getElementsByTagName('tr');

                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const locationCell = row.getElementsByTagName('td')[0];
                    const screenCell = row.getElementsByTagName('td')[1];
                    const locationScreen = locationCell.textContent + '-' + screenCell.textContent;

                    if ((selectedLocation === 'all' || locationCell.textContent === selectedLocation) &&
                        (selectedScreen === 'all' || locationScreen === selectedScreen)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            }

            locationSelect.addEventListener('change', filterTable);
            screenSelect.addEventListener('change', filterTable);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let initialData = {"deviceModelCounts":{"USB EDC H 3SE2 Innodisk":15,"TS2TSSD452K-DOL":45},"workingStateCounts":{"stateUndefined":0,"stateNotApplicable":0,"stateNormal":60,"stateWarning":0,"stateError":0},"smartStatistics":{"RawReadError":0,"ReallocatedSectorCount":0,"ReallocatedEvent":0,"SeekErrorRate":0,"UDMAError":0,"PowerOnHoursAvg":3843.0444444444443,"DeviceCount":60},"hoursLifespan":3843.0444444444456,"daysLifespan":213.50246913580253,"yearsLifespan":0.5849382716049384};
            let deviceModelData = initialData.deviceModelCounts;
            let workingStateData = initialData.workingStateCounts;
            let smartStatisticsData = initialData.smartStatistics;
            let hoursLifespan = initialData.hoursLifespan;
            let daysLifespan = initialData.daysLifespan;
            let yearsLifespan = initialData.yearsLifespan;

            const fixedColors = [
                '#1f77b4', // Blue
                '#ff7f0e', // Orange
                '#2ca02c', // Green
                '#d62728', // Red
                '#9467bd', // Purple
                '#8c564b', // Brown
                '#e377c2', // Pink
                '#7f7f7f', // Grey
                '#bcbd22', // Yellow-Green
                '#17becf'  // Cyan
            ];

            function createChart(canvasId, title, data, colors) {
                const ctx = document.getElementById(canvasId).getContext('2d');
                const labels = Object.keys(data);
                const values = Object.values(data);
                const backgroundColors = colors || labels.map((_, i) => fixedColors[i % fixedColors.length]);

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: title,
                            data: values,
                            backgroundColor: backgroundColors,
                            borderColor: backgroundColors.map(color => color.replace('0.2', '1')),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: title
                            },
                            datalabels: {
                                anchor: 'end',
                                align: 'end',
                                formatter: (value) => {
                                    return value;
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });
            }

            function updateIndicators(elementId, data, colors) {
                const element = document.getElementById(elementId);
                let content = '';
                Object.keys(data).forEach((key, index) => {
                    if (index < 5) {
                        content += `<span class="indicator-box" style="background-color: ${colors[index % colors.length]};"></span> ${key} `;
                    }
                });
                element.innerHTML = content;
            }

            function updateCharts() {
                // Destroy existing charts
                Chart.helpers.each(Chart.instances, function(instance) {
                    instance.destroy();
                });

                // Create new charts
                createChart('deviceModelChart', 'Storage Devices by Model', deviceModelData);
                createChart('workingStateChart', 'Storage Devices by Working State', workingStateData, [
                    'grey', // State Undefined
                    'darkgrey', // State Not Applicable
                    'green', // State Normal
                    'yellow', // State Warning
                    'red' // State Error
                ]);
                createChart('smartStatisticsChart', 'SMART Statistics', smartStatisticsData, [
                    '#1f77b4', // Raw Read Error - Blue
                    '#ff7f0e', // Reallocated Sector Count - Orange
                    '#2ca02c', // Reallocated Event - Green
                    '#d62728', // Seek Error Rate - Red
                    '#9467bd', // UDMA Error - Purple
                    '#8c564b'  // Power On Hours Avg - Brown
                ]);
            }

            function filterData(screen) {
                if (screen === 'all') {
                    return initialData;
                }

                let filteredData = {
                    deviceModelCounts: {},
                    workingStateCounts: {
                        'stateUndefined': 0,
                        'stateNotApplicable': 0,
                        'stateNormal': 0,
                        'stateWarning': 0,
                        'stateError': 0
                    },
                    smartStatistics: {
                        'RawReadError': 0,
                        'ReallocatedSectorCount': 0,
                        'ReallocatedEvent': 0,
                        'SeekErrorRate': 0,
                        'UDMAError': 0,
                        'PowerOnHoursAvg': 0,
                        'DeviceCount': 0
                    },
                    hoursLifespan: 0,
                    daysLifespan: 0,
                    yearsLifespan: 0
                };

                let powerOnHoursSum = 0;
                let powerOnHoursCount = 0;
                let lifespanData = [];

                                if (screen in {"Screen-01":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H086A076\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080275\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4107"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080274\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4103"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080276\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4103"}}},"Screen-02":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20200316AA200079E010\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080520\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4146"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080521\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4142"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080519\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4151"}}},"Screen-03":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H0521028\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080549\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4189"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080550\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4193"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080551\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4203"}}},"Screen-04":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221021AA10I03B8026\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080557\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3792"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080558\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3783"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080559\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3813"}}},"Screen-05":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H0521029\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080192\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3659"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080202\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3655"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080191\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3651"}}},"Screen-06":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H0521060\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893231018\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4249"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893231302\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4247"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893231300\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4256"}}},"Screen-07":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H0521076\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080211\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3785"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080212\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3779"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080127\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3782"}}},"Screen-08":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H0521046\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080200\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3759"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080198\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3772"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080199\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3773"}}},"Screen-09":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H059B126\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080189\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3960"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080188\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3963"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080187\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3967"}}},"Beanie-01":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H086A070\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080123\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3887"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080124\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3860"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080125\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3862"}}},"Beanie-02":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H086A074\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080268\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3944"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080271\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3946"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080267\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3960"}}},"Junior":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20220422AA10H97E1021\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080179\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4053"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080183\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4063"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080182\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4060"}}},"Indulge-01":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H086A006\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893231373\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3533"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893231375\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3528"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893231374\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3536"}}},"Indulge-02":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H0521059\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893230826\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3510"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893230822\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3510"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893230825\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3508"}}},"Indulge-03":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20220219AA10H8617056\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080201\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3068"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080205\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3064"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080203\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3063"}}}}) {
                        let devices = {"Screen-01":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H086A076\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080275\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4107"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080274\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4103"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080276\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4103"}}},"Screen-02":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20200316AA200079E010\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080520\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4146"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080521\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4142"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080519\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4151"}}},"Screen-03":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H0521028\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080549\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4189"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080550\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4193"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080551\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4203"}}},"Screen-04":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221021AA10I03B8026\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080557\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3792"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080558\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3783"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080559\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3813"}}},"Screen-05":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H0521029\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080192\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3659"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080202\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3655"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080191\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3651"}}},"Screen-06":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H0521060\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893231018\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4249"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893231302\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4247"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893231300\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4256"}}},"Screen-07":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H0521076\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080211\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3785"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080212\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3779"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080127\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3782"}}},"Screen-08":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H0521046\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080200\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3759"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080198\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3772"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080199\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3773"}}},"Screen-09":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H059B126\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080189\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3960"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080188\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3963"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080187\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3967"}}},"Beanie-01":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H086A070\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080123\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3887"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080124\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3860"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080125\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3862"}}},"Beanie-02":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H086A074\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080268\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3944"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080271\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3946"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080267\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3960"}}},"Junior":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20220422AA10H97E1021\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080179\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4053"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080183\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4063"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080182\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"4060"}}},"Indulge-01":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H086A006\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893231373\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3533"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893231375\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3528"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893231374\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3536"}}},"Indulge-02":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20221020AA10H0521059\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893230826\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3510"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893230822\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3510"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G893230825\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3508"}}},"Indulge-03":{"Device-1":{"dcpStorageDeviceIndex":{"Counter32":"1"},"dcpStorageDeviceTitle":{"STRING":"\"sdg\""},"dcpStorageDeviceBus":{"INTEGER":"busUSB"},"dcpStorageDeviceCapacity":{"INTEGER":"3826"},"dcpStorageDeviceType":{"INTEGER":"devSSD"},"dcpStorageDeviceModel":{"STRING":"\"USB EDC H 3SE2 Innodisk\""},"dcpStorageDeviceSerial":{"STRING":"\"20220219AA10H8617056\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":[],"dcpStorageSMARTReallocatedSectorCount":[],"dcpStorageSMARTReallocatedEvent":[],"dcpStorageSMARTSeekErrorRate":[],"dcpStorageSMARTUDMAError":[],"dcpStorageSMARTOverallHealth":[],"dcpStorageSMARTPowerOnHoursRaw":[]},"Device-10":{"dcpStorageDeviceIndex":{"Counter32":"10"},"dcpStorageDeviceTitle":{"STRING":"\"sda\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080201\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3068"}},"Device-11":{"dcpStorageDeviceIndex":{"Counter32":"11"},"dcpStorageDeviceTitle":{"STRING":"\"sdb\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080205\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3064"}},"Device-12":{"dcpStorageDeviceIndex":{"Counter32":"12"},"dcpStorageDeviceTitle":{"STRING":"\"sdc\""},"dcpStorageDeviceBus":{"INTEGER":"busSATA"},"dcpStorageDeviceCapacity":{"INTEGER":"1953514"},"dcpStorageDeviceType":{"INTEGER":"devHDD"},"dcpStorageDeviceModel":{"STRING":"\"TS2TSSD452K-DOL\""},"dcpStorageDeviceSerial":{"STRING":"\"G883080203\""},"dcpStorageDeviceWorkingState":{"INTEGER":"stateNormal"},"dcpStorageSMARTRawReadError":{"INTEGER":"0"},"dcpStorageSMARTReallocatedSectorCount":{"INTEGER":"0"},"dcpStorageSMARTReallocatedEvent":{"INTEGER":"0"},"dcpStorageSMARTSeekErrorRate":{"INTEGER":"0"},"dcpStorageSMARTUDMAError":{"INTEGER":"0"},"dcpStorageSMARTOverallHealth":{"STRING":"\"PASSED\""},"dcpStorageSMARTPowerOnHoursRaw":{"INTEGER":"3063"}}}}[screen];
                        for (let deviceKey in devices) {
                            let deviceInfo = devices[deviceKey];
                            let model = deviceInfo['dcpStorageDeviceModel']['STRING'].trim().replace(/^"|"$/g, '');

                            if (model) {
                                if (!filteredData.deviceModelCounts[model]) {
                                    filteredData.deviceModelCounts[model] = 0;
                                }
                                filteredData.deviceModelCounts[model]++;
                            }

                            let state = deviceInfo['dcpStorageDeviceWorkingState']['INTEGER'];
                            if (state) {
                                filteredData.workingStateCounts[state]++;
                            }

                            filteredData.smartStatistics['RawReadError'] += parseInt(deviceInfo['dcpStorageSMARTRawReadError']['INTEGER'] || 0);
                            filteredData.smartStatistics['ReallocatedSectorCount'] += parseInt(deviceInfo['dcpStorageSMARTReallocatedSectorCount']['INTEGER'] || 0);
                            filteredData.smartStatistics['ReallocatedEvent'] += parseInt(deviceInfo['dcpStorageSMARTReallocatedEvent']['INTEGER'] || 0);
                            filteredData.smartStatistics['SeekErrorRate'] += parseInt(deviceInfo['dcpStorageSMARTSeekErrorRate']['INTEGER'] || 0);
                            filteredData.smartStatistics['UDMAError'] += parseInt(deviceInfo['dcpStorageSMARTUDMAError']['INTEGER'] || 0);

                            let powerOnHours = parseInt(deviceInfo['dcpStorageSMARTPowerOnHoursRaw']['INTEGER'] || 0);
                            if (powerOnHours > 0) {
                                powerOnHoursSum += powerOnHours;
                                powerOnHoursCount++;
                                lifespanData.push(powerOnHours / 18);
                            }

                            filteredData.smartStatistics['DeviceCount']++;
                        }
                    }

                if (powerOnHoursCount > 0) {
                    filteredData.smartStatistics['PowerOnHoursAvg'] = powerOnHoursSum / powerOnHoursCount;
                }

                if (lifespanData.length > 0) {
                    let averageLifespan = lifespanData.reduce((a, b) => a + b) / lifespanData.length;
                    filteredData.hoursLifespan = averageLifespan * 18;
                    filteredData.daysLifespan = averageLifespan;
                    filteredData.yearsLifespan = averageLifespan / 365;
                }

                return filteredData;
            }

            document.getElementById('screenSelect').addEventListener('change', function() {
                const selectedScreen = this.value;
                const filteredData = filterData(selectedScreen);

                deviceModelData = filteredData.deviceModelCounts;
                workingStateData = filteredData.workingStateCounts;
                smartStatisticsData = filteredData.smartStatistics;
                hoursLifespan = filteredData.hoursLifespan;
                daysLifespan = filteredData.daysLifespan;
                yearsLifespan = filteredData.yearsLifespan;

                updateIndicators('deviceModelIndicators', deviceModelData, fixedColors);
                document.getElementById('hoursLifespan').innerText = number_format(hoursLifespan);
                document.getElementById('daysLifespan').innerText = number_format(daysLifespan);
                document.getElementById('yearsLifespan').innerText = number_format(yearsLifespan, 2);

                updateCharts();
            });

            function number_format(number, decimals = 0, decPoint = '.', thousandsSep = ',') {
                number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
                const n = !isFinite(+number) ? 0 : +number;
                const prec = !isFinite(+decimals) ? 0 : Math.abs(decimals);
                const sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep;
                const dec = (typeof decPoint === 'undefined') ? '.' : decPoint;
                let s = '';
                const toFixedFix = function(n, prec) {
                    const k = Math.pow(10, prec);
                    return '' + (Math.round(n * k) / k).toFixed(prec);
                };
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            // Initial update of indicators and charts
            updateIndicators('deviceModelIndicators', deviceModelData, fixedColors);
            document.getElementById('hoursLifespan').innerText = number_format(hoursLifespan);
            document.getElementById('daysLifespan').innerText = number_format(daysLifespan);
            document.getElementById('yearsLifespan').innerText = number_format(yearsLifespan, 2);
            updateCharts();
        });
    </script>

@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <style>
        .chart-container {
            width: 80%;
            margin: auto;
        }
        .indicator-box {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
        .stat-box {
            display: inline-block;
            width: 100px;
            height: 100px;
            margin-right: 10px;
            padding: 10px;
            background-color: #f0f0f0;
            text-align: center;
            font-size: 14px;
        }
        .stat-box .value {
            font-size: 18px;
            font-weight: bold;
        }

        .indicator-box
        {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }

    </style>
@endsection
