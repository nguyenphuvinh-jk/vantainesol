@extends('index')

@section('title')
    <title>NESOL | Thông tin xe</title>
@endsection

@section('header')
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/normalize.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/main.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/datepicker.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('public/fonts/flaticon.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/animate.min.css') }}">
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/select2.min.css') }}">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/jquery.dataTables.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <!-- Modernize js -->
    <script src="{{ asset('public/js/modernizr-3.6.0.min.js') }}"></script>
@endsection

@section('contents')
    <div class="row">
        <div class="col-12-xxxl col-md-12 col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1 d-flex justify-content-sm-center pb-5">
                        <div class="item-title text-center">
                            <h3>Lịch sử sửa chữa/bảo dưỡng</h3>
                            @foreach ($xe as $key => $xe)
                                <p class="text-center">Xe: {{ $xe->biensoxe }} / Loại: {{ $xe->ten_loaixe }} / Hãng:
                                    {{ $xe->ten_hangxe }}</p>
                            @endforeach
                        </div>
                    </div>
                    <form class="mg-b-20">
                        <div class="row gutters-8 d-flex justify-content-end">
                            <div class="col-lg-2 col-12 form-group">
                                <a href="#" class="fw-btn-fill btn-gradient-yellow text-center text-white"
                                    id="btn_suachua">Tải xuống</a>
                            </div>
                            <div class="col-lg-4 col-12 form-group">
                            </div>
                            <div class="col-lg-6 col-12 form-group">
                                <input type="text" placeholder="Tìm kiếm ...." class="form-control" id="suachua_search">
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap" id="suachua_table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>ID sửa chữa</th>
                                    <th>Ngày sửa</th>
                                    <th>Nơi sửa</th>
                                    <th>Nội dung sửa</th>
                                    <th>Tổng tiền</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($suachua as $key => $sua)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $sua->suachua_id }}</td>
                                        <td>{{ \Carbon\Carbon::parse($sua->ngaysua)->format('d/m/Y') }}</td>
                                        <td>{{ $sua->noisua }}</td>
                                        <td>{!! nl2br($sua->noidung) !!}</td>
                                        <td>{{ $sua->tongtien }}</td>
                                        <td>{{ $sua->ghichu }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <!-- jquery-->
    <script src="{{ asset('public/js/jquery-3.3.1.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('public/js/plugins.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('public/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <!-- Select 2 Js -->
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <!-- Scroll Up Js -->
    <script src="{{ asset('public/js/jquery.scrollUp.min.js') }}"></script>
    <!-- Data Table Js -->
    <script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
    <!-- Date Picker Js -->
    <script src="{{ asset('public/js/datepicker.min.js') }}"></script>

    <script src="{{ asset('public/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/js/jszip.min.js') }}"></script>
    <script src="{{ asset('public/js/buttons.html5.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('public/js/main.js') }}"></script>

    <script>
        if ($.fn.DataTable !== undefined) {
            oTable = $('#suachua_table').DataTable({
                destroy: true,
                paging: true,
                searching: true,
                info: false,
                lengthChange: false,
                lengthMenu: [20, 50, 75, 100],
                oLanguage: {
                    "sEmptyTable": "Không có dữ liệu"
                },
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    title: 'Danh sách sửa chữa',
                    className: "buttonsToHide",
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                }]
            });

            oTable.buttons('.buttonsToHide').nodes().addClass('hidden');

            $("#btn_suachua").on("click", function() {
                oTable.button('.buttons-excel').trigger();
            });

            $('#suachua_search').keyup(function() {
                oTable.search($(this).val()).draw();
            })
        }
    </script>
@endsection
