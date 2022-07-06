@Has_role('xem báo cáo thống kê')
@extends('layout.admin')
@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="row" style="margin-left:1%">
        <p>Từ ngày: <input class="form-control" autocomplete="off" type="text" id="datepicker"></p>
        <p>đến ngày: <input class="form-control" autocomplete="off" onchange="find_date()" type="text" id="datepicker2">
        </p>
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Doanh thu</div>
                            <div id="doanhthu" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Sản phẩm bán ra</div>
                            <div id="soluong" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
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
                                Pending Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Content Row -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Thống kê</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="chartDiv">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div>
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Doanh thu</th>
                                    <th>Sản phẩm bán</th>
                                    <th>Ngày</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Doanh thu</th>
                                    <th>Sản phẩm bán</th>
                                    <th>Ngày</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Top 10 sản phẩm bán chạy</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div>
                        <canvas id="doughnut"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $("#datepicker").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration: "slow"
        });
        $("#datepicker2").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration: "slow"
        });
    </script>
    <script>
        function find_date() {
            $('#myChart').remove();
            $('#chartDiv').append('<canvas id="myChart"></canvas>');
            var date = $("#datepicker").val();
            var date2 = $("#datepicker2").val();
            let Date = new Array();
            let doanhthu = new Array();
            let sumdoanhthu = 0;
            let soluong = new Array();
            let sumsoluong = 0;
            $('#myTable').DataTable().clear().destroy();
            $.ajax({
                url: "{{ url('/find-date') }}",
                method: "POST",
                data: {
                    date: date,
                    date2: date2
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    console.log(res.data);
                    res.data.forEach(element => {
                        sumdoanhthu += parseInt(element.doanhthu);
                        sumsoluong += parseInt(element.soluong);
                        Date.push(element.date);
                        doanhthu.push(element.doanhthu);
                        soluong.push(element.soluong);
                    });
                    console.log(sumdoanhthu);
                    console.log(sumsoluong);
                    $("#doanhthu").html(formatNumber(sumdoanhthu) + " VNĐ");
                    $("#soluong").html(sumsoluong);
                    const labels = Date;
                    const data = {
                        labels: labels,
                        datasets: [{
                            label: 'Doanh thu',
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: doanhthu,
                        }, {
                            label: 'Sản phẩm',
                            backgroundColor: 'rgb(255, 99, 32)',
                            borderColor: 'rgb(255, 99, 32)',
                            data: soluong,
                        }]
                    };
                    const config = {
                        type: 'bar',
                        data: data,
                        options: {}
                    };
                    const myChart = new Chart(
                        document.getElementById('myChart'),
                        config
                    );
                    var count=0;
                    var t = $('#myTable').DataTable();
                    res.data.forEach(element => {
                    t.row.add([
                        count++,
                        formatNumber(element.doanhthu) + " VNĐ",
                        element.soluong,
                        element.date
                    ]).draw(false);
                });
                },
            });
        }
    </script>
    <script>
        filldata();

        function filldata() {
            let date = new Array();
            let doanhthu = new Array();
            let sumdoanhthu = 0;
            let soluong = new Array();
            let sumsoluong = 0;
            $.ajax({
                url: "{{ url('/filldata') }}",
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    console.log(res.data);
                    res.data.forEach(element => {
                        sumdoanhthu += parseInt(element.doanhthu);
                        sumsoluong += parseInt(element.soluong);
                        date.push(element.date);
                        doanhthu.push(element.doanhthu);
                        soluong.push(element.soluong);
                    });
                    console.log(sumdoanhthu);
                    console.log(sumsoluong);
                    $("#doanhthu").html(formatNumber(sumdoanhthu) + " VNĐ");
                    $("#soluong").html(sumsoluong);
                    const labels = date;
                    const data = {
                        labels: labels,
                        datasets: [{
                            label: 'Doanh thu',
                            backgroundColor: 'rgb(45, 191, 226)',
                            borderColor: 'rgb(45, 191, 226)',
                            data: doanhthu,
                        }, {
                            label: 'Sản phẩm',
                            backgroundColor: 'rgb(255, 99, 32)',
                            borderColor: 'rgb(255, 99, 32)',
                            data: soluong,
                        }]
                    };
                    const config = {
                        type: 'bar',
                        data: data,
                        options: {}
                    };
                    const myChart = new Chart(
                        document.getElementById('myChart'),
                        config
                    );
                    var count=0;
                    var t = $('#myTable').DataTable();
                    res.data.forEach(element => {
                    t.row.add([
                        count++,
                        formatNumber(element.doanhthu) + " VNĐ",
                        element.soluong,
                        element.date
                    ]).draw(false);
                });
                },
            });
        }

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
    </script>
    <script>
        doughnut();

        function doughnut() {
            let name = new Array();
            let sell = new Array();
            $.ajax({
                url: "{{ url('/doughnut') }}",
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    res.data.forEach(element => {
                        name.push(element.name);
                        sell.push(element.sell);
                    });
                    const data = {
                        labels: name,
                        datasets: [{
                            label: 'My First Dataset',
                            data: sell,
                            backgroundColor: [
                                'rgb(55, 969, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(255, 25, 86)',
                                'rgb(255, 20, 226)',
                                'rgb(55, 205, 86)',
                                'rgb(2365, 205, 86)',
                                'rgb(25, 605, 86)',
                                'rgb(255, 505, 86)',
                                'rgb(25, 205, 8)',
                                'rgb(255, 115, 86)',

                            ],
                            hoverOffset: 4
                        }]
                    };
                    const config = {
                        type: 'doughnut',
                        data: data,
                    };
                    const myChart = new Chart(
                        document.getElementById('doughnut'),
                        config
                    );
                },
            });
        }
    </script>
@endsection
@endHas_role
