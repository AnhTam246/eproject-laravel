@extends('main._layouts.master')

<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
?>

@section('css')
    <link href="{{ asset('assets/css/components_datatables.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        #tb_dkp_wrapper {
            display: none;
        }

        .wrap-select {
            width: 302px;
            overflow: hidden;
        }

        .wrap-select select {
            width: 320px;
            margin: 0;
            background-color: #212121;
        }
    </style>


@endsection

@section('js')
    <script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/notifications/jgrowl.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_pages/picker_date.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('assets/js/datatable_init.js') }}"></script>
    <script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{asset('global_assets/js/demo_pages/form_layouts.js')}}"></script>
@endsection



@section('content')
    <!-- Basic datatable -->
    <!-- 2 columns form -->
    <div class="card">
        <h1 class="pt-3 pl-3 pr-3">Th??m Nh??n Vi??n M???i</h1>
        <div class="card-header header-elements-inline">

        </div>
        <div class="card-body">
            <form action="{{ route('postAddStaff') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(session('message'))
                    <div class="alert alert-{{ session('message')['type'] }} border-0 alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        {{ session('message')['message'] }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger border-0 alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        <p><b>D??? li???u ?????u v??o kh??ng ch??nh x??c:</b></p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#staff" role="tab" aria-controls="staff" aria-selected="true">Nh??n vi??n</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="allowance-tab" data-toggle="tab" href="#allowance" role="tab" aria-controls="allowance" aria-selected="false">B???ng c???p</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="staff" role="tabpanel" aria-labelledby="staff-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Th??ng tin</legend>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>M?? Nh??n vi??n:(*)</label>
                                                        <input type="text" class="form-control" name="txtCode" value="{{ old('txtCode') }}" require placeholder="Nh???p M?? Nh??n vi??n: TTN">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Ph??n Quy???n:(*)</label>
                                                        <!-- <input type="text" class="form-control" name="txtGender"> -->
                                                        <select class="form-control" name="txtisManager" color="red">
                                                            <option value="0" selected>Nh??n vi??n</option>
                                                            <option value="1">Qu???n l??</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>H??? nh??n vi??n:</label>
                                                        <input type="text" class="form-control" name="txtLname" value="{{ old('txtLname') }}" placeholder="Nh???p H???">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>T??n Nh??n vi??n:(*)</label>
                                                        <input type="text" class="form-control" name="txtFname" value="{{ old('txtFname') }}" require placeholder="Nh???p T??n">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Ph??ng Ban:(*)</label>
                                                        <select class="form-control" name="txtDepartment" value="{{ old('txtDepartment') }}">
                                                            @foreach($data_department as $dep)
                                                                <option value="{{ $dep['id'] }}">{{ $dep['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Ng??y sinh:</label>
                                                        <input type="text" class="form-control daterange-single" name="txtDob" value="{{ old('txtDob') }}">
                                                        {{--                                                            <input type="Date" class="form-control" name="txtDob" value="{{ old('txtDob') }}">--}}
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Ng??y V??o:(*)</label>
                                                        <input type="text" class="form-control daterange-single" name="txtJoinat" value="{{ old('txtJoinat') }}">
                                                        {{--                                                            <input type="Date" class="form-control" name="txtJoinat" value="{{ old('txtJoinat') }}">--}}
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gi???i t??nh:(*)</label>
                                                        <select class="form-control" name="txtGender" color="red">
                                                            <option value="1" selected>Nam</option>
                                                            <option value="0">N???</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Khu v???c:(*)</label>
                                                        <!-- <input type="text" class="form-control" name="txtGender"> -->
                                                        <select id="province" class="form-control form-control-select2" color="red" data-fouc>
                                                            @foreach($data_reg as $reg)
                                                                <option value="{{$reg['id']}}">{{ $reg['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Th??nh Ph???/Huy???n/X??:(*)</label>
                                                        <select id="district" class="form-control form-control-select2" name="txtRegional" color="red" data-fouc>
                                                            @foreach($data_district as $district)
                                                                <option value="{{$district['id']}}">{{ $district['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>??i???n tho???i:</label>
                                                        <input type="number" class="form-control" name="txtPhone" value="{{ old('txtPhone') }}" placeholder="Nh???p s??? ??i???n tho???i">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email:(*)</label>
                                                        <input type="text" class="form-control" name="txtEmail" value="{{ old('txtEmail') }}" placeholder="Nh???p Email abc12@exam.com">
                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>
                                    </div>

                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend class="font-weight-semibold"><i class="icon-paperplane mr-2"></i> H??nh ???nh</legend>

                                            <div class="form-group" hidden>
                                                <label>M???t Kh???u:(*)</label>
                                                <input type="password" class="form-control" name="txtPass"  value="<?php echo md5(123456);?>" require>
                                            </div>

                                            <div class="form-group">
                                                <label>CMND:(*)</label>
                                                <input type="text" class="form-control" name="txtIDNumber" placeholder="Nh???p s??? CMND" value="{{ old('txtIDNumber') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Ng??y c???p:(*)</label>
                                                <input type="text" class="form-control daterange-single" name="txtIssue" value="{{ old('txtIssue') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>H??nh ???nh:</label>
                                                <input type="file" class="form-input-styled" name="txtPhoto">
                                            </div>

                                            <div class="form-group">
                                                <label>M???t tr?????c CMND:</label>
                                                <input type="file" class="form-input-styled" name="txtIDPhoto">
                                            </div>

                                            <div class="form-group">
                                                <label>M???t sau CMND:</label>
                                                <input type="file" class="form-input-styled" name="txtIDPhoto2">
                                            </div>

                                            <div class="form-group">
                                                <label>Ghi ch??:</label>
                                                <textarea rows="5" cols="5" class="form-control" name="txtNote" value="{{ old('txtNote') }}" placeholder="Nh???p Ghi ch??"></textarea>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            {{-- TAB 2 --}}
                            <div class="tab-pane fade" id="allowance" role="tabpanel" aria-labelledby="allowance-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success" onclick="addOption()"><i title="Th??m chi ti???t" class="icon-stack-plus "></i> Th??m b???ng c???p</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Th??ng tin</legend>
                                        <div id="education">
                                            <div class="row">
                                                <div class="col-md-2"hidden>
                                                    <div class="form-group" >
                                                        <label>C???p B???c:</label>
                                                        <input type="text" class="form-control" name="education[0][level]" value="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>T??n C???p B???c:</label>
                                                        <select id="txtLevelName" class="form-control" name="education[0][levelName]">
                                                            <option value="Ti???u h???c">Ti???u h???c</option>
                                                            <option value="Trung h???c c?? s???">Trung h???c c?? s???</option>
                                                            <option value="Trung h???c ph??? th??ng">THPT</option>
                                                            <option value="?????i h???c">?????i h???c</option>
                                                            <option value="Th???c s??">Th???c s??</option>
                                                            <option value="Ti???n s??">Ti???n s??</option>
                                                            <option value="Ph?? gi??o s??">Ph?? Gi??o s??</option>
                                                            <option value="Gi??o s??">Gi??o s??</option>
                                                            <option value="Kh??c">Kh??c</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>T??n Tr?????ng: (*)</label>
                                                        <input type="text" class="form-control text-uppercase" id="txtSchool" name="education[0][school]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Chuy??n ng??nh: (*)</label>
                                                        <input type="text" class="form-control" name="education[0][fieldOfStudy]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>N??m t???t nghi???p:(*)</label>
                                                        <input type="text" class="form-control" name="education[0][graduatedYear]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>X???p lo???i:</label>
                                                        <input type="text" class="form-control" name="education[0][grade]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>H??nh th???c h???c:</label>
                                                        <input type="text" class="form-control" name="education[0][modeOfStudy]" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success" type="submit">T???o m???i <i class="icon-paperplane ml-2"></i></button>
                        <button type="reset" class="btn btn-primary">Nh???p l???i <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- /2 columns form -->
    <!-- /basic datatable -->
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/picker_date_init.js') }}"></script>
    <script>
        let optionIndex = 0;

        function addOption() {
            optionIndex++;
            $('#education').append(`
                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>C???p B???c:</label>
                                <input type="text" class="form-control" name="education[${optionIndex}][level]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>T??n C???p B???c:</label>
                                <select id="txtLevelName" class="form-control" name="education[${optionIndex}][levelName]">
                                    <option value="Ti???u h???c">Ti???u h???c</option>
                                    <option value="Trung h???c c?? s???">Trung h???c c?? s???</option>
                                    <option value="Trung h???c ph??? th??ng">THPT</option>
                                    <option value="?????i h???c">?????i h???c</option>
                                    <option value="Th???c s??">Th???c s??</option>
                                    <option value="Ti???n s??">Ti???n s??</option>
                                    <option value="Ph?? gi??o s??">Ph?? Gi??o s??</option>
                                    <option value="Gi??o s??">Gi??o s??</option>
                                    <option value="Kh??c">Kh??c</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>T??n Tr?????ng: (*)</label>
                                <input type="text" class="form-control text-uppercase" id="txtSchool" name="education[${optionIndex}][school]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Chuy??n ng??nh: (*)</label>
                                <input type="text" class="form-control" name="education[${optionIndex}][fieldOfStudy]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>N??m t???t nghi???p:(*)</label>
                                <input type="text" class="form-control" name="education[${optionIndex}][graduatedYear]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>X???p lo???i:</label>
                                <input type="text" class="form-control" name="education[${optionIndex}][grade]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>H??nh th???c h???c:</label>
                                <input type="text" class="form-control" name="education[${optionIndex}][modeOfStudy]">
                            </div>
                        </div>
                    </div>
            `);
        }

        $('#province').on('change', function () {
            var parent = this.value;

            $.ajax({
                url: '{{ action('StaffController@loadRegional') }}',
                Type: 'GET',
                datatype: 'text',
                data:
                    {
                        parent: parent,
                    },
                cache: false,
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('#district').empty();
                    for (var i = 0; i < obj.length; i++) {
                        $('#district').append('<option value="' + obj[i]['id'] + '">' + obj[i]['name'] + '</option>');
                    }
                }
            });
        });

        $('.open-detail-time-leave').click(function () {
            var id = $(this).attr('id');

            $.ajax({
                url: '{{ action('TimeleaveController@detailTime') }}',
                Type: 'POST',
                datatype: 'text',
                data:
                    {
                        id: id,
                    },
                cache: false,
                success: function (data) {
                    console.log(data);
                    $('#html_pending').empty().append(data);
                    $('#bsc-modal').modal();
                }
            });
        });

    </script>
@endsection
