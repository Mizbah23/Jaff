@extends('admin.master')
@section('title'){{$title}}@stop
@section('content')
                <!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
    <div class="row match-height" >
        
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card bg-analytics text-white">
                <div class="card-content">
                    <div class="card-body text-center">
                       {{--  <img src="../../../app-assets/images/elements/decore-left.png" class="img-left" alt="card-img-left">
                        <img src="../../../app-assets/images/elements/decore-right.png" class="img-right" alt="card-img-right"> --}}
                        <div class="avatar avatar-xl bg-primary shadow mt-0">
                            <div class="avatar-content">
                                <i class="feather icon-award white font-large-1"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h2 class="mb-2 text-white">Welcome {{ucfirst(trans(Auth::guard('admin')->user()->name))}},</h2>
                            <p class="m-auto w-75">You have total <strong>{{$total_books->count()}}</strong> bookings in last 7 days.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       {{--  Registered Users Chart --}}
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                   
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-users text-primary font-medium-5"></i>
                        </div>
                    </div>
                    
                    <h2 class="text-bold-700 mt-1 mb-25">Total {{$total->count()}} users</h2>
                    <p class="mb-0">Registered in last 7 days</p>
                    
                </div> 
                <div class="card-content">
                    <div id="subscribe-gain-chart"></div>
                </div>
            </div>
        </div>

       {{--  Booked Slot Chart --}}
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-package text-warning font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 mt-1 mb-25">Total {{$total_books->count()}}</h2>
                    <p class="mb-0">Booked slot(last 7 days)</p>
                </div>
                <div class="card-content">
                    <div id="orders-received-chart"></div>
                </div>
            </div>
        </div>
        
    </div>
                    
                    
    <div class="row match-height">
        
        {{-- Booked Slot Chart--}}
        <div class="col-md-6 col-12">
                             <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Last 30 Days Booked Slot(Type Wise)</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="donut-chart" class="mx-auto"></div>
                                    </div>
                                </div>
                            </div>
        </div>

        
        <div class="col-md-6 col-12">
                                      <div class="card">
                                <div class="card-header d-flex justify-content-between pb-0">
                                    <h4 class="card-title">Booked Slot(Peak-Off Peak-Normal)</h4>
                                    <div class="dropdown chart-dropdown">
                                        <button class="btn btn-sm border-0 dropdown-toggle px-0" type="button" id="dropdownItem3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Last 30 Days
                                        </button>
                          
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body py-0">
                                        <div id="customer-chart"></div>
                                    </div>
                                    <ul class="list-group list-group-flush customer-info">
                                        <li class="list-group-item d-flex justify-content-between ">
                                            <div class="series-info">
                                                <i class="fa fa-circle font-small-3 text-primary"></i>
                                                <span class="text-bold-600">Peak</span>
                                            </div>
                                            <div class="product-result">
                                                <span>{{$peak_count}}</span>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between ">
                                            <div class="series-info">
                                                <i class="fa fa-circle font-small-3 text-warning"></i>
                                                <span class="text-bold-600">Off-Peak</span>
                                            </div>
                                            <div class="product-result">
                                                <span>{{$offpeak_count}}</span>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between ">
                                            <div class="series-info">
                                                <i class="fa fa-circle font-small-3 text-danger"></i>
                                                <span class="text-bold-600">Normal</span>
                                            </div>
                                            <div class="product-result">
                                                <span>{{$normal_count}}</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
        </div>
        
    </div>
                    
                    
                    
    <div class="row match-height">
        
        <div class="col-lg-5 col-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                    <h4>Booking Payment Status Chart</h4>
                    <div class="dropdown chart-dropdown">
                        <button class="btn btn-sm border-0 dropdown-toggle p-0" type="button" id="dropdownItem2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Last 30 Days
                        </button>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div id="product-order-chart" class="mb-3"></div>
                        <div class="chart-info d-flex justify-content-between mb-1">
                            <div class="series-info d-flex align-items-center">
                                <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                                <span class="text-bold-600 ml-50">Paid</span>
                            </div>
                            <div class="product-result">
                                <span>{{$paid_count}}</span>
                            </div>
                        </div>
                        <div class="chart-info d-flex justify-content-between mb-1">
                            <div class="series-info d-flex align-items-center">
                                <i class="fa fa-circle-o text-bold-700 text-warning"></i>
                                <span class="text-bold-600 ml-50">Partial</span>
                            </div>
                            <div class="product-result">
                                <span>{{$partial_count}}</span>
                            </div>
                        </div>
                        <div class="chart-info d-flex justify-content-between mb-75">
                            <div class="series-info d-flex align-items-center">
                                <i class="fa fa-circle-o text-bold-700 text-danger"></i>
                                <span class="text-bold-600 ml-50">Due</span>
                            </div>
                            <div class="product-result">
                                <span>{{$due_count}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-lg-7">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Income-Expense Chart(Last 6 months)</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="column-chart"></div>
                                    </div>
                                </div>
                            </div>
        </div>
{{--         <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Activity Timeline</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <ul class="activity-timeline timeline-left list-unstyled">
                            <li>
                                <div class="timeline-icon bg-primary">
                                    <i class="feather icon-plus font-medium-2 align-middle"></i>
                                </div>
                                <div class="timeline-info">
                                    <p class="font-weight-bold mb-0">Client Meeting</p>
                                    <span class="font-small-3">Bonbon macaroon jelly beans gummi bears jelly lollipop apple</span>
                                </div>
                                <small class="text-muted">25 mins ago</small>
                            </li>
                            <li>
                                <div class="timeline-icon bg-warning">
                                    <i class="feather icon-alert-circle font-medium-2 align-middle"></i>
                                </div>
                                <div class="timeline-info">
                                    <p class="font-weight-bold mb-0">Email Newsletter</p>
                                    <span class="font-small-3">Cupcake gummi bears soufflé caramels candy</span>
                                </div>
                                <small class="text-muted">15 days ago</small>
                            </li>
                            <li>
                                <div class="timeline-icon bg-danger">
                                    <i class="feather icon-check font-medium-2 align-middle"></i>
                                </div>
                                <div class="timeline-info">
                                    <p class="font-weight-bold mb-0">Plan Webinar</p>
                                    <span class="font-small-3">Candy ice cream cake. Halvah gummi bears</span>
                                </div>
                                <small class="text-muted">20 days ago</small>
                            </li>
                            <li>
                                <div class="timeline-icon bg-success">
                                    <i class="feather icon-check font-medium-2 align-middle"></i>
                                </div>
                                <div class="timeline-info">
                                    <p class="font-weight-bold mb-0">Launch Website</p>
                                    <span class="font-small-3">Candy ice cream cake. </span>
                                </div>
                                <small class="text-muted">25 days ago</small>
                            </li>
                            <li>
                                <div class="timeline-icon bg-primary">
                                    <i class="feather icon-check font-medium-2 align-middle"></i>
                                </div>
                                <div class="timeline-info">
                                    <p class="font-weight-bold mb-0">Marketing</p>
                                    <span class="font-small-3">Candy ice cream. Halvah bears Cupcake gummi bears.</span>
                                </div>
                                <small class="text-muted">28 days ago</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
        
    </div>
                    
                    
                    
    <!--<div class="row">-->
        
    <!--    <div class="col-12">-->
    <!--        <div class="card">-->
    <!--            <div class="card-header">-->
    <!--                <h4 class="mb-0">Dispatched Orders</h4>-->
    <!--            </div>-->
    <!--            <div class="card-content">-->
    <!--                <div class="table-responsive mt-1">-->
    <!--                    <table class="table table-hover-animation mb-0">-->
    <!--                        <thead>-->
    <!--                            <tr>-->
    <!--                                <th>ORDER</th>-->
    <!--                                <th>STATUS</th>-->
    <!--                                <th>OPERATORS</th>-->
    <!--                                <th>LOCATION</th>-->
    <!--                                <th>DISTANCE</th>-->
    <!--                                <th>START DATE</th>-->
    <!--                                <th>EST DEL. DT</th>-->
    <!--                            </tr>-->
    <!--                        </thead>-->
    <!--                        <tbody>-->
    <!--                            <tr>-->
    <!--                                <td>#879985</td>-->
    <!--                                <td><i class="fa fa-circle font-small-3 text-success mr-50"></i>Moving</td>-->
    <!--                                <td class="p-1">-->
    <!--                                    <ul class="list-unstyled users-list m-0  d-flex align-items-center">-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Vinnie Mostowy" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-5.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Elicia Rieske" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-7.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Julee Rossignol" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-10.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Darcey Nooner" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-8.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                    </ul>-->
    <!--                                </td>-->
    <!--                                <td>Anniston, Alabama</td>-->
    <!--                                <td>-->
    <!--                                    <span>130 km</span>-->
    <!--                                    <div class="progress progress-bar-success mt-1 mb-0">-->
    <!--                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>-->
    <!--                                    </div>-->
    <!--                                </td>-->
    <!--                                <td>14:58 26/07/2018</td>-->
    <!--                                <td>28/07/2018</td>-->
    <!--                            </tr>-->
    <!--                            <tr>-->
    <!--                                <td>#156897</td>-->
    <!--                                <td><i class="fa fa-circle font-small-3 text-warning mr-50"></i>Pending</td>-->
    <!--                                <td class="p-1">-->
    <!--                                    <ul class="list-unstyled users-list m-0  d-flex align-items-center">-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Trina Lynes" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-1.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Lilian Nenez" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-2.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Alberto Glotzbach" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-3.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                    </ul>-->
    <!--                                </td>-->
    <!--                                <td>Cordova, Alaska</td>-->
    <!--                                <td>-->
    <!--                                    <span>234 km</span>-->
    <!--                                    <div class="progress progress-bar-warning mt-1 mb-0">-->
    <!--                                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>-->
    <!--                                    </div>-->
    <!--                                </td>-->
    <!--                                <td>14:58 26/07/2018</td>-->
    <!--                                <td>28/07/2018</td>-->
    <!--                            </tr>-->
    <!--                            <tr>-->
    <!--                                <td>#568975</td>-->
    <!--                                <td><i class="fa fa-circle font-small-3 text-success mr-50"></i>Moving</td>-->
    <!--                                <td class="p-1">-->
    <!--                                    <ul class="list-unstyled users-list m-0  d-flex align-items-center">-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Lai Lewandowski" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-6.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Elicia Rieske" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-7.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Darcey Nooner" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-8.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Julee Rossignol" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-10.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Jeffrey Gerondale" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-9.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                    </ul>-->
    <!--                                </td>-->
    <!--                                <td>Florence, Alabama</td>-->
    <!--                                <td>-->
    <!--                                    <span>168 km</span>-->
    <!--                                    <div class="progress progress-bar-success mt-1 mb-0">-->
    <!--                                        <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>-->
    <!--                                    </div>-->
    <!--                                </td>-->
    <!--                                <td>14:58 26/07/2018</td>-->
    <!--                                <td>28/07/2018</td>-->
    <!--                            </tr>-->
    <!--                            <tr>-->
    <!--                                <td>#245689</td>-->
    <!--                                <td><i class="fa fa-circle font-small-3 text-danger mr-50"></i>Canceled</td>-->
    <!--                                <td class="p-1">-->
    <!--                                    <ul class="list-unstyled users-list m-0  d-flex align-items-center">-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Vinnie Mostowy" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-5.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Elicia Rieske" class="avatar pull-up">-->
    <!--                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-7.png" alt="Avatar" height="30" width="30">-->
    <!--                                        </li>-->
    <!--                                    </ul>-->
    <!--                                </td>-->
    <!--                                <td>Clifton, Arizona</td>-->
    <!--                                <td>-->
    <!--                                    <span>125 km</span>-->
    <!--                                    <div class="progress progress-bar-danger mt-1 mb-0">-->
    <!--                                        <div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>-->
    <!--                                    </div>-->
    <!--                                </td>-->
    <!--                                <td>14:58 26/07/2018</td>-->
    <!--                                <td>28/07/2018</td>-->
    <!--                            </tr>-->
    <!--                        </tbody>-->
    <!--                    </table>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
        
    <!--</div>-->
     {{-- dfsdf {{$dates}}          --}}
</section>

@stop
@section('script')
  <script src="{{asset('public/js/back/apexcharts.min.js')}}"></script>
  <script src="{{asset('public/js/back/dashboard-analytics.min.js')}}"></script>
  <script src="{{asset('public/js/back/dashboard-ecommerce.min.js')}}"></script>
  {{-- <script src="{{asset('public/js/back/shepherd.min.js')}}"></script> --}}
  <script src="{{asset('public/js/back/chart-apex.min.js')}}"></script>

<script>
    $(document).ready(function(){
       $('.db').addClass('active');
    });
    
</script>

<script>
        var e = "#7367F0",
            a = "#FF9F43",
            t = "#EA5455",
            r = "#e7eef7";
        
        s = {
         chart:
         {
             height: 100,
             type: "area",
             toolbar:
             {
                 show: !1
             },
             sparkline:
             {
                 enabled: !0
             },
             grid:
             {
                 show: !1,
                 padding:
                 {
                     left: 0,
                     right: 0
                 }
             }
         },
         colors: [e],
         dataLabels:
         {
             enabled: !1
         },
         stroke:
         {
             curve: "smooth",
             width: 2.5
         },
         fill:
         {
             type: "gradient",
             gradient:
             {
                 shadeIntensity: .9,
                 opacityFrom: .7,
                 opacityTo: .5,
                 stops: [0, 80, 100]
             }
         },
         series: [
         {
             name: "users",
             data: [{{$dcounts}}]
         }],
         xaxis:
         {
             labels:
             {
                 show: !1
             },
             axisBorder:
             {
                 show: !1
             }
         },
         yaxis: [
         {
             y: 0,
             offsetX: 0,
             offsetY: 0,
             padding:
             {
                 left: 0,
                 right: 0
             }
         }],
         tooltip:
         {
             x:
             {
                 show: !1
             }
         }
        };
            var i = {
        chart:
        {
            height: 100,
            type: "area",
            toolbar:
            {
                show: !1
            },
            sparkline:
            {
                enabled: !0
            },
            grid:
            {
                show: !1,
                padding:
                {
                    left: 0,
                    right: 0
                }
            }
        },
        colors: [a],
        dataLabels:
        {
            enabled: !1
        },
        stroke:
        {
            curve: "smooth",
            width: 2.5
        },
        fill:
        {
            type: "gradient",
            gradient:
            {
                shadeIntensity: .9,
                opacityFrom: .7,
                opacityTo: .5,
                stops: [0, 80, 100]
            }
        },
        series: [
        {
            name: "Booked",
            data: [{{$bookings}}]
        }],
        xaxis:
        {
            labels:
            {
                show: !1
            },
            axisBorder:
            {
                show: !1
            }
        },
        yaxis: [
        {
            y: 0,
            offsetX: 0,
            offsetY: 0,
            padding:
            {
                left: 0,
                right: 0
            }
        }],
        tooltip:
        {
            x:
            {
                show: !1
            }
        }
    };
        new ApexCharts(document.querySelector("#subscribe-gain-chart"), s).render();
        new ApexCharts(document.querySelector("#orders-received-chart"), i).render();

        var d = {
        chart:
        {
            height: 325,
            type: "radialBar"
        },
        colors: [e, a, t],
        fill:
        {
            type: "gradient",
            gradient:
            {
                shade: "dark",
                type: "vertical",
                shadeIntensity: .5,
                gradientToColors: ["#8F80F9", "#FFC085", "#f29292"],
                inverseColors: !1,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        stroke:
        {
            lineCap: "round"
        },
        plotOptions:
        {
            radialBar:
            {
                size: 165,
                hollow:
                {
                    size: "20%"
                },
                track:
                {
                    strokeWidth: "100%",
                    margin: 15
                },
                dataLabels:
                {
                    name:
                    {
                        fontSize: "18px"
                    },
                    value:
                    {
                        fontSize: "16px"
                    },
                    total:
                    {
                        show: !0,
                        label: "Total",
                        formatter: function (e)
                        {
                            return {{$total_count}}
                        }
                    }
                }
            }
        },
        series: [{{$paid_percent}}, {{$partial_percent}}, {{$due_percent}}],
        labels: ["Paid", "Partial", "Due"]
    };
    // series: [70, 52, 26],
    // labels: ["Finished", "Pending", "Rejected"]
    new ApexCharts(document.querySelector("#product-order-chart"), d).render();

</script>

<script>
            var e = "#7367F0",
            t = "#28C76F",
            a = "#EA5455",
            o = "#FF9F43",
            r = "#A9A2F6",
            s = "#f29292",
            i = "#ffc085",
            l = "#b9c3cd",
            n = "#e7e7e7",
            f = {
            chart:
            {
                type: "pie",
                height: 330,
                dropShadow:
                {
                    enabled: !1,
                    blur: 5,
                    left: 1,
                    top: 1,
                    opacity: .2
                },
                toolbar:
                {
                    show: !1
                }
            },
            labels: ["Peak", "Off-Peak", "Normal"],
            series: [{{$peak_count}},{{$offpeak_count}},{{$normal_count}}],
            dataLabels:
            {
                enabled: !1
            },
            legend:
            {
                show: !1
            },
            stroke:
            {
                width: 5
            },
            colors: [e, o, a],
            fill:
            {
                type: "gradient",
                gradient:
                {
                    gradientToColors: [r, i, s]
                }
            }
        };
        new ApexCharts(document.querySelector("#customer-chart"), f).render();

</script>
<script>
        var a = [e, "#28C76F", "#EA5455", "#FF9F43", "#00cfe8"],
         y = {
        chart:
        {
            type: "donut",
            height: 350
        },
        colors: a,
        labels:['Regular','Offer','Full','Drop'],
        series: [{{$reg_count}}, {{$offer_count}}, {{$full_count}}, {{$drop_count}}],
        legend:
        {
            itemMargin:
            {
                horizontal: 2
            }
        },
        responsive: [
        {
            breakpoint: 480,
            options:
            {
                chart:
                {
                    width: 350
                },
                legend:
                {
                    position: "bottom"
                }
            }
        }]
    };
    new ApexCharts(document.querySelector("#donut-chart"), y).render();
</script>
<script>
    var r = {
        chart:
        {
            height: 350,
            type: "bar"
        },
        colors: a,
        plotOptions:
        {
            bar:
            {
                horizontal: !1,
                endingShape: "rounded",
                columnWidth: "55%"
            }
        },
        dataLabels:
        {
            enabled: !1
        },
        stroke:
        {
            show: !0,
            width: 2,
            colors: ["transparent"]
        },
        series: [
        {
            name: "Net Total",
            data: [{{($profits)}}]
        },
        {
            name: "Income",
            data: [{{$mcounts}}]
        },
        {
            name: "Expense",
            data: [{{$ecounts}}]
        }],
        legend:
        {
            offsetY: -10
        },
        xaxis:
        {
            categories: [{!!$months!!}]
        },
        yaxis:
        {
            title:
            {
                text: "Income-Expense(TAKA)"
            }
        },
        fill:
        {
            opacity: 1
        },
        tooltip:
        {
            y:
            {
                formatter: function (e)
                {
                    return "BDT" + e + " taka"
                }
            }
        }
    };
    new ApexCharts(document.querySelector("#column-chart"), r).render();
</script>
@stop