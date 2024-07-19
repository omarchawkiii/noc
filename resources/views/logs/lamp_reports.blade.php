@extends('layouts.app')
@section('title')
    Lamp Reports
@endsection
@section('content')
    <div class="page-header library-shadow">
        <h3 class="page-title"> Lamp Reports </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Lamp Reports </li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link  active " id="statistics-tab" data-bs-toggle="tab" href="#statistics" role="tab"
                        aria-controls="home" aria-selected="true">Lamp Statistics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="list-tab" data-bs-toggle="tab" href="#list" role="tab"
                        aria-controls="profile" aria-selected="false">Lamp List</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade  show active " id="statistics" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row justify-content-md-center">
                        <div class="col-md-8">


                            <h3 class="mt-3 mb-3">SLamp Statistics</h4>
                            <!-- Lamp Types Installed Based on Historical Entry -->
                            <h4 class="mt-4">Lamp Types Installed Based on Historical Entry</h2>
                            <canvas id="lampTypesHistoricalChart"></canvas>
                            <div id="lampTypesHistoricalLegend" class="mt-2"></div>

                            <!-- Lamp Types Installed Based on Last Entry -->
                            <h4 class="mt-4">Lamp Types Installed Based on Last Entry</h2>
                            <canvas id="lampTypesChart"></canvas>
                            <div id="lampTypesLegend" class="mt-2"></div>

                            <!-- Average Light Usage Hours by Lamp Type -->
                            <h4 class="mt-4">Average Light Usage Hours by Lamp Type</h2>
                            <canvas id="lightUsageChart"></canvas>
                            <div id="lightUsageLegend" class="mt-2"></div>

                            <!-- Estimate Lamps Needed by Quarter -->
                            <h4 class="mt-4">Estimate Lamps Needed by Quarter</h2>
                            <canvas id="lampsNeededChart"></canvas>
                            <div id="lampsNeededLegend" class="mt-2"></div>
                            <table class="table mt-4">
                                <thead>
                                    <tr>
                                        <th>Quarter</th>
                                        <th>Lamp Model</th>
                                        <th>Units Needed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2024 Q1</td>
                                        <td>CDXL-30SP</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>2024 Q3</td>
                                        <td>CDXL-20SP</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>2024 Q2</td>
                                        <td>CDXL-45SP</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>2024 Q2</td>
                                        <td>CDXL-20SP</td>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Timeline of Failures -->
                            <!-- Timeline of Failures -->
                            <h4 class="mt-4">Timeline of Failures</h2>
                            <canvas id="failuresTimelineChart"></canvas>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade " id="list" role="tabpanel" aria-labelledby="profile-tab">
                    <h3 class="mt-3 mb-3">Lamp List</h4>


                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
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
                                        <option value="Screen-10">Screen-10</option>
                                    </select>
                                </div>

                                <div class="form-check form-check-flat form-check-primary">
                                    <label for="installedFilter" class="form-check-label">Currently Installed:
                                        <input type="checkbox" id="installedFilter" class="form-check-input"><i
                                            class="input-helper"></i></label>
                                </div>




                                <div class="form-check form-check-flat form-check-primary">
                                    <label for="errorsFilter" class="form-check-label">Has Errors:
                                        <input type="checkbox" id="errorsFilter" class="form-check-input"><i
                                            class="input-helper"></i></label>
                                </div>

                                <table class="table  mt-3">
                                    <thead>
                                        <tr>
                                            <th>Location</th>
                                            <th>Screen</th>
                                            <th>Date Installed</th>
                                            <th>Lamp Model</th>
                                            <th>Lamp Serial</th>
                                            <th>Lamp Hours</th>
                                            <th>Total Strikes</th>
                                            <th>Failed Strikes</th>
                                            <th>Failed Restrikes</th>
                                            <th>Unexpected Off</th>
                                        </tr>
                                    </thead>
                                    <tbody id="lampList">
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>3/15/2024 2:14:09 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZHC709P</td>
                                            <td>01723</td>
                                            <td>00740</td>
                                            <td>00037</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>2/20/2024 5:02:37 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZHC709P</td>
                                            <td>00277</td>
                                            <td>00151</td>
                                            <td>00013</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>8/2/2023 6:59:09 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZD0124P</td>
                                            <td>02314</td>
                                            <td>01181</td>
                                            <td>00059</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>1/22/2023 6:54:04 PM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZD2007P</td>
                                            <td>02423</td>
                                            <td>01119</td>
                                            <td>00086</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>7/13/2022 5:45:17 PM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZA8373P</td>
                                            <td>02372</td>
                                            <td>01044</td>
                                            <td>00087</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>12/17/2021 6:16:56 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCWK1700P</td>
                                            <td>02402</td>
                                            <td>01330</td>
                                            <td>00158</td>
                                            <td>00003</td>
                                            <td>00014</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>1/23/2020 6:33:20 PM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCWG5591</td>
                                            <td>02479</td>
                                            <td>01503</td>
                                            <td>00126</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>7/25/2019 4:35:41 PM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCWD8206P</td>
                                            <td>02260</td>
                                            <td>01337</td>
                                            <td>00139</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>1/29/2019 8:39:18 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCVG9741P</td>
                                            <td>02301</td>
                                            <td>01305</td>
                                            <td>00142</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>8/16/2018 6:49:58 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCVB9725P</td>
                                            <td>02149</td>
                                            <td>01211</td>
                                            <td>00103</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>2/15/2018 9:41:17 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEUEB870P</td>
                                            <td>02295</td>
                                            <td>01335</td>
                                            <td>00182</td>
                                            <td>00000</td>
                                            <td>00010</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>8/17/2017 11:00:12 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEUCA462P</td>
                                            <td>02310</td>
                                            <td>01361</td>
                                            <td>00173</td>
                                            <td>00002</td>
                                            <td>00002</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>5/16/2017 7:22:18 PM</td>
                                            <td>CDXL-30SD</td>
                                            <td>YMSJA432</td>
                                            <td>01156</td>
                                            <td>00640</td>
                                            <td>00038</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>11/16/2016 10:43:32 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YESDF094</td>
                                            <td>02297</td>
                                            <td>01404</td>
                                            <td>00199</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>5/31/2016 2:07:04 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YESGD707</td>
                                            <td>02329</td>
                                            <td>01282</td>
                                            <td>00217</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>11/21/2015 12:48:24 PM</td>
                                            <td>CDXL-30</td>
                                            <td>YERK8072P</td>
                                            <td>02319</td>
                                            <td>01327</td>
                                            <td>00154</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>2/24/2015 2:46:51 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEREF401</td>
                                            <td>02200</td>
                                            <td>01341</td>
                                            <td>00185</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>8/18/2014 1:52:56 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEQGD665</td>
                                            <td>02212</td>
                                            <td>01497</td>
                                            <td>00230</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>2/14/2014 2:08:22 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEPJ 8101</td>
                                            <td>02211</td>
                                            <td>01398</td>
                                            <td>00197</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>2/10/2014 2:00:01 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEQB 8202</td>
                                            <td>02215</td>
                                            <td>00038</td>
                                            <td>00012</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>12/26/2013 1:49:19 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEQB8202</td>
                                            <td>02167</td>
                                            <td>00347</td>
                                            <td>00064</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>8/17/2013 3:27:45 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEQB 8202</td>
                                            <td>01600</td>
                                            <td>00840</td>
                                            <td>00069</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-01</td>
                                            <td>11/12/2012 6:35:04 PM</td>
                                            <td>CDXL-30</td>
                                            <td>YEPE0262</td>
                                            <td>02514</td>
                                            <td>01351</td>
                                            <td>00146</td>
                                            <td>00002</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>7/9/2024 2:30:35 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZFB752P</td>
                                            <td>00105</td>
                                            <td>00058</td>
                                            <td>00004</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>3/15/2024 2:15:23 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZF5381P</td>
                                            <td>04042</td>
                                            <td>00798</td>
                                            <td>00146</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>8/2/2023 6:33:44 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZF5381P</td>
                                            <td>02665</td>
                                            <td>01338</td>
                                            <td>00122</td>
                                            <td>00000</td>
                                            <td>00020</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>10/23/2022 2:25:04 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZE2957P</td>
                                            <td>03497</td>
                                            <td>01643</td>
                                            <td>00125</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>12/17/2021 7:26:06 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBWK8232P</td>
                                            <td>03551</td>
                                            <td>01855</td>
                                            <td>00198</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>10/23/2019 5:44:14 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBWBA401</td>
                                            <td>03864</td>
                                            <td>02368</td>
                                            <td>00290</td>
                                            <td>00000</td>
                                            <td>00007</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>12/26/2018 2:03:06 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBVB6232P</td>
                                            <td>03796</td>
                                            <td>02162</td>
                                            <td>00208</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>4/23/2018 10:14:26 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDUH6555P</td>
                                            <td>03189</td>
                                            <td>01724</td>
                                            <td>00134</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>8/17/2017 10:53:04 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDUD7611P</td>
                                            <td>03135</td>
                                            <td>01824</td>
                                            <td>00180</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>12/24/2016 7:27:28 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDSCD636</td>
                                            <td>02977</td>
                                            <td>01660</td>
                                            <td>00140</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>4/12/2016 5:24:10 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDSCA984</td>
                                            <td>03082</td>
                                            <td>01755</td>
                                            <td>00117</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>7/19/2015 3:01:35 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRFJ180</td>
                                            <td>03139</td>
                                            <td>01727</td>
                                            <td>00136</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>11/14/2014 7:15:27 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRFJ173</td>
                                            <td>02961</td>
                                            <td>01683</td>
                                            <td>00134</td>
                                            <td>00000</td>
                                            <td>00002</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>4/14/2014 1:52:16 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQB689</td>
                                            <td>02622</td>
                                            <td>01514</td>
                                            <td>00125</td>
                                            <td>00000</td>
                                            <td>00003</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>4/12/2014 1:21:51 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQC2883</td>
                                            <td>03000</td>
                                            <td>00018</td>
                                            <td>00002</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>12/26/2013 1:51:01 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQC3883</td>
                                            <td>02975</td>
                                            <td>00776</td>
                                            <td>00098</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>8/3/2013 6:37:12 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQC33883</td>
                                            <td>01736</td>
                                            <td>00891</td>
                                            <td>00086</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>8/3/2013 6:33:05 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQC3883</td>
                                            <td>00000</td>
                                            <td>00002</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>5/1/2013 6:29:42 PM</td>
                                            <td>CDXL-20</td>
                                            <td>ydpe2827</td>
                                            <td>02746</td>
                                            <td>00589</td>
                                            <td>00052</td>
                                            <td>00000</td>
                                            <td>00002</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-02</td>
                                            <td>11/17/2012 6:13:58 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDPE2827</td>
                                            <td>01587</td>
                                            <td>00819</td>
                                            <td>00062</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>3/15/2024 2:16:23 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZF5378P</td>
                                            <td>02675</td>
                                            <td>00720</td>
                                            <td>00041</td>
                                            <td>00000</td>
                                            <td>00006</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>11/30/2023 4:15:50 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZF5378P</td>
                                            <td>01195</td>
                                            <td>00595</td>
                                            <td>00030</td>
                                            <td>00000</td>
                                            <td>00003</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>2/15/2023 3:14:36 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZA8289</td>
                                            <td>03511</td>
                                            <td>01757</td>
                                            <td>00110</td>
                                            <td>00000</td>
                                            <td>00005</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>4/30/2022 12:53:48 PM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZA3624P</td>
                                            <td>03515</td>
                                            <td>01594</td>
                                            <td>00091</td>
                                            <td>00000</td>
                                            <td>00039</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>1/23/2020 6:06:16 PM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBWBC306</td>
                                            <td>04066</td>
                                            <td>02381</td>
                                            <td>00149</td>
                                            <td>00000</td>
                                            <td>00004</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>5/9/2019 6:40:09 PM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBVH2243P</td>
                                            <td>03281</td>
                                            <td>01852</td>
                                            <td>00097</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>7/31/2018 2:49:03 PM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBVB7752P</td>
                                            <td>03645</td>
                                            <td>02014</td>
                                            <td>00098</td>
                                            <td>00000</td>
                                            <td>00003</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>11/29/2017 5:48:03 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDUH6544P</td>
                                            <td>03006</td>
                                            <td>01657</td>
                                            <td>00082</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>3/13/2017 6:55:05 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDTJA314P</td>
                                            <td>03220</td>
                                            <td>01836</td>
                                            <td>00092</td>
                                            <td>00000</td>
                                            <td>00003</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>7/4/2016 3:44:59 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDSCD648</td>
                                            <td>03061</td>
                                            <td>01795</td>
                                            <td>00123</td>
                                            <td>00000</td>
                                            <td>00007</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>12/7/2015 7:50:44 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRL4531P</td>
                                            <td>02523</td>
                                            <td>01440</td>
                                            <td>00122</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>5/11/2015 2:38:27 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YDRFJ178</td>
                                            <td>02360</td>
                                            <td>01466</td>
                                            <td>00131</td>
                                            <td>00000</td>
                                            <td>00005</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>8/21/2014 2:05:06 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRAG251</td>
                                            <td>03082</td>
                                            <td>01914</td>
                                            <td>00169</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>8/21/2014 2:03:51 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRAG251</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>8/18/2014 2:06:00 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQC8649</td>
                                            <td>02739</td>
                                            <td>00033</td>
                                            <td>00005</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>8/15/2014 10:01:06 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQCD631</td>
                                            <td>02982</td>
                                            <td>00023</td>
                                            <td>00002</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>8/8/2014 6:00:54 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQCD631</td>
                                            <td>02993</td>
                                            <td>00050</td>
                                            <td>00007</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>12/26/2013 1:52:56 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQCD631</td>
                                            <td>02996</td>
                                            <td>01699</td>
                                            <td>00131</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>12/6/2013 2:21:03 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQCD631</td>
                                            <td>00269</td>
                                            <td>00136</td>
                                            <td>00009</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-03</td>
                                            <td>11/17/2012 6:28:32 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDPE2720</td>
                                            <td>02890</td>
                                            <td>01906</td>
                                            <td>00213</td>
                                            <td>00000</td>
                                            <td>00007</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>7/9/2024 2:16:56 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZFB763P</td>
                                            <td>00101</td>
                                            <td>00055</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>3/15/2024 2:17:35 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZE3485P</td>
                                            <td>04021</td>
                                            <td>00701</td>
                                            <td>00074</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>8/2/2023 5:17:52 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZE3485P</td>
                                            <td>02660</td>
                                            <td>01307</td>
                                            <td>00112</td>
                                            <td>00001</td>
                                            <td>00016</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>10/23/2022 2:33:51 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZE2956P</td>
                                            <td>03532</td>
                                            <td>01779</td>
                                            <td>00160</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>12/17/2021 7:36:49 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBWK8233P</td>
                                            <td>03507</td>
                                            <td>01829</td>
                                            <td>00175</td>
                                            <td>00000</td>
                                            <td>00005</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>10/23/2019 8:09:37 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBWBA397</td>
                                            <td>03625</td>
                                            <td>02256</td>
                                            <td>00213</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>1/14/2019 5:11:53 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBVIF075</td>
                                            <td>03598</td>
                                            <td>02200</td>
                                            <td>00272</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>6/12/2018 5:12:52 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDUH6556P</td>
                                            <td>03078</td>
                                            <td>01634</td>
                                            <td>00140</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>5/22/2018 7:56:32 AM</td>
                                            <td>CDXL-20LB</td>
                                            <td>YDUH6556P</td>
                                            <td>00263</td>
                                            <td>00132</td>
                                            <td>00012</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>9/18/2017 5:28:58 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDUD7610P</td>
                                            <td>03137</td>
                                            <td>01793</td>
                                            <td>00109</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>1/6/2017 8:35:16 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDTC3834P</td>
                                            <td>03246</td>
                                            <td>01792</td>
                                            <td>00128</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>7/26/2016 7:23:55 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDSCC091</td>
                                            <td>03039</td>
                                            <td>01155</td>
                                            <td>00110</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>4/28/2016 6:27:49 AM</td>
                                            <td>Other-20</td>
                                            <td>YDSCC091</td>
                                            <td>01071</td>
                                            <td>00608</td>
                                            <td>00056</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>8/3/2015 3:47:47 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRFH760</td>
                                            <td>03115</td>
                                            <td>01825</td>
                                            <td>00198</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>11/24/2014 8:20:15 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRFJ174</td>
                                            <td>03076</td>
                                            <td>01702</td>
                                            <td>00132</td>
                                            <td>00000</td>
                                            <td>00006</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>4/8/2014 4:59:36 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQFF833</td>
                                            <td>02805</td>
                                            <td>01645</td>
                                            <td>00139</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>12/26/2013 1:53:47 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQB4225</td>
                                            <td>02643</td>
                                            <td>00717</td>
                                            <td>00071</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>8/30/2013 10:32:09 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQB 4225</td>
                                            <td>01432</td>
                                            <td>00746</td>
                                            <td>00057</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-04</td>
                                            <td>11/17/2012 6:07:05 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDPE2217</td>
                                            <td>02457</td>
                                            <td>01339</td>
                                            <td>00097</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>3/15/2024 2:18:22 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZHC062P</td>
                                            <td>01796</td>
                                            <td>00720</td>
                                            <td>00058</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>2/20/2024 6:28:03 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZHC062P</td>
                                            <td>00279</td>
                                            <td>00143</td>
                                            <td>00009</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>8/2/2023 7:13:14 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZD0122P</td>
                                            <td>02432</td>
                                            <td>01116</td>
                                            <td>00081</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>1/22/2023 7:16:12 PM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZD2009P</td>
                                            <td>02423</td>
                                            <td>01105</td>
                                            <td>00072</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>7/13/2022 5:39:10 PM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZA8372P</td>
                                            <td>02413</td>
                                            <td>01106</td>
                                            <td>00104</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>12/17/2021 5:56:55 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCWK1703P</td>
                                            <td>02531</td>
                                            <td>01269</td>
                                            <td>00163</td>
                                            <td>00002</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>1/23/2020 6:15:21 PM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCWG5590P</td>
                                            <td>02598</td>
                                            <td>01573</td>
                                            <td>00190</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>7/25/2019 5:24:07 PM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCWD8205P</td>
                                            <td>02332</td>
                                            <td>01295</td>
                                            <td>00112</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>1/31/2019 2:19:42 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCVG9738p</td>
                                            <td>02349</td>
                                            <td>01290</td>
                                            <td>00142</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>8/16/2018 7:30:28 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCVB9719P</td>
                                            <td>02239</td>
                                            <td>01219</td>
                                            <td>00122</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>2/15/2018 9:03:57 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEUEB871P</td>
                                            <td>02293</td>
                                            <td>01273</td>
                                            <td>00146</td>
                                            <td>00000</td>
                                            <td>00003</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>8/17/2017 10:31:36 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEUC9990P</td>
                                            <td>02351</td>
                                            <td>01244</td>
                                            <td>00123</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>2/21/2017 8:43:43 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YETD3438P</td>
                                            <td>02234</td>
                                            <td>01215</td>
                                            <td>00121</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>6/16/2016 7:34:07 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDSCB258</td>
                                            <td>03068</td>
                                            <td>01855</td>
                                            <td>00295</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>12/9/2015 10:14:55 PM</td>
                                            <td>CDXL-30</td>
                                            <td>YESGD692</td>
                                            <td>02330</td>
                                            <td>01238</td>
                                            <td>00119</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>6/1/2015 2:44:48 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YERK8825P</td>
                                            <td>02190</td>
                                            <td>01176</td>
                                            <td>00112</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>11/23/2014 6:21:29 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEREB826</td>
                                            <td>02314</td>
                                            <td>01529</td>
                                            <td>00380</td>
                                            <td>00002</td>
                                            <td>00007</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>6/3/2014 4:41:34 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEQFE696</td>
                                            <td>02145</td>
                                            <td>01270</td>
                                            <td>00201</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>6/3/2014 2:05:07 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEQFE696</td>
                                            <td>00002</td>
                                            <td>00002</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>12/22/2013 1:44:12 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEQB8203</td>
                                            <td>02046</td>
                                            <td>01124</td>
                                            <td>00088</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>6/19/2013 4:15:21 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQC 3877</td>
                                            <td>02269</td>
                                            <td>01128</td>
                                            <td>00134</td>
                                            <td>00000</td>
                                            <td>00004</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>6/19/2013 2:03:31 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDXL 3877</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>6/19/2013 2:00:34 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDXL 3877</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>6/19/2013 11:32:25 AM</td>
                                            <td>CDXL-30SD</td>
                                            <td>YDQC3877</td>
                                            <td>00000</td>
                                            <td>00005</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-05</td>
                                            <td>11/17/2012 6:34:39 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDPE2216</td>
                                            <td>02229</td>
                                            <td>01129</td>
                                            <td>00097</td>
                                            <td>00000</td>
                                            <td>00013</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>7/9/2024 2:38:21 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZHC994P</td>
                                            <td>00108</td>
                                            <td>00047</td>
                                            <td>00003</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>3/15/2024 2:19:34 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZF5383P</td>
                                            <td>04065</td>
                                            <td>00746</td>
                                            <td>00132</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>8/2/2023 5:27:37 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZF5383P</td>
                                            <td>02686</td>
                                            <td>01273</td>
                                            <td>00113</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>10/23/2022 2:17:36 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZE2953P</td>
                                            <td>03633</td>
                                            <td>01653</td>
                                            <td>00220</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>12/17/2021 6:38:45 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBWL1874P</td>
                                            <td>03621</td>
                                            <td>01845</td>
                                            <td>00215</td>
                                            <td>00001</td>
                                            <td>00008</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>10/23/2019 6:08:58 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBWBA497</td>
                                            <td>03577</td>
                                            <td>02325</td>
                                            <td>00460</td>
                                            <td>00005</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>1/29/2019 9:13:37 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBVIE933</td>
                                            <td>03401</td>
                                            <td>01886</td>
                                            <td>00237</td>
                                            <td>00000</td>
                                            <td>00002</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>6/18/2018 8:07:51 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRE7020P</td>
                                            <td>02918</td>
                                            <td>01631</td>
                                            <td>00184</td>
                                            <td>00000</td>
                                            <td>00006</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>10/10/2017 6:05:18 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDUD6735P</td>
                                            <td>03190</td>
                                            <td>01715</td>
                                            <td>00166</td>
                                            <td>00001</td>
                                            <td>00002</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>2/18/2017 2:37:36 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDTD1513P</td>
                                            <td>03010</td>
                                            <td>01609</td>
                                            <td>00120</td>
                                            <td>00000</td>
                                            <td>00007</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>2/18/2017 2:31:19 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDTD1513P</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>9/18/2016 11:58:29 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDTD0022P</td>
                                            <td>01928</td>
                                            <td>01084</td>
                                            <td>00070</td>
                                            <td>00000</td>
                                            <td>00015</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>3/3/2016 2:29:56 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRL2114P</td>
                                            <td>02407</td>
                                            <td>01338</td>
                                            <td>00104</td>
                                            <td>00000</td>
                                            <td>00013</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>3/3/2016 2:29:21 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRL2114P</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>2/3/2016 2:23:42 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YESGD707</td>
                                            <td>00362</td>
                                            <td>00209</td>
                                            <td>00013</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>7/19/2015 2:48:07 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YERK8809P</td>
                                            <td>02270</td>
                                            <td>01349</td>
                                            <td>00169</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>1/15/2015 6:22:30 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEREB830</td>
                                            <td>02236</td>
                                            <td>01441</td>
                                            <td>00325</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>7/23/2014 4:33:54 PM</td>
                                            <td>CDXL-30</td>
                                            <td>YEQIF391</td>
                                            <td>02085</td>
                                            <td>01267</td>
                                            <td>00173</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>1/31/2014 1:41:57 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEQFE671</td>
                                            <td>02197</td>
                                            <td>01270</td>
                                            <td>00156</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>1/14/2014 2:43:41 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEPE0252</td>
                                            <td>02363</td>
                                            <td>00134</td>
                                            <td>00036</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>12/26/2013 1:48:08 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEPE0252</td>
                                            <td>02161</td>
                                            <td>00153</td>
                                            <td>00035</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>7/21/2013 2:00:14 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEPE 0252</td>
                                            <td>01926</td>
                                            <td>01049</td>
                                            <td>00178</td>
                                            <td>00003</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-06</td>
                                            <td>11/17/2012 7:09:09 PM</td>
                                            <td>CDXL-30</td>
                                            <td>YEPE0127</td>
                                            <td>02541</td>
                                            <td>01367</td>
                                            <td>00211</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-07</td>
                                            <td>3/15/2024 2:20:41 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZF5380P</td>
                                            <td>03916</td>
                                            <td>00730</td>
                                            <td>00077</td>
                                            <td>00000</td>
                                            <td>00003</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-07</td>
                                            <td>8/22/2023 8:12:24 PM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZF5380P</td>
                                            <td>02415</td>
                                            <td>01120</td>
                                            <td>00055</td>
                                            <td>00000</td>
                                            <td>00009</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-07</td>
                                            <td>11/15/2022 12:35:37 PM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZE2983P</td>
                                            <td>03625</td>
                                            <td>01540</td>
                                            <td>00082</td>
                                            <td>00000</td>
                                            <td>00011</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-07</td>
                                            <td>7/15/2022 2:16:01 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>NA change TPC</td>
                                            <td>02262</td>
                                            <td>00687</td>
                                            <td>00069</td>
                                            <td>00000</td>
                                            <td>00004</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-07</td>
                                            <td>7/14/2022 2:36:37 PM</td>
                                            <td>CDXL-20SP</td>
                                            <td>NA Change TPC</td>
                                            <td>02389</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-07</td>
                                            <td>5/11/2022 3:12:02 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>TEST</td>
                                            <td>00000</td>
                                            <td>00003</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>3/15/2024 2:18:24 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZHC045P</td>
                                            <td>01812</td>
                                            <td>00738</td>
                                            <td>00044</td>
                                            <td>00000</td>
                                            <td>00003</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>2/20/2024 5:11:55 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZHC045P</td>
                                            <td>00272</td>
                                            <td>00131</td>
                                            <td>00006</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>8/2/2023 5:47:21 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZD0121P</td>
                                            <td>02444</td>
                                            <td>01099</td>
                                            <td>00050</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>1/22/2023 7:34:03 PM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZD2008P</td>
                                            <td>02424</td>
                                            <td>01047</td>
                                            <td>00052</td>
                                            <td>00000</td>
                                            <td>00002</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>7/13/2022 5:31:12 PM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCZA8374P</td>
                                            <td>02256</td>
                                            <td>00993</td>
                                            <td>00062</td>
                                            <td>00000</td>
                                            <td>00002</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>12/17/2021 6:34:51 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCWK1701P</td>
                                            <td>02504</td>
                                            <td>01270</td>
                                            <td>00101</td>
                                            <td>00001</td>
                                            <td>00003</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>1/22/2020 8:15:23 AM</td>
                                            <td>CDXL-30SP</td>
                                            <td>LCWG6065P</td>
                                            <td>02414</td>
                                            <td>01439</td>
                                            <td>00138</td>
                                            <td>00000</td>
                                            <td>00002</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>9/24/2019 5:40:28 PM</td>
                                            <td>CDXL-30SD</td>
                                            <td>YMWCE124</td>
                                            <td>01536</td>
                                            <td>00811</td>
                                            <td>00052</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>1/6/2016 5:46:42 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YERGC894</td>
                                            <td>02047</td>
                                            <td>01365</td>
                                            <td>00231</td>
                                            <td>00006</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>10/16/2015 10:24:10 PM</td>
                                            <td>CDXL-30</td>
                                            <td>YEREE155</td>
                                            <td>02199</td>
                                            <td>00657</td>
                                            <td>00184</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>6/4/2015 8:25:36 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEREE155</td>
                                            <td>01382</td>
                                            <td>00920</td>
                                            <td>00066</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>1/2/2014 2:25:17 AM</td>
                                            <td>CDXL-30</td>
                                            <td>YEQB7418</td>
                                            <td>01889</td>
                                            <td>01136</td>
                                            <td>00112</td>
                                            <td>00004</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-08</td>
                                            <td>2/22/2013 1:51:28 PM</td>
                                            <td>CDXL-30</td>
                                            <td>YEPJ6957</td>
                                            <td>02363</td>
                                            <td>01659</td>
                                            <td>00343</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>5/20/2024 8:59:55 AM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDZAD033P</td>
                                            <td>00718</td>
                                            <td>00356</td>
                                            <td>00030</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>3/15/2024 2:25:00 AM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDZJ1313P</td>
                                            <td>01576</td>
                                            <td>00386</td>
                                            <td>00027</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>1/8/2024 4:39:47 AM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDZJ1313P</td>
                                            <td>00760</td>
                                            <td>00353</td>
                                            <td>00024</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>8/22/2023 7:55:28 PM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDZAD046P</td>
                                            <td>01681</td>
                                            <td>00774</td>
                                            <td>00054</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>4/20/2023 6:27:40 AM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDZA4756P</td>
                                            <td>01643</td>
                                            <td>00661</td>
                                            <td>00053</td>
                                            <td>00000</td>
                                            <td>00005</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>12/30/2022 8:19:23 AM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDZA4544P</td>
                                            <td>01430</td>
                                            <td>00600</td>
                                            <td>00039</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>9/5/2022 1:39:52 AM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDZA4536P</td>
                                            <td>01390</td>
                                            <td>00579</td>
                                            <td>00037</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>5/10/2022 7:28:36 PM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDVH4775P</td>
                                            <td>01452</td>
                                            <td>00670</td>
                                            <td>00055</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>5/10/2022 7:27:33 PM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDVH4775P</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>5/10/2022 7:26:07 PM</td>
                                            <td>CDXL-45SP</td>
                                            <td>003-004253-02</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>12/17/2021 8:30:57 AM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDXA3969P</td>
                                            <td>01671</td>
                                            <td>00738</td>
                                            <td>00032</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>7/9/2020 4:00:28 AM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDVH5258P</td>
                                            <td>01501</td>
                                            <td>00811</td>
                                            <td>00063</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>11/14/2019 8:52:06 PM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDVH5260P</td>
                                            <td>01548</td>
                                            <td>00914</td>
                                            <td>00079</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>7/25/2019 4:44:27 PM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDVAB475P</td>
                                            <td>01456</td>
                                            <td>00744</td>
                                            <td>00062</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>3/29/2019 6:20:17 AM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDVH5261P</td>
                                            <td>01633</td>
                                            <td>00810</td>
                                            <td>00048</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>11/30/2018 6:09:28 AM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDVAB041P</td>
                                            <td>01574</td>
                                            <td>00854</td>
                                            <td>00076</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>7/31/2018 3:41:30 PM</td>
                                            <td>CDXL-45SP</td>
                                            <td>LDVAB483P</td>
                                            <td>01567</td>
                                            <td>00872</td>
                                            <td>00068</td>
                                            <td>00001</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>4/12/2018 2:50:04 AM</td>
                                            <td>CDXL-45</td>
                                            <td>YFUAB338</td>
                                            <td>01477</td>
                                            <td>00761</td>
                                            <td>00065</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>1/18/2018 12:16:49 PM</td>
                                            <td>CDXL-45</td>
                                            <td>YFUBF281</td>
                                            <td>01104</td>
                                            <td>00573</td>
                                            <td>00051</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>9/26/2017 5:59:31 AM</td>
                                            <td>CDXL-45</td>
                                            <td>YFTJ4387P</td>
                                            <td>01546</td>
                                            <td>00794</td>
                                            <td>00055</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>6/21/2017 10:41:30 PM</td>
                                            <td>CDXL-45</td>
                                            <td>YFTK4352P</td>
                                            <td>01280</td>
                                            <td>00646</td>
                                            <td>00050</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>3/13/2017 7:15:19 PM</td>
                                            <td>CDXL-45</td>
                                            <td>YFTD4176P</td>
                                            <td>01308</td>
                                            <td>00660</td>
                                            <td>00056</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>12/9/2016 3:06:18 PM</td>
                                            <td>CDXL-45</td>
                                            <td>YFTD3752P</td>
                                            <td>01205</td>
                                            <td>00640</td>
                                            <td>00043</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>8/30/2016 4:19:48 PM</td>
                                            <td>CDXL-45</td>
                                            <td>YFSGA603</td>
                                            <td>01236</td>
                                            <td>00684</td>
                                            <td>00066</td>
                                            <td>00000</td>
                                            <td>00011</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>5/18/2016 8:24:19 AM</td>
                                            <td>CDXL-45</td>
                                            <td>YFSGA773</td>
                                            <td>01287</td>
                                            <td>00680</td>
                                            <td>00051</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>2/3/2016 2:13:38 AM</td>
                                            <td>CDXL-45</td>
                                            <td>YFRKA922P</td>
                                            <td>01325</td>
                                            <td>00714</td>
                                            <td>00061</td>
                                            <td>00000</td>
                                            <td>00008</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>10/19/2015 8:44:35 AM</td>
                                            <td>CDXL-45</td>
                                            <td>YFRK9410P</td>
                                            <td>01321</td>
                                            <td>00663</td>
                                            <td>00050</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>7/5/2015 3:11:58 AM</td>
                                            <td>CDXL-45</td>
                                            <td>YFQID095</td>
                                            <td>01091</td>
                                            <td>00635</td>
                                            <td>00061</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>4/6/2015 2:59:19 AM</td>
                                            <td>CDXL-45</td>
                                            <td>YFRGA177</td>
                                            <td>01124</td>
                                            <td>00588</td>
                                            <td>00042</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-09</td>
                                            <td>12/30/2014 1:07:37 PM</td>
                                            <td>CDXL-45</td>
                                            <td>YFRGA516</td>
                                            <td>01143</td>
                                            <td>00625</td>
                                            <td>00048</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>5/29/2024 6:40:04 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZF5379P</td>
                                            <td>00593</td>
                                            <td>00272</td>
                                            <td>00013</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>3/15/2024 2:24:10 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZF5382P</td>
                                            <td>04065</td>
                                            <td>00445</td>
                                            <td>00039</td>
                                            <td>00000</td>
                                            <td>00010</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>6/23/2023 5:26:22 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZF5382P</td>
                                            <td>03201</td>
                                            <td>01486</td>
                                            <td>00144</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>9/5/2022 1:56:42 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBZA9270P</td>
                                            <td>03624</td>
                                            <td>01844</td>
                                            <td>00193</td>
                                            <td>00000</td>
                                            <td>00003</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>10/14/2021 4:11:15 PM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBWAD393</td>
                                            <td>03688</td>
                                            <td>02018</td>
                                            <td>00144</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>7/25/2019 6:01:54 PM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBWBB305</td>
                                            <td>03830</td>
                                            <td>02175</td>
                                            <td>00192</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>10/11/2018 11:32:14 AM</td>
                                            <td>CDXL-20SP</td>
                                            <td>LBVAB192P</td>
                                            <td>03770</td>
                                            <td>02058</td>
                                            <td>00179</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>10/6/2018 3:44:09 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRL4089P</td>
                                            <td>03201</td>
                                            <td>00039</td>
                                            <td>00004</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>1/18/2018 11:03:54 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDUH5829P</td>
                                            <td>03285</td>
                                            <td>01870</td>
                                            <td>00178</td>
                                            <td>00000</td>
                                            <td>00018</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>4/29/2017 4:09:33 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDTK3012P</td>
                                            <td>03337</td>
                                            <td>01921</td>
                                            <td>00187</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>8/21/2016 7:26:58 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDSCC647</td>
                                            <td>03133</td>
                                            <td>01809</td>
                                            <td>00161</td>
                                            <td>00001</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>12/9/2015 8:16:32 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRL4089P</td>
                                            <td>03060</td>
                                            <td>01709</td>
                                            <td>00137</td>
                                            <td>00000</td>
                                            <td>00002</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>3/29/2015 10:26:39 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRFJ145</td>
                                            <td>02992</td>
                                            <td>01696</td>
                                            <td>00112</td>
                                            <td>00000</td>
                                            <td>00018</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>7/13/2014 2:16:36 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDRBB254</td>
                                            <td>03052</td>
                                            <td>01878</td>
                                            <td>00202</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>12/26/2013 1:44:22 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQC8649</td>
                                            <td>02996</td>
                                            <td>01427</td>
                                            <td>00109</td>
                                            <td>00000</td>
                                            <td>00001</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>11/16/2013 1:42:59 AM</td>
                                            <td>CDXL-20</td>
                                            <td>YDQC 8649</td>
                                            <td>00514</td>
                                            <td>00259</td>
                                            <td>00014</td>
                                            <td>00000</td>
                                            <td>00000</td>
                                        </tr>
                                        <tr>
                                            <td>PBJ</td>
                                            <td>Screen-10</td>
                                            <td>11/17/2012 7:24:37 PM</td>
                                            <td>CDXL-20</td>
                                            <td>YDPE4792</td>
                                            <td>03501</td>
                                            <td>02086</td>
                                            <td>00324</td>
                                            <td>00000</td>
                                            <td>00000</td>
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
    </div>
@endsection

@section('custom_script')
    <!-- ------- DATA TABLE ---- -->
    <script src="{{ asset('/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const lampTypes = {"CDXL-30SP":3,"CDXL-20SP":6,"CDXL-45SP":1};
            const lightUsageHours = {"CDXL-30SP":2082.1481481481483,"CDXL-30":2082.0833333333335,"CDXL-30SD":897.3333333333334,"CDXL-20SP":2998.0731707317073,"CDXL-20":2474.1754385964914,"CDXL-20LB":263,"Other-20":1071,"CDXL-45SP":1270.5882352941176,"CDXL-45":1265.1538461538462};
            const lampsNeededByQuarter = {"2024 Q1":{"CDXL-30SP":3},"2024 Q3":{"CDXL-20SP":3},"2024 Q2":{"CDXL-45SP":1,"CDXL-20SP":1}};
            const lampTypesHistorical = {"CDXL-30SP":27,"CDXL-30":36,"CDXL-30SD":3,"CDXL-20SP":41,"CDXL-20":57,"CDXL-20LB":1,"Other-20":1,"CDXL-45SP":17,"CDXL-45":13};
            const failedStrikesTimeline = {"2024-03":675,"2024-02":28,"2023-08":646,"2023-01":210,"2022-07":322,"2021-12":1042,"2020-01":603,"2019-07":505,"2019-01":793,"2018-08":225,"2018-02":328,"2017-08":476,"2017-05":38,"2016-11":199,"2016-05":268,"2015-11":154,"2015-02":185,"2014-08":413,"2014-02":209,"2013-12":605,"2013-08":212,"2012-11":1150,"2024-07":8,"2022-10":505,"2019-10":963,"2018-12":208,"2018-04":199,"2016-12":183,"2016-04":173,"2015-07":366,"2014-11":646,"2014-04":266,"2013-05":52,"2023-11":30,"2023-02":110,"2022-04":91,"2019-05":97,"2018-07":166,"2017-11":82,"2017-03":148,"2016-07":233,"2015-12":378,"2015-05":131,"2018-06":324,"2018-05":12,"2017-09":164,"2017-01":128,"2015-08":198,"2017-02":241,"2016-06":295,"2015-06":178,"2014-06":201,"2013-06":134,"2017-10":166,"2016-09":70,"2016-03":104,"2016-02":74,"2015-01":325,"2014-07":375,"2014-01":304,"2013-07":178,"2022-11":82,"2022-05":55,"2019-09":52,"2016-01":231,"2015-10":234,"2013-02":343,"2024-05":43,"2024-01":24,"2023-04":53,"2022-12":39,"2022-09":230,"2020-07":63,"2019-11":79,"2019-03":48,"2018-11":76,"2018-01":229,"2017-06":50,"2016-08":227,"2015-04":42,"2014-12":48,"2023-06":144,"2021-10":144,"2018-10":183,"2017-04":187,"2015-03":112,"2013-11":14};
            const failedReStrikesTimeline = {"2024-03":1,"2024-02":0,"2023-08":1,"2023-01":0,"2022-07":0,"2021-12":7,"2020-01":0,"2019-07":0,"2019-01":0,"2018-08":0,"2018-02":0,"2017-08":2,"2017-05":0,"2016-11":0,"2016-05":0,"2015-11":0,"2015-02":0,"2014-08":0,"2014-02":1,"2013-12":2,"2013-08":0,"2012-11":3,"2024-07":0,"2022-10":0,"2019-10":5,"2018-12":0,"2018-04":0,"2016-12":1,"2016-04":0,"2015-07":0,"2014-11":2,"2014-04":0,"2013-05":0,"2023-11":0,"2023-02":0,"2022-04":0,"2019-05":0,"2018-07":1,"2017-11":0,"2017-03":0,"2016-07":1,"2015-12":0,"2015-05":0,"2018-06":0,"2018-05":0,"2017-09":0,"2017-01":0,"2015-08":1,"2017-02":0,"2016-06":1,"2015-06":0,"2014-06":0,"2013-06":0,"2017-10":1,"2016-09":0,"2016-03":0,"2016-02":0,"2015-01":0,"2014-07":0,"2014-01":5,"2013-07":3,"2022-11":0,"2022-05":0,"2019-09":0,"2016-01":6,"2015-10":0,"2013-02":0,"2024-05":0,"2024-01":0,"2023-04":0,"2022-12":0,"2022-09":0,"2020-07":0,"2019-11":0,"2019-03":0,"2018-11":0,"2018-01":0,"2017-06":0,"2016-08":1,"2015-04":0,"2014-12":0,"2023-06":0,"2021-10":0,"2018-10":0,"2017-04":0,"2015-03":0,"2013-11":0};
            const unexpectedOffTimeline = {"2024-03":22,"2024-02":0,"2023-08":46,"2023-01":2,"2022-07":7,"2021-12":31,"2020-01":6,"2019-07":2,"2019-01":2,"2018-08":0,"2018-02":13,"2017-08":3,"2017-05":0,"2016-11":0,"2016-05":0,"2015-11":0,"2015-02":0,"2014-08":0,"2014-02":0,"2013-12":1,"2013-08":0,"2012-11":21,"2024-07":0,"2022-10":0,"2019-10":7,"2018-12":0,"2018-04":0,"2016-12":0,"2016-04":1,"2015-07":0,"2014-11":15,"2014-04":4,"2013-05":2,"2023-11":3,"2023-02":5,"2022-04":39,"2019-05":0,"2018-07":3,"2017-11":1,"2017-03":3,"2016-07":7,"2015-12":2,"2015-05":5,"2018-06":6,"2018-05":0,"2017-09":0,"2017-01":0,"2015-08":0,"2017-02":7,"2016-06":0,"2015-06":0,"2014-06":0,"2013-06":4,"2017-10":2,"2016-09":15,"2016-03":13,"2016-02":8,"2015-01":1,"2014-07":0,"2014-01":1,"2013-07":0,"2022-11":11,"2022-05":0,"2019-09":0,"2016-01":0,"2015-10":0,"2013-02":0,"2024-05":0,"2024-01":0,"2023-04":5,"2022-12":0,"2022-09":4,"2020-07":0,"2019-11":0,"2019-03":1,"2018-11":0,"2018-01":18,"2017-06":0,"2016-08":12,"2015-04":0,"2014-12":0,"2023-06":0,"2021-10":0,"2018-10":0,"2017-04":0,"2015-03":18,"2013-11":0};
            console.log(failedStrikesTimeline);
            const fixedColors = [
                '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd',
                '#8c564b', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf'
            ];

            // Helper function to create charts
            function createChart(ctx, title, data, colors, type = 'bar') {
                const labels = Object.keys(data);
                const values = Object.values(data);
                const backgroundColors = colors || labels.map((_, i) => fixedColors[i % fixedColors.length]);

                new Chart(ctx, {
                    type: type,
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
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        return context.dataset.label + ': ' + context.parsed.y;
                                    }
                                }
                            },
                            datalabels: {
                                anchor: 'end',
                                align: 'top',
                                formatter: function(value, context) {
                                    return value;
                                },
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                });
            }

            // Filter out NA values
            function filterNA(data) {
                return Object.fromEntries(Object.entries(data).filter(([key, value]) => key !== 'NA'));
            }

            function filterData(data) {
                const currentDate = moment();
                const tenYearsAgo = currentDate.clone().subtract(10, 'years');

                return Object.entries(data).filter(([date, value]) => {
                    return moment(date, "YYYY-MM").isAfter(tenYearsAgo);
                }).reduce((acc, [date, value]) => {
                    acc[date] = value;
                    return acc;
                }, {});
            }

            // Lamp Types Installed Based on Historical Entry
            const lampTypesHistoricalCtx = document.getElementById('lampTypesHistoricalChart').getContext('2d');
            createChart(lampTypesHistoricalCtx, 'Lamp Types Installed Based on Historical Entry', filterNA(lampTypesHistorical));

            // Lamp Types Installed Based on Last Entry
            const lampTypesCtx = document.getElementById('lampTypesChart').getContext('2d');
            createChart(lampTypesCtx, 'Lamp Types Installed', filterNA(lampTypes));

            // Average Light Usage Hours by Lamp Type
            const lightUsageCtx = document.getElementById('lightUsageChart').getContext('2d');
            createChart(lightUsageCtx, 'Average Light Usage Hours', filterNA(lightUsageHours));

            // Estimate Lamps Needed by Quarter
            const lampsNeededCtx = document.getElementById('lampsNeededChart').getContext('2d');
            const lampsNeededData = Object.keys(lampsNeededByQuarter).reduce((acc, quarter) => {
                const models = lampsNeededByQuarter[quarter];
                Object.keys(models).forEach(model => {
                    if (!acc[model]) acc[model] = {};
                    acc[model][quarter] = models[model];
                });
                return acc;
            }, {});

            const colors = ['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd'];
            let colorIndex = 0;

            const datasets = Object.keys(lampsNeededData).map((model, index) => ({
                label: model,
                data: Object.keys(lampsNeededData[model]).map(quarter => ({
                    x: quarter,
                    y: lampsNeededData[model][quarter]
                })),
                borderColor: colors[index % colors.length],
                backgroundColor: colors[index % colors.length].replace('1)', '0.2)'),
                fill: false,
                borderWidth: 2
            }));

            new Chart(lampsNeededCtx, {
                type: 'line',
                data: {
                    datasets: datasets
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            type: 'category'
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return context.dataset.label + ': ' + context.parsed.y;
                                }
                            }
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            formatter: function(value, context) {
                                return value.y;
                            },
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                }
            });

            const allDates = [...new Set([
                ...Object.keys(failedStrikesTimeline),
                ...Object.keys(failedReStrikesTimeline),
                ...Object.keys(unexpectedOffTimeline)
            ])].sort();

            // Create a function to fill in missing dates with 0
            const fillMissingDates = (data) => {
                return filterData(allDates.reduce((acc, date) => {
                    acc[date] = data[date] || 0;
                    return acc;
                }, {}));
            };

    // Fill in missing dates for each dataset
            const filledDataTimeline01 = fillMissingDates(failedStrikesTimeline);
            const filledDataTimeline02 = fillMissingDates(failedReStrikesTimeline);
            const filledDataTimeline03 = fillMissingDates(unexpectedOffTimeline);


            // Timeline of Failures
            const failuresTimelineCtx = document.getElementById('failuresTimelineChart').getContext('2d');
            new Chart(failuresTimelineCtx, {
                type: 'line',
                plugins: [ChartDataLabels],
                data: {
                    labels: Object.keys(filledDataTimeline01),
                    datasets: [
                        {
                            label: 'Failed Strikes',
                            data: Object.values(filterNA(filledDataTimeline01)),
                            // borderColor: '#d62728',
                            // backgroundColor: 'rgba(214, 39, 40, 0.2)',
                            // fill: false,
                            // borderWidth: 2
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.3,
                            pointBackgroundColor: 'rgb(75, 192, 192)',
                            backgroundColor: 'rgb(75, 192, 192)',
                            pointBorderColor: 'white',
                            pointBorderWidth: 2,
                            pointRadius: 6
                        },
                        {
                            label: 'Failed ReStrikes',
                            data: Object.values(filterNA(filledDataTimeline02)),
                            // borderColor: '#ff7f0e',
                            // backgroundColor: 'rgba(255, 127, 14, 0.2)',
                            // fill: false,
                            // borderWidth: 2
                            borderColor: 'rgb(54, 162, 235)',
                            tension: 0.3,
                            pointBackgroundColor: 'rgb(54, 162, 235)',
                            backgroundColor: 'rgb(54, 162, 235)',
                            pointBorderColor: 'white',
                            pointBorderWidth: 2,
                            pointRadius: 6
                        },
                        {
                            label: 'Unexpected Off',
                            data: Object.values(filterNA(filledDataTimeline03)),
                            // borderColor: '#1f77b4',
                            // backgroundColor: 'rgba(31, 119, 180, 0.2)',
                            // fill: false,
                            // borderWidth: 2
                            borderColor: 'rgb(255, 99, 132)',
                            tension: 0.3,
                            pointBackgroundColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgb(255, 99, 132)',
                            pointBorderColor: 'white',
                            pointBorderWidth: 2,
                            pointRadius: 6
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            type: 'time',
                            time: {
                                unit: 'month'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return context.dataset.label + ': ' + context.parsed.y;
                                }
                            }
                        },
                        datalabels: {
                            backgroundColor: function(context) {
                                return context.dataset.borderColor;
                            },
                            borderRadius: 4,
                            color: 'white',
                            font: {
                                weight: 'bold'
                            },
                            padding: 6,
                            align: 'start', // Changed from 'start' to 'bottom'
                            anchor: 'start',   // Changed from 'start' to 'end'
                            offset: -40        // Added to fine-tune positioning
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lampList = document.getElementById('lampList');
            const screenSelect = document.getElementById('screenSelect');
            const installedFilter = document.getElementById('installedFilter');
            const errorsFilter = document.getElementById('errorsFilter');

            function filterLamps() {
                const selectedScreen = screenSelect.value;
                const showInstalled = installedFilter.checked;
                const showErrors = errorsFilter.checked;
                const rows = lampList.getElementsByTagName('tr');

                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const screenCell = row.getElementsByTagName('td')[1];
                    const installDate = row.getElementsByTagName('td')[2].textContent;
                    const failedStrikes = row.getElementsByTagName('td')[7].textContent;
                    const failedReStrikes = row.getElementsByTagName('td')[8].textContent;
                    const unexpectedOff = row.getElementsByTagName('td')[9].textContent;

                    let showRow = true;

                    if (selectedScreen !== 'all' && screenCell.textContent !== selectedScreen) {
                        showRow = false;
                    }

                    if (showInstalled) {
                        const latestLamp = {
                            "Screen-01": {
                                "Light Index": "00000",
                                "Light Install Date": "3\/15\/2024 2:14:09 AM",
                                "Light Serial Number": "LCZHC709P",
                                "Light Model": "CDXL-30SP",
                                "Light Strikes": "00740",
                                "Light Failed Strikes": "00037",
                                "Light Failed ReStrikes": "00000",
                                "Light Unexpected Off": "00000",
                                "Light Hours": "01723"
                            },
                            "Screen-02": {
                                "Light Index": "00000",
                                "Light Install Date": "7\/9\/2024 2:30:35 AM",
                                "Light Serial Number": "LBZFB752P",
                                "Light Model": "CDXL-20SP",
                                "Light Strikes": "00058",
                                "Light Failed Strikes": "00004",
                                "Light Failed ReStrikes": "00000",
                                "Light Unexpected Off": "00000",
                                "Light Hours": "00105"
                            },
                            "Screen-03": {
                                "Light Index": "00000",
                                "Light Install Date": "3\/15\/2024 2:16:23 AM",
                                "Light Serial Number": "LBZF5378P",
                                "Light Model": "CDXL-20SP",
                                "Light Strikes": "00720",
                                "Light Failed Strikes": "00041",
                                "Light Failed ReStrikes": "00000",
                                "Light Unexpected Off": "00006",
                                "Light Hours": "02675"
                            },
                            "Screen-04": {
                                "Light Index": "00000",
                                "Light Install Date": "7\/9\/2024 2:16:56 AM",
                                "Light Serial Number": "LBZFB763P",
                                "Light Model": "CDXL-20SP",
                                "Light Strikes": "00055",
                                "Light Failed Strikes": "00001",
                                "Light Failed ReStrikes": "00000",
                                "Light Unexpected Off": "00000",
                                "Light Hours": "00101"
                            },
                            "Screen-05": {
                                "Light Index": "00000",
                                "Light Install Date": "3\/15\/2024 2:18:22 AM",
                                "Light Serial Number": "LCZHC062P",
                                "Light Model": "CDXL-30SP",
                                "Light Strikes": "00720",
                                "Light Failed Strikes": "00058",
                                "Light Failed ReStrikes": "00000",
                                "Light Unexpected Off": "00000",
                                "Light Hours": "01796"
                            },
                            "Screen-06": {
                                "Light Index": "00000",
                                "Light Install Date": "7\/9\/2024 2:38:21 AM",
                                "Light Serial Number": "LBZHC994P",
                                "Light Model": "CDXL-20SP",
                                "Light Strikes": "00047",
                                "Light Failed Strikes": "00003",
                                "Light Failed ReStrikes": "00000",
                                "Light Unexpected Off": "00000",
                                "Light Hours": "00108"
                            },
                            "Screen-07": {
                                "Light Index": "00000",
                                "Light Install Date": "3\/15\/2024 2:20:41 AM",
                                "Light Serial Number": "LBZF5380P",
                                "Light Model": "CDXL-20SP",
                                "Light Strikes": "00730",
                                "Light Failed Strikes": "00077",
                                "Light Failed ReStrikes": "00000",
                                "Light Unexpected Off": "00003",
                                "Light Hours": "03916"
                            },
                            "Screen-08": {
                                "Light Index": "00000",
                                "Light Install Date": "3\/15\/2024 2:18:24 AM",
                                "Light Serial Number": "LCZHC045P",
                                "Light Model": "CDXL-30SP",
                                "Light Strikes": "00738",
                                "Light Failed Strikes": "00044",
                                "Light Failed ReStrikes": "00000",
                                "Light Unexpected Off": "00003",
                                "Light Hours": "01812"
                            },
                            "Screen-09": {
                                "Light Index": "00000",
                                "Light Install Date": "5\/20\/2024 8:59:55 AM",
                                "Light Serial Number": "LDZAD033P",
                                "Light Model": "CDXL-45SP",
                                "Light Strikes": "00356",
                                "Light Failed Strikes": "00030",
                                "Light Failed ReStrikes": "00000",
                                "Light Unexpected Off": "00000",
                                "Light Hours": "00718"
                            },
                            "Screen-10": {
                                "Light Index": "00000",
                                "Light Install Date": "5\/29\/2024 6:40:04 AM",
                                "Light Serial Number": "LBZF5379P",
                                "Light Model": "CDXL-20SP",
                                "Light Strikes": "00272",
                                "Light Failed Strikes": "00013",
                                "Light Failed ReStrikes": "00000",
                                "Light Unexpected Off": "00000",
                                "Light Hours": "00593"
                            }
                        };
                        const latestLampDate = latestLamp[screenCell.textContent]['Light Install Date'] ?? null;

                        if (!latestLampDate || installDate !== latestLampDate) {
                            showRow = false;
                        }
                    }

                    if (showErrors) {
                        if (
                            (failedStrikes === '00000' || failedStrikes === 'N/A') &&
                            (failedReStrikes === '00000' || failedReStrikes === 'N/A') &&
                            (unexpectedOff === '00000' || unexpectedOff === 'N/A')
                        ) {
                            showRow = false;
                        }
                    }

                    row.style.display = showRow ? '' : 'none';
                }
            }

            screenSelect.addEventListener('change', filterLamps);
            installedFilter.addEventListener('change', filterLamps);
            errorsFilter.addEventListener('change', filterLamps);
        });
    </script>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <style>
        .indicator-box {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
    </style>
@endsection
