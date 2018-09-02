@extends('layouts.app')
@section('content')
<div class="container-fluid mimin-wrapper">
    @include('admin.includes.left_menu')
    <!-- start: content -->
    <div id="content">
        <div class="panel">
            <div class="panel-body">
            </div>                    
        </div>
        <div class="col-md-12" style="padding:20px;">
            <div class="col-md-12 padding-0">
                <div class="col-md-12 padding-0">
                    <div class="col-md-12 padding-0">
                        <div class="col-md-4">
                            <div class="panel box-v1">
                                <div class="panel-heading bg-white border-none">
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                        <h4 class="text-left">Users</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                        <h4>
                                            <span class="icon-user icons icon text-right"></span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="panel-body text-center">
                                    <h1>{{ number_format($totalUser) }}</h1>
                                    <p>User active</p>
                                    <hr/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel box-v1">
                                <div class="panel-heading bg-white border-none">
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                        <h4 class="text-left">Orders</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                        <h4>
                                            <span class="icon-basket-loaded icons icon text-right"></span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="panel-body text-center">
                                    <h1>{{ number_format($totalOrder) }}</h1>
                                    <p>New Orders</p>
                                    <hr/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel box-v1">
                                <div class="panel-heading bg-white border-none">
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                        <h4 class="text-left">Products</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                        <h4>
                                            <span class="icon-basket-loaded icons icon text-right"></span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="panel-body text-center">
                                    <h1>{{ number_format($totalProductNearOutOfStock) }}</h1>
                                    <p>Near Out Of Stock</p>
                                    <hr/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-12">
                        <div class="panel box-v4">
                            <div class="panel-heading bg-white border-none">
                                <h4><span class="icon-notebook icons"></span> Agenda</h4>
                            </div>
                            <div class="panel-body padding-0">
                                <div class="col-md-12 col-xs-12 col-md-12 padding-0 box-v4-alert">
                                    <h2>Checking Your Server!</h2>
                                    <p>Daily Check on Server status, mostly looking at servers with alerts/warnings</p>
                                    <b><span class="icon-clock icons"></span> Today at 15:00</b>
                                </div>
                                <div class="calendar">

                                </div>
                            </div>
                        </div> 
                    </div> -->
                </div>
                <!-- <div class="col-md-4">
                    <div class="col-md-12 padding-0">
                        <div class="panel box-v2">
                            <div class="panel-heading padding-0">
                                <img src="{!! asset('assets/img/bg2.jpg') !!}" class="box-v2-cover img-responsive"/>
                                <div class="box-v2-detail">
                                    <img src="{!! asset('assets/img/avatar.jpg') !!}" class="img-responsive"/>
                                    <h4>Akihiko Avaron</h4>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12 padding-0 text-center">
                                    <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                        <h3>2.000</h3>
                                        <p>Post</p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                        <h3>2.232</h3>
                                        <p>share</p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                        <h3>4.320</h3>
                                        <p>photos</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 padding-0">
                        <div class="panel box-v3">
                            <div class="panel-heading bg-white border-none">
                                <h4>Report</h4>
                            </div>
                            <div class="panel-body">

                                <div class="media">
                                    <div class="media-left">
                                        <span class="icon-folder icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading">Document Handling</h5>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="media">
                                    <div class="media-left">
                                        <span class="icon-pie-chart icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading">UI/UX Development</h5>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="19" aria-valuemin="0" aria-valuemax="100" style="width: 19%;">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="media">
                                    <div class="media-left">
                                        <span class="icon-energy icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading">Server Optimation</h5>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%;">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="media">
                                    <div class="media-left">
                                        <span class="icon-user icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading">User Status</h5>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%;">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="media">
                                    <div class="media-left">
                                        <span class="icon-fire icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading">Firewall Status</h5>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer bg-white border-none">
                                <center>
                                    <input type="button" value="download as pdf" class="btn btn-danger box-shadow-none"/>
                                </center>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 padding-0">
                        <div class="panel bg-light-blue">
                            <div class="panel-body text-white">
                                <p class="animated fadeInUp quote">Lorem ipsum dolor sit amet, consectetuer adipiscing elit Ut wisi..."</p>
                                <div class="col-md-12 padding-0">
                                    <div class="text-left col-md-7 col-xs-12 col-sm-7 padding-0">
                                        <span class="fa fa-twitter fa-2x"></span>
                                        <span>22 May, 2015 via mobile</span>
                                    </div>
                                    <div style="padding-top:8px;" class="text-right col-md-5 col-xs-12 col-sm-5 padding-0">
                                        <span class="fa fa-retweet"></span> 2000
                                        <span class="fa fa-star"></span> 3000
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="col-md-12 card-wrap padding-0">
                <!-- <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading bg-white border-none" style="padding:20px;">
                            <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                                <h4>Line Chart</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-sm-12">
                                <div class="mini-onoffswitch pull-right onoffswitch-danger" style="margin-top:10px;">
                                    <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch1" checked>
                                    <label class="onoffswitch-label" for="myonoffswitch1"></label>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-bottom:50px;">
                            <div id="canvas-holder1">
                                <canvas class="line-chart" style="margin-top:30px;height:200px;"></canvas>
                            </div>
                            <div class="col-md-12" style="padding-top:20px;">
                                <div class="col-md-4 col-sm-4 col-xs-6 text-center">
                                    <h2 style="line-height:.4;">$100.21</h2>
                                    <small>Total Laba</small>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 text-center">
                                    <h2 style="line-height:.4;">2000</h2>
                                    <small>Total Barang</small>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                                    <h2 style="line-height:.4;">$291.1</h2>
                                    <small>Total Pengeluaran</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading bg-white border-none" style="padding:20px;">
                            <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                                <h4>Orders</h4>
                                <p>Total money: <b>{{ number_format($totalMoney) }}đ</b></p>
                                <p>Total money of {{ date('M') }}: <b>{{ number_format($totalMoneyCurrentMonth) }}đ</b></p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-sm-12">
                                <div class="mini-onoffswitch pull-right onoffswitch-primary" style="margin-top:10px;">
                                    <input type="checkbox" name="onoffswitch3" class="onoffswitch-checkbox" id="myonoffswitch3" checked>
                                    <label class="onoffswitch-label" for="myonoffswitch3"></label>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-bottom:50px;">
                            <div id="canvas-holder1">
                                <canvas class="bar-chart"></canvas>
                            </div>
                            <div class="col-md-12 padding-0" >
                                <!-- <div class="col-md-4 col-sm-4 hidden-xs" style="padding-top:20px;">
                                    <canvas class="doughnut-chart2"></canvas>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <h4>Progress Produksi barang</h4>
                                    <p>Sed hendrerit. Curabitur blandit mollis lacus. Duis leo. Sed libero.fusce commodo aliquam arcu..</p>
                                    <div class="progress progress-mini">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                                            <span class="sr-only">60% Complete</span>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel bg-green text-white">
                    <div class="panel-body">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="maps" style="height:300px;">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <canvas class="doughnut-chart hidden-xs"></canvas>
                            <div class="col-md-12">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <h1>72.993</h1>
                                    <p>People</p>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <h1>12.000</h1>
                                    <p>Active</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
      (function(jQuery){

        // start: Chart =============

        Chart.defaults.global.pointHitDetectionRadius = 1;
        Chart.defaults.global.customTooltips = function(tooltip) {

            var tooltipEl = $('#chartjs-tooltip');

            if (!tooltip) {
                tooltipEl.css({
                    opacity: 0
                });
                return;
            }

            tooltipEl.removeClass('above below');
            tooltipEl.addClass(tooltip.yAlign);

            var innerHtml = '';
            if (undefined !== tooltip.labels && tooltip.labels.length) {
                for (var i = tooltip.labels.length - 1; i >= 0; i--) {
                    innerHtml += [
                    '<div class="chartjs-tooltip-section">',
                    '   <span class="chartjs-tooltip-key" style="background-color:' + tooltip.legendColors[i].fill + '"></span>',
                    '   <span class="chartjs-tooltip-value">' + tooltip.labels[i] + '</span>',
                    '</div>'
                    ].join('');
                }
                tooltipEl.html(innerHtml);
            }

            tooltipEl.css({
                opacity: 1,
                left: tooltip.chart.canvas.offsetLeft + tooltip.x + 'px',
                top: tooltip.chart.canvas.offsetTop + tooltip.y + 'px',
                fontFamily: tooltip.fontFamily,
                fontSize: tooltip.fontSize,
                fontStyle: tooltip.fontStyle
            });
        };
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };
        var lineChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "My First dataset",
                fillColor: "rgba(21,186,103,0.4)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(66,69,67,0.3)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [18,9,5,7,4.5,4,5,4.5,6,5.6,7.5]
            }, {
                label: "My Second dataset",
                fillColor: "rgba(21,113,186,0.5)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [4,7,5,7,4.5,4,5,4.5,6,5.6,7.5]
            }]
        };

        var doughnutData = [
        {
            value: 300,
            color:"#129352",
            highlight: "#15BA67",
            label: "Alfa"
        },
        {
            value: 50,
            color: "#1AD576",
            highlight: "#15BA67",
            label: "Beta"
        },
        {
            value: 100,
            color: "#FDB45C",
            highlight: "#15BA67",
            label: "Gamma"
        },
        {
            value: 40,
            color: "#0F5E36",
            highlight: "#15BA67",
            label: "Peta"
        },
        {
            value: 120,
            color: "#15A65D",
            highlight: "#15BA67",
            label: "X"
        }

        ];


        var doughnutData2 = [
        {
            value: 100,
            color:"#129352",
            highlight: "#15BA67",
            label: "Alfa"
        },
        {
            value: 250,
            color: "#FF6656",
            highlight: "#FF6656",
            label: "Beta"
        },
        {
            value: 100,
            color: "#FDB45C",
            highlight: "#15BA67",
            label: "Gamma"
        },
        {
            value: 40,
            color: "#FD786A",
            highlight: "#15BA67",
            label: "Peta"
        },
        {
            value: 120,
            color: "#15A65D",
            highlight: "#15BA67",
            label: "X"
        }

        ];

        var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [
            {
                label: "Orders",
                fillColor: "rgba(21,186,103,0.4)",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(21,186,103,0.2)",
                highlightStroke: "rgba(21,186,103,0.2)",
                data: [
                {{ $totalOrder1 }}, 
                {{ $totalOrder2 }}, 
                {{ $totalOrder3 }}, 
                {{ $totalOrder4 }}, 
                {{ $totalOrder5 }}, 
                {{ $totalOrder6 }}, 
                {{ $totalOrder7 }}, 
                {{ $totalOrder8 }}, 
                {{ $totalOrder9 }}, 
                {{ $totalOrder10 }}, 
                {{ $totalOrder11 }}, 
                {{ $totalOrder12 }}
                ]
            }
            ]
        };

        window.onload = function(){
            var ctx = $(".doughnut-chart")[0].getContext("2d");
            window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {
                responsive : true,
                showTooltips: true
            });

            var ctx3 = $(".bar-chart")[0].getContext("2d");
            window.myLine = new Chart(ctx3).Bar(barChartData, {
               responsive: true,
               showTooltips: true
           });

            // var ctx2 = $(".line-chart")[0].getContext("2d");
            // window.myLine = new Chart(ctx2).Line(lineChartData, {
            //  responsive: true,
            //  showTooltips: true,
            //  multiTooltipTemplate: "<%= value %>",
            //  maintainAspectRatio: false
         // });

            // var ctx4 = $(".doughnut-chart2")[0].getContext("2d");
            // window.myDoughnut2 = new Chart(ctx4).Doughnut(doughnutData2, {
            //     responsive : true,
            //     showTooltips: true
            // });

        };
        
        //  end:  Chart =============

        // start: Calendar =========
        $('.dashboard .calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: '2015-02-12',
            businessHours: true, // display business hours
            editable: true,
            events: [
            {
                title: 'Business Lunch',
                start: '2015-02-03T13:00:00',
                constraint: 'businessHours'
            },
            {
                title: 'Meeting',
                start: '2015-02-13T11:00:00',
                    constraint: 'availableForMeeting', // defined below
                    color: '#20C572'
                },
                {
                    title: 'Conference',
                    start: '2015-02-18',
                    end: '2015-02-20'
                },
                {
                    title: 'Party',
                    start: '2015-02-29T20:00:00'
                },

                // areas where "Meeting" must be dropped
                {
                    id: 'availableForMeeting',
                    start: '2015-02-11T10:00:00',
                    end: '2015-02-11T16:00:00',
                    rendering: 'background'
                },
                {
                    id: 'availableForMeeting',
                    start: '2015-02-13T10:00:00',
                    end: '2015-02-13T16:00:00',
                    rendering: 'background'
                },

                // red areas where no events can be dropped
                {
                    start: '2015-02-24',
                    end: '2015-02-28',
                    overlap: false,
                    rendering: 'background',
                    color: '#FF6656'
                },
                {
                    start: '2015-02-06',
                    end: '2015-02-08',
                    overlap: true,
                    rendering: 'background',
                    color: '#FF6656'
                }
                ]
            });
        // end : Calendar==========

        // start: Maps============

        jQuery('.maps').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#fff',
            hoverOpacity: 0.7,
            selectedColor: '#666666',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#C8EEFF', '#006491'],
            normalizeFunction: 'polynomial'
        });

        // end: Maps==============

    })(jQuery);
</script>
<!-- end: Javascript -->
<!-- end: content -->
@include('admin.includes.right_menu')
</div>
@endsection
