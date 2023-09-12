@extends('Admin.layout.main')
@section('title')
Thống kê - Báo Cáo
@endsection
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Doanh thu tháng</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($monthRevenue, 0, '.', ',')}} đ</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Doanh thu tuần</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($weekRevenue, 0, '.', ',')}} đ</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Số phim
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$movieCount}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Vé đã bán</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ticketCount}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Biểu đồ doanh thu</h6>
                <!-- doanh thu theo từng năm -->
                <span>Thống kê theo năm:</span>

                <select class="form-control form-control-sm col-2" name="" id="changeYear">
                    @foreach($yearList as $value)
                    <option value="{{$value->year}}">{{$value->year}}</option>
                    @endforeach
                </select>
                <!-- doanh thu theo từng tháng -->
                <span>Thống kê theo tháng:</span>

                <select class="form-control form-control-sm col-2" name="" id="changeMonth">
                    <option value="">--Chọn--</option>
                    <option value="january">Tháng 1</option>
                    <option value="february">Tháng 2</option>
                    <option value="march">Tháng 3</option>
                    <option value="april">Tháng 4</option>
                    <option value="may">Tháng 5</option>
                    <option value="june">Tháng 6</option>
                    <option value="july">Tháng 7</option>
                    <option value="august">Tháng 8</option>
                    <option value="september">Tháng 9</option>
                    <option value="october">Tháng 10</option>
                    <option value="november">Tháng 11</option>
                    <option value="december">Tháng 12</option>
                </select>



                <!-- kết thúc doanh thu theo từng tháng -->
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>



<script type="text/javascript">
    $(document).ready(function() {
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                datasets: [{
                    label: "Doanh thu",
                    lineTension: 0.3,
                    backgroundColor: "rgba(246,194,62, 0.05)",
                    borderColor: "rgba(246,194,62,1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(246,194,62,1)",
                    pointBorderColor: "rgba(246,194,62,1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(246,194,62,1)",
                    pointHoverBorderColor: "rgba(246,194,62,1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: @json($monthEarn)
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 31
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            minTicksLimit: 1,
                            min: 0,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return number_format(value) + 'đ';
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ':' + number_format(tooltipItem.yLabel) + 'đ';
                        }
                    }
                }
            }
        });

        // xử lý thống kê theo năm
        $('#changeYear').change(function() {
            var year = $(this).val();
            $('#changeMonth').val("");
            // Bắt đầu gửi AJAX
            $.ajax({
                url: "{{route('admin.dashboard_earning')}}", // đường dẫn đến controller
                method: 'GET', // phương thức POST
                data: { // dữ liệu gửi đi
                    year: year, // giá trị value Year
                },
                success: function(data) { // nhận kết quả trả về
                    myLineChart.data.datasets[0].data = data;
                    myLineChart.data.labels = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
                    myLineChart.update();
                }
            }); // đấu đóng ajax
        });

        // xử lý thống kê theo tháng trong năm
        $('#changeMonth').change(function() {
            var month = $(this).val();
            var year = $('#changeYear').val();
            // Bắt đầu gửi AJAX
            $.ajax({
                url: "{{route('admin.dashboard_earning')}}", // đường dẫn đến controller
                method: 'GET', // phương thức GET
                data: { // dữ liệu gửi đi
                    month: month, // giá trị value month
                    year: year, // giá trị value Year
                },
                success: function(data) { // nhận kết quả trả về
                    console.log(data);
                    if (data.listday) {
                        myLineChart.data.datasets[0].data = data.dayEarn;
                        myLineChart.data.labels = data.listday;
                    } else { // nếu không chọn month thì dữ liệu sẽ trả về doanh thu năm
                        myLineChart.data.datasets[0].data = data;
                        myLineChart.data.labels = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
                    }

                    myLineChart.update();
                }
            }); // đấu đóng ajax

        });
    }); // dấu đóng hàm ready
</script>
@endsection