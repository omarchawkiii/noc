@extends('layouts.app')
@section('title')
    Lamp List
@endsection
@section('content')
    <div class="page-header library-shadow">
        <h3 class="page-title">Lamp List </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lamp List </li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-12 row">


                    <div class="col-xl-12">
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
                                    <th> Date Installed</th>
                                    <th>Lamp Model</th>
                                    <th>Lamp Serial</th>
                                    <th>Lamp Hours</th>
                                    <th>Total Strikes</th>
                                    <th>Failed Strikes</th>
                                    <th>Failed Restrikes</th>
                                    <th>Unexpected Off</th>
                                </tr>
                            </thead>
                            <tbody id="deviceList2">
                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-01</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-01</td>
                                    <td>01/31/2022<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00666</td>
                                    <td>02281</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00005</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-01</td>
                                    <td>02/19/2023<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>03513</td>
                                    <td>01551</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00002</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-01</td>
                                    <td>10/09/2023<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00777</td>
                                    <td>05481</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-02</td>
                                    <td>05/22/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>04666</td>
                                    <td>00381</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-02</td>
                                    <td>06/15/2021<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>03513</td>
                                    <td>00381</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00001</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-02</td>
                                    <td>04/05/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00006</td>
                                    <td>00000</td>
                                    <td>00005</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-02</td>
                                    <td>09/09/2022<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00011</td>
                                    <td>00000</td>
                                    <td>00003</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-03</td>
                                    <td>01/12/2022<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00001</td>
                                    <td>00000</td>
                                    <td>00001</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-03</td>
                                    <td>02/13/2023<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00006</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-03</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00013</td>
                                    <td>00001</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-03</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00012</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-04</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00016</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-04</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00008</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-04</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00005</td>
                                    <td>00001</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-04</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-04</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-05</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-05</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-05</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-05</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-05</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-05</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-06</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00021</td>
                                    <td>00000</td>
                                    <td>00000</td>
                                </tr>

                                <tr>
                                    <td>PBJ</td>
                                    <td>Screen-06</td>
                                    <td>04/19/2024<br />5:46:5PM</td>
                                    <td>CDXL-60</td>
                                    <td>LHZF1764AMP</td>
                                    <td>00577</td>
                                    <td>00381</td>
                                    <td>00021</td>
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
         //   const locationSelect = document.getElementById('locationSelect2');
            const screenSelect = document.getElementById('screenSelect2');

            function filterTable() {
                const selectedLocation = 'all';
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

            //locationSelect.addEventListener('change', filterTable);
            screenSelect.addEventListener('change', filterTable);
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
