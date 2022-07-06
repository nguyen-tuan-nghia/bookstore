<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/update_image/dist/image-uploader.min.css') }}">
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel='stylesheet'>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                @Has_role('xem báo cáo thống kê')
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Báo cáo thống kê</span></a>
                    @endHas_role
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapspost"
                    aria-expanded="true" aria-controls="collapspost">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Bài viết</span>
                </a>
                <div id="collapspost" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('/dashboard/post/create') }}">Thêm bài viết</a>
                        <a class="collapse-item" href="{{ url('/dashboard/post/index') }}">Liệt kê bài viết</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsdelivery"
                    aria-expanded="true" aria-controls="collapsdelivery">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Vận chuyển</span>
                </a>
                <div id="collapsdelivery" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @Has_role('thêm phí vận chuyển')
                        <a class="collapse-item" href="{{ url('/dashboard/delivery/create') }}">Thêm phí vận
                            chuyển</a>
                        @endHas_role
                        @Has_role('xem phí vận chuyển')
                        <a class="collapse-item" href="{{ url('/dashboard/delivery/index') }}">Liệt kê phí vận
                            chuyển</a>
                        @endHas_role
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsCategory"
                    aria-expanded="true" aria-controls="collapsCategory">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Danh mục sản phẩm</span>
                </a>
                <div id="collapsCategory" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @Has_role('thêm danh mục')
                        <a class="collapse-item" href="{{ url('/dashboard/category/create') }}">Thêm danh mục sản
                            phẩm</a>
                        @endHas_role
                        @Has_role('xem danh mục')
                        <a class="collapse-item" href="{{ url('/dashboard/category/index') }}">Liệt kê danh mục sản
                            phẩm</a>
                        @endHas_role
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Sản phẩm</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @Has_role('thêm sản phẩm')
                        <a class="collapse-item" href="{{ url('/dashboard/product/create') }}">Thêm sản phẩm</a>
                        @endHas_role
                        @Has_role('thêm sản phẩm')
                        <a class="collapse-item" href="{{ url('/dashboard/product/index') }}">Liệt kê sản phẩm</a>
                        @endHas_role

                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapscomment"
                    aria-expanded="true" aria-controls="collapscomment">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Bình luận</span>
                </a>
                <div id="collapscomment" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        {{-- <h6 class="collapse-header">:</h6> --}}
                        @Has_role('xem đơn hàng')
                        <a class="collapse-item" href="{{ url('/dashboard/comment/index') }}">Liệt kê bình luận</a>
                        @endHas_role
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsorder"
                    aria-expanded="true" aria-controls="collapsorder">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Đơn hàng</span>
                </a>
                <div id="collapsorder" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        {{-- <h6 class="collapse-header">:</h6> --}}
                        @Has_role('xem đơn hàng')
                        <a class="collapse-item" href="{{ url('/dashboard/order/index') }}">Liệt kê đơn hàng</a>
                        @endHas_role

                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapscustomer"
                    aria-expanded="true" aria-controls="collapscustomer">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Khách hàng</span>
                </a>
                <div id="collapscustomer" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @Has_role('xem nhân viên')
                        <a class="collapse-item" href="{{ url('/dashboard/customer/index') }}">Liệt kê khách
                            hàng</a>
                        @endHas_role

                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsadmin"
                    aria-expanded="true" aria-controls="collapsadmin">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Phân quyền người dùng</span>
                </a>
                <div id="collapsadmin" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @Has_role('phân quyền')
                        <a class="collapse-item" href="{{ url('/dashboard/permission/index') }}">Liệt kê quyền và
                            người dùng</a>
                        @endHas_role

                    </div>
                </div>
            </li>
            @Has_role('quản lý thông tin website')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsweb"
                    aria-expanded="true" aria-controls="collapsweb">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Quản lý website</span>
                </a>
                <div id="collapsweb" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('/dashboard/web/index') }}">Liệt kê thông tin
                            website</a>
                    </div>
                </div>
            </li>
            @endHas_role
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/intro') }}">
                    <span>Giới thiệu</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Divider -->

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">jj</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('admin/img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('/dashboard/setting') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Thông tin cá nhân
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/admin/logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ kết quả trong 1 trang",
                    "zeroRecords": "Dữ liệu không tồn tại",
                    "info": "Hiển thị trang _PAGE_ trên  _PAGES_",
                    "infoEmpty": "Bạn chưa nhập dữ liệu",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "sSearch": "Tìm kiếm:",
                    "oPaginate": {
                        "sFirst": "Đầu tiên",
                        "sLast": "Kết thúc",
                        "sNext": "Tiếp theo",
                        "sPrevious": "Quay lại"
                    },
                },
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{asset('admin/js/simple.money.format.js')}}"></script>
    <script type="text/javascript">
        $('.price_format').simpleMoneyFormat();
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
       $(document).on('keypress','.price_format',function (e) {
         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          $("#errmsg").html("Number Only").stop().show().fadeOut("slow");
          return false;
        }
       });
    });
    </script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'editor1', {
        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    } );
    </script>
</body>

</html>
