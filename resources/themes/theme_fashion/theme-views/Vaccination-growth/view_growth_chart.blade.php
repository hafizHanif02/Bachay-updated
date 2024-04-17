@extends('theme-views.layouts.parenting-header')

@push('css_or_js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <meta property="og:image" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta property="og:title" content="Welcome To {{ $web_config['name']->value }} Home" />
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">

    <meta property="twitter:card"
        content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta property="twitter:title" content="Welcome To {{ $web_config['name']->value }} Home" />
    <meta property="twitter:url" content="{{ config('app.url') }}">
    <meta property="twitter:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">
@endpush
<style>
    .breadcrumb li:not(:last-child)::after {
        content: '' !important;
        margin: 0 !important;
    }

    .vaccination-growth-container {
        margin: 0 70px 100px 70px;
    }

    .vaccination-mainp {
        width: 70%;
        border: 1px solid #ededed;
        border-radius: 3px;
        /* padding: 0 10px 10px 10px; */
    }

    .vaccine_main {
        margin: 10px 0 0 0;
    }

    .btn_clr {
        background: #f56996;
        border: none;
        color: #fff;
        border: 1px solid #f56996;
        border-radius: 5px;
        padding: 5px 10px;
    }

    .btn_clr:hover {
        background: #fff;
        border: 1px solid #f56996;
        color: #f56996;
    }

    .downloadApp-right {
        width: 30%;
        border: 1px solid #ededed;
        border-radius: 3px;
        padding: 16px 10px 20px 10px;
    }

    .downloadApp-right {
        padding-bottom: 0;
        background-image: url(https://cdn.cdnparenting.com/brainbees/community/preact/public/media/Personalization_BG.png);
        background-repeat: no-repeat;
        background-size: cover;
        background-origin: content-box;
        background-position: bottom;
        height: 98vh;
        overflow-y: auto;
        position: sticky;
        top: 5px;
    }

    .child-profile {
        width: 100%;
        background-color: #f5f5f5;
        border: 1px solid #ededed;
        padding: 24px 24px 19px 44px;
        overflow: hidden;
    }

    .child-profile img {
        border: 5px solid #fff;
    }

    .vc_title {
        background-color: #f5f5f5;
        text-transform: capitalize;
        height: initial;
        margin-bottom: 16px;
        padding: 10px;
        border-bottom: 1px solid #eee;
        background: #eee;
        border-radius: 3px;

    }

    .vacci-growthB,
    .vaccination_tr,
    .table_growth_chart {
        border: 1px solid #ededed;

    }

    .custom-dt-clr {
        font-weight: 500;
        color: #616161;
        font-size: 16px;
    }

    .vc_upcoming {
        border: 2px solid #feb134;
        border-radius: 50%;
        padding: 2px;
    }

    .vc_upcoming-child {
        width: 80px;
        height: 80px;
        background: #feb134;
        border-radius: 50%;
    }

    .overdue {
        border: 2px solid #ea514e;
        border-radius: 50%;
        padding: 2px;
    }

    .overdue-child {
        width: 80px;
        height: 80px;
        background: #ea514e;
        border-radius: 50%;
    }

    .vc_comppleted {
        border: 2px solid #8cbc59;
        border-radius: 50%;
        padding: 2px;
    }

    .vc_comppleted-child {
        width: 80px;
        height: 80px;
        background: #8cbc59;
        border-radius: 50%;
    }

    .vc_num_count {
        font-size: 22px;
        font-weight: 500;
        line-height: 33px;
    }

    .view_gr_tr a {
        text-align: center;
        text-transform: uppercase;
        border-radius: 3px;
        border: 1px solid #ededed;
        padding: 5px 40px;
        width: 400px;
        color: #424242;
        font-size: 15px;
        line-height: 21px;
    }

    .view_vc_tr a {
        width: 400px;
        background: #f56996;
        text-align: center;
        text-transform: uppercase;
        border-radius: 3px;
        color: #424242;
        font-size: 16px;
        line-height: 21px;
        padding: 10px 40px;
    }

    .Add_growth_child {
        color: #f56996;
        background: none;
        text-transform: capitalize;
        font-size: 17px;
        font-weight: 600;
        line-height: 24px;
        font-family: 'poppins'

    }

    .vaccination-table-growth tr td {
        font-size: 14px;
        color: #757575;
        font-family: 'poppins';
        font-weight: 400;
    }

    .Add_child_gr tr td input {
        border-bottom: 1px solid #000;
        border-top: none;
        border-left: none;
        border-right: none;
    }

    .Add_child_gr tr td input:focus-visible {
        border-bottom: 1px solid #000;
        border-top: none;
        border-left: none;
        border-right: none;
    }

    .Add_child_gr tr td input:focus {
        border-bottom: 1px solid #000;
        border-top: none;
        border-left: none;
        border-right: none;
    }

    .downloadApp-right h6 {
        font-size: 14px;
        font-weight: 600;
        color: #424242;
        text-align: center;
    }

    .Add_child_gr tr td select {
        border: none;
    }

    .panel-heading,
    .panel-title {
        background: #EEEEEE;
    }

    @media only screen and (max-width: 768px) {
        .vaccination-growth-container {
            margin: 0 0 100px 0;
        }

        .vaccination-mainp {
            width: 100%;
        }

        .downloadApp-right {
            display: none;
        }

        .view_vc_tr a,
        .view_gr_tr a {
            width: fit-content;
        }
    }
</style>

@section('content')
    <div class="container">
        <div class="vaccination-growth-container">

            <h3 class="mt-4">{{ $child->name }} Growth Tracker</h3>
            <?php
                // Assuming $child->dob contains the date of birth in 'Y-m-d' format
                $dob = new DateTime($child->dob);
                $interval = new DateInterval('P1M'); // 1 month interval

                // Initialize an array to store dates and ages
                $dateAgeArray = array();

                // Get 18 dates after the date of birth with 1 month gap and calculate age for each date
                for ($i = 0; $i < 19; $i++) {
                    $date = $dob->add($interval);
                    $currentDate = new DateTime();
                    $ageInterval = $dob->diff($currentDate);
                    
                    // Format the age
                    $age = '';
                    if ($ageInterval->y > 0) {
                        $age .= $ageInterval->y . ' year';
                        if ($ageInterval->y > 1) {
                            $age .= 's';
                        }
                        if ($ageInterval->m > 0) {
                            $age .= ', ' . $ageInterval->m . ' month';
                            if ($ageInterval->m > 1) {
                                $age .= 's';
                            }
                        }
                    } elseif ($ageInterval->m > 0) {
                        $age .= $ageInterval->m . ' month';
                        if ($ageInterval->m > 1) {
                            $age .= 's';
                        }
                    } elseif ($ageInterval->d > 0) {
                        $age .= $ageInterval->d . ' day';
                        if ($ageInterval->d > 1) {
                            $age .= 's';
                        }
                    }
                    $dateAgeArray[] = array(
                        'date' => $date->format('Y-m-d'),
                        'age' => $age
                    );
                }
                ?>
                <hr>


            <div class="vaccination-growth-child-container d-flex">
                <div class="vaccination-mainp">



                    <div class="weight_growth_chart">
                        <div class="panel-heading p-3">
                            <h6 class="panel-title font-poppins fw-bold">
                                Weight (12 kg)
                            </h6>
                        </div>
                        <div class="panel-body">
                            <div class="p-3">
                                <span>
                                    Updated Weight On
                                </span>
                                <span class="fw-bold">
                                    26th Oct 2023 : 12 kg
                                </span>

                            </div>
                            <h6 class="p-3 font-poppins fw-bold">
                                WEIGHT (kg)
                            </h6>
                            <div style="width: 100%; overflow-x: auto;">
                                <div style="width: 700px; margin: 0 auto;">
                                    <canvas id="weightChart"></canvas>

                                </div>
                            </div>

                        </div>
                        <div class="table_growth_chart m-3">
                            <div class="panel-headin">
                                <h6 class="panel-title p-3 font-poppins fw-bold">
                                    Measurement
                                </h6>
                            </div>
                            <table class="table table-borderless">
                                <thead style="background-color: #C4C4C4; ">
                                    <tr>
                                        <th scope="col" class="M14_42">Date</th>
                                        <th scope="col" class="M14_42">Age</th>
                                        <th scope="col" class="M14_42">Weight</th>
                                        <th scope="col" class="M14_42"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dateAgeArray as $date)
                                    <?php $growth = \App\Models\Growth::where('child_id', $child->id)->where('date', $date['date'])->first();
                                    ?>
                                    <tr>
                                        <td class="R14_75" scope="row">{{ date_create($date['date'])->format('jS M Y') }}                                        </td>
                                        <td class="R14_75">{{ $date['age'] }}</td>
                                        <td class="R14_75">{{ ($growth ? $growth->weight : '-') }}</td>
                                        <td>
                                            <?php $formattedDate = date_create($date['date'])->format('Y-m-d'); ?>
                                            <button type="button" onclick="DateChange('{{ $formattedDate }}')" class="Add_growth_child border-0" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{-- <tr>
                                        <td class="R14_75" scope="row">27th Sep 2022</td>
                                        <td class="R14_75">Birth</td>
                                        <td class="R14_75">----</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="Add_growth_child border-0" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Add
                                            </button>
                                        </td>
                                    </tr> --}}
                                   
                                </tbody>
                            </table>




                        </div>


                    </div>
                    <div class="height_growth_chart">
                        <div class="panel-heading p-3">
                            <h6 class="panel-title font-poppins fw-bold">
                                Height (0 CM)
                            </h6>
                        </div>
                        <div class="panel-body">
                            <div class="p-3">
                                <span>
                                    Updated Height On :
                                </span>
                                <span class="fw-bold">
                                    26th Oct 2023 : 0 CM(0 In)
                                </span>

                            </div>
                            <h6 class="p-3 font-poppins fw-bold">
                                HEIGHT (CM)
                            </h6>
                            <div style="width: 100%; overflow-x: auto;">
                                <div style="width: 700px; margin: 0 auto;">
                                    <canvas id="heightChart"></canvas>

                                </div>
                            </div>

                        </div>
                        <div class="table_growth_chart m-3">
                            <div class="panel-headin">
                                <h6 class="panel-title p-3 font-poppins fw-bold">
                                    Measurement
                                </h6>
                            </div>
                            <table class="table table-borderless">
                                <thead style="background-color: #C4C4C4; ">
                                    <tr>
                                        <th scope="col" class="M14_42">Date</th>
                                        <th scope="col" class="M14_42">Age</th>
                                        <th scope="col" class="M14_42">Height</th>
                                        <th scope="col" class="M14_42"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dateAgeArray as $date)
                                    <?php $growth = \App\Models\Growth::where('child_id', $child->id)->where('date', $date['date'])->first();
                                    ?>
                                    <tr>
                                        <td class="R14_75" scope="row">{{ date_create($date['date'])->format('jS M Y') }}                                        </td>
                                        <td class="R14_75">{{ $date['age'] }}</td>
                                        <td class="R14_75">{{ ($growth ? $growth->height : '-') }}</td>
                                        <td>
                                            <?php $formattedDate = date_create($date['date'])->format('Y-m-d'); ?>
                                            <button type="button" onclick="DateChange('{{ $formattedDate }}')" class="Add_growth_child border-0" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    {{-- <tr>
                                        <td class="R14_75" scope="row">27th Sep 2022</td>
                                        <td class="R14_75">Birth</td>
                                        <td class="R14_75">----</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="Add_growth_child border-0" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Add
                                            </button>
                                        </td>
                                    </tr> --}}
                                   
                                </tbody>
                            </table>

                            <!-- Add Growth Details Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Growth
                                                Details
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="w-100">
                                                <tbody class="Add_child_gr">
                                                <form  action="{{ route('growth-submit', $child->id) }}" method="POST">
                                                    @csrf
                                                    <tr>
                                                        <td>Date</td>
                                                        <td>
                                                            <input type="date" name="date"  id="markdate" >
                                                        </td>
                                                        <td>
                                                            <button class="calendar_icon" id="markdatedatepicker"
                                                                aria-label="Pick a Date"></button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <span id="dobErrMsg" class="error_message"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Weight</td>
                                                        <td>
                                                            <input type="text" name="weight" id="weight"
                                                                maxlength="5">
                                                        </td>
                                                        <td>
                                                            <span>kg</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <span id="errmsgweight" class="error_message"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Height</td>
                                                        <td>
                                                            <input type="text" name="height" id="height"
                                                                maxlength="5">
                                                        </td>
                                                        <td>
                                                            <select name="height_unit" id="htut">
                                                                <option value="cm">CM</option>
                                                                <option value="inc">In.</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <span id="errmsgheight" class="error_message"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Head Circ.</td>
                                                        <td>
                                                            <input type="text" name="head_circle" id="hc"
                                                                maxlength="5">
                                                        </td>
                                                        <td>
                                                            <select name="head_circle_unit" id="hcut">
                                                                <option value="cm">CM</option>
                                                                <option value="inc">In.</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <span id="errmsgheightcirc" class="error_message"></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="border-0 bg-transparent"
                                                data-bs-dismiss="modal">CANCEL</button>
                                            <button type="submit" class="Add_growth_child border-0">SAVE
                                            </button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="headarea_growth_chart">
                        <div class="panel-heading p-3">
                            <h6 class="panel-title font-poppins fw-bold">

                                Head Circ. (25 CM )

                            </h6>
                        </div>
                        <div class="panel-body">
                            <div class="p-3">
                                <span>
                                    Updated Head Circ On :
                                </span>
                                <span class="fw-bold">
                                    26th Oct 2023 : 25 CM (9.84 In)
                                </span>

                            </div>
                            <h6 class="p-3 font-poppins fw-bold">
                                HEAD CIR.(CM)
                            </h6>
                            <div style="width: 100%; overflow-x: auto;">
                                <div style="width: 700px; margin: 0 auto;">
                                    <canvas id="headAreaChart"></canvas>

                                </div>
                            </div>

                        </div>
                        <div class="table_growth_chart m-3">
                            <div class="panel-headin">
                                <h6 class="panel-title p-3 font-poppins fw-bold">
                                    Measurement
                                </h6>
                            </div>
                            <table class="table table-borderless">
                                <thead style="background-color: #C4C4C4; ">
                                    <tr>
                                        <th scope="col" class="M14_42">Date</th>
                                        <th scope="col" class="M14_42">Age</th>
                                        <th scope="col" class="M14_42">Head Cricle</th>
                                        <th scope="col" class="M14_42"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dateAgeArray as $date)
                                    <?php $growth = \App\Models\Growth::where('child_id', $child->id)->where('date', $date['date'])->first();
                                    ?>
                                    <tr>
                                        <td class="R14_75" scope="row">{{ date_create($date['date'])->format('jS M Y') }}                                        </td>
                                        <td class="R14_75">{{ $date['age'] }}</td>
                                        <td class="R14_75">{{ ($growth ? $growth->head_circle : '-') }}</td>
                                        <td>
                                            <?php $formattedDate = date_create($date['date'])->format('m-Y-d'); ?>
                                            <button type="button" onclick="DateChange('{{ $formattedDate }}')" class="Add_growth_child border-0" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{-- <tr>
                                        <td class="R14_75" scope="row">27th Sep 2022</td>
                                        <td class="R14_75">Birth</td>
                                        <td class="R14_75">----</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="Add_growth_child border-0" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Add
                                            </button>
                                        </td>
                                    </tr> --}}
                                   
                                </tbody>
                            </table>
                        </div>


                    </div>
                    

                    <div class="text-center">
                        <!-- Button trigger modal -->
                        <button class="btn_clr ps-5 pe-5 m-3" type="button" class="Add_growth_child border-0"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add growth details
                        </button>
                    </div>
                </div>
                <div class="downloadApp-right">

                    <h6 class="font-poppins text-center mt-4">
                        Join the largest community of parents and see parenting in a new way
                    </h6>
                    <h5 class="text-center mt-3 mb-3">Download our App</h5>
                    <div class="d-flex gap-3">
                        <button class="btn_clr w-50 p-2">
                            <i class="bi bi-apple"></i> Get for iOS
                        </button>
                        <button class="btn_clr w-50 p-2">
                            <i class="bi bi-google-play"></i> Get for Android
                        </button>
                    </div>
                    <div class="mt-3">
                        <img src="{{ asset('public/images/mobile-parenting.png') }}" alt="" width="100%">
                    </div>
                </div>
            </div>





        </div>

    </div>



            
    <script>
        function DateChange(date){
            console.log(date, $('#markdate').val());
            $('#markdate').val('');
            $('#markdate').val(date);
        }
    </script>
    
    <script>
        const ageData = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        var weightData1 = {!! json_encode($weightarray) !!};
        var heightData1 = {!! json_encode($heightarray) !!};
        var headAreaData1 = {!! json_encode($headarray) !!};

        var weightData = weightData1.map(value => {
            return value.replace(/\D/g, '');
        });

        var heightData = heightData1.map(value => {
            return value.replace(/\D/g, '');
        });

        var headAreaData = headAreaData1.map(value => {
            return value.replace(/\D/g, '');
        });

        var weightData = weightData1.map(value => parseFloat(value));
        var heightData = heightData1.map(value => parseFloat(value));
        var headAreaData = headAreaData1.map(value => parseFloat(value));

        

        // const heightData = [70, 75, 80, 85, 90, 95, 100, 105, 110, 115];
        // const headAreaData = [30, 32, 34, 36, 38, 40, 42, 44, 46, 48];
        const idealWeightRange = [14, 24];
        const idealHeightRange = [80, 100];
        const idealHeadAreaRange = [32, 44];

        // Chart configuration
        const config = {
            type: 'line',
            data: {
                labels: ageData,
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Age'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Metric'
                        }
                    }
                }
            }
        };

        // Weight Chart
        const weightChartConfig = {
            ...config,
            data: {
                ...config.data,
                datasets: [{
                    label: 'Weight',
                    data: weightData,
                    borderColor: 'blue',
                    fill: false
                }, {
                    label: 'Ideal Range',
                    data: Array(ageData.length).fill(idealWeightRange),
                    borderColor: 'green',
                    borderWidth: 1,
                    borderDash: [5],
                    fill: false,
                    pointRadius: 0
                }]
            },
            options: {
                ...config.options,
                scales: {
                    ...config.options.scales,
                    y: {
                        ...config.options.scales.y,
                        suggestedMin: 0
                    }
                }
            }
        };

        // Height Chart
        const heightChartConfig = {
            ...config,
            data: {
                ...config.data,
                datasets: [{
                    label: 'Height',
                    data: heightData,
                    borderColor: 'red',
                    fill: false
                }, {
                    label: 'Ideal Range',
                    data: Array(ageData.length).fill(idealHeightRange),
                    borderColor: 'green',
                    borderWidth: 1,
                    borderDash: [5],
                    fill: false,
                    pointRadius: 0
                }]
            },
            options: {
                ...config.options,
                scales: {
                    ...config.options.scales,
                    y: {
                        ...config.options.scales.y,
                        suggestedMin: 0
                    }
                }
            }
        };

        // Head Area Chart
        const headAreaChartConfig = {
            ...config,
            data: {
                ...config.data,
                datasets: [{
                    label: 'Head Area',
                    data: headAreaData,
                    borderColor: 'purple',
                    fill: false
                }, {
                    label: 'Ideal Range',
                    data: Array(ageData.length).fill(idealHeadAreaRange),
                    borderColor: 'green',
                    borderWidth: 1,
                    borderDash: [5],
                    fill: false,
                    pointRadius: 0
                }]
            },
            options: {
                ...config.options,
                scales: {
                    ...config.options.scales,
                    y: {
                        ...config.options.scales.y,
                        suggestedMin: 0
                    }
                }
            }
        };

        // Render charts
        new Chart(document.getElementById('weightChart'), weightChartConfig);
        new Chart(document.getElementById('heightChart'), heightChartConfig);
        new Chart(document.getElementById('headAreaChart'), headAreaChartConfig);
    </script>
@endsection
