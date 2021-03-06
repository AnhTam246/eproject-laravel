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
        <div class="card-header header-elements-inline">
            <h1 class="pt-3 pl-3 pr-3">C???p Nh???t Nh??n Vi??n</h1>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ action('StaffController@postEditStaff') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" value="{{$data['id']}}" name="txtID"/>
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
                                                        <input type="text" class="form-control" name="txtCode" value="{{ $data['code'] }}" require placeholder="Nh???p M?? Nh??n vi??n: TTN" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Ph??n Quy???n:(*)</label>
                                                        <!-- <input type="text" class="form-control" name="txtGender"> -->
                                                        <select class="form-control" name="txtisManager" color="red">
                                                            <option value="0" @if($data['isManager'] == 0) selected @endif>Nh??n vi??n</option>
                                                            <option value="1" @if($data['isManager'] == 1) selected @endif>Qu???n l??</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>H??? nh??n vi??n:</label>
                                                        <input type="text" class="form-control" name="txtLname" value="{{ $data['lastname'] }}" placeholder="Nh???p H???">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>T??n Nh??n vi??n:(*)</label>
                                                        <input type="text" class="form-control" name="txtFname" value="{{ $data['firstname'] }}" require placeholder="Nh???p T??n">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6" hidden>
                                                    <div class="form-group">
                                                        <label>Ph??ng Ban:(*)</label>
                                                        <select class="form-control" name="txtDepartment">
                                                            @foreach($data_department as $dep)
                                                                <option value="{{ $dep['id'] }}" @if($data['department'] == $dep['id']) selected @endif>{{ $dep['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Ng??y sinh:</label>
                                                        <input type="text" class="form-control daterange-single" name="txtDob" value="{{ $data['dob'] }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Ng??y V??o:(*)</label>
                                                        <input type="text" class="form-control daterange-single" name="txtJoinat" value="{{ $data['joinedAt'] }}">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                             
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gi???i t??nh:(*)</label>
                                                        <select class="form-control" name="txtGender">
                                                            <option value="1" @if($data['gender'] == 1) selected @endif>Nam</option>
                                                            <option value="0" @if($data['gender'] == 0) selected @endif>N???</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Khu v???c:(*)</label>
                                                        <!-- <input type="text" class="form-control" name="txtGender"> -->
                                                        <select id="province" class="form-control form-control-select2" color="red" data-fouc>
                                                            @foreach($data_reg as $reg)
                                                                <option value="{{ $reg['id'] }}" @if($district_selected['parent'] == $reg['id']) selected @endif>{{ $reg['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                            
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Th??nh Ph???/Huy???n/X??:(*)</label>
                                                        <select id="district" class="form-control form-control-select2" name="txtRegional" color="red" data-fouc>
                                                            @foreach($data_district as $district)
                                                                <option value="{{ $district['id'] }}" @if($district_selected['id'] == $district['id']) selected @endif>{{ $district['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>??i???n tho???i:</label>
                                                        <input type="number" class="form-control" name="txtPhone" value="{{ $data['phoneNumber'] }}" placeholder="Nh???p s??? ??i???n tho???i">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email:</label>
                                                        <input type="text" class="form-control" name="txtEmail" value="{{ $data['email'] }}" placeholder="Nh???p Email abc12@exam.com">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>M???t kh???u:</label>
                                                        <input type="hidden" class="form-control" name="txtPassOld" value="{{ $data['password'] }}">
                                                        <input type="password" class="form-control" name="txtPass">
                                                    </div>
                                                </div>
                                            </div>
                                           

                                        </fieldset>
                                    </div>

                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend class="font-weight-semibold"><i class="icon-paperplane mr-2"></i> H??nh ???nh</legend>
                                            <div class="form-group">
                                                <label>CMND:(*)</label>
                                                <input type="text" class="form-control" name="txtIDNumber" placeholder="Nh???p s??? CMND" value="{{ $data['idNumber'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Ng??y c???p:(*)</label>
                                                <input type="text" class="form-control daterange-single" name="txtIssue" value="{{ old('txtIssue') }}">
                                            </div>

                                            <div class="form-group" hidden>
                                                <label>H??nh ???nh:</label>
                                                <input type="text" class="form-input-styled" name="txtImagesOld" value="{{$data['photo']}}" data-fouc>
                                            </div>

                                            <div class="form-group">
                                                <label>H??nh ???nh:</label>
                                                <p><img width="50px" height="50px" src="{{ asset($data['photo']) }}"></p>
                                                <input type="file" class="form-input-styled" name="txtPhoto" data-fouc>
                                            </div>

                                            <div class="form-group" hidden>
                                                <label>M???t tr?????c CMND:</label>
                                                <input type="text" class="form-input-styled" name="txtImagesOld2" value="{{$data['idPhoto']}}" data-fouc>
                                            </div>
                                            <div class="form-group">
                                                <label>M???t tr?????c CMND:</label>
                                                <p><img width="50px" height="50px" src="{{ asset($data['idPhoto']) }}"></p>
                                                <input type="file" class="form-input-styled" name="txtIDPhoto" data-fouc>
                                            </div>

                                            <div class="form-group" hidden>
                                                <label>M???t sau CMND:</label>
                                                <input type="text" class="form-input-styled" name="txtImagesOld3" value="{{$data['idPhotoBack']}}" data-fouc>
                                            </div>
                                            <div class="form-group">
                                                <label>M???t sau CMND:</label>
                                                <p><img width="50px" height="50px" src="{{ asset($data['idPhotoBack']) }}"></p>
                                                <input type="file" class="form-input-styled" name="txtIDPhoto2" data-fouc>
                                            </div>

                                            <div class="form-group">
                                                <label>Ghi ch??:</label>
                                                <textarea rows="5" cols="5" class="form-control" name="txtNote" placeholder="Nh???p Ghi ch??">{{ $data['note'] }}</textarea>
                                            </div>
                                            <div class="form-group" hidden>
                                                <label>Createby:</label>
                                                <textarea  class="form-control" name="txtCreateBy">{{ $data['createdBy'] }}</textarea>
                                            </div>
                                            <div class="form-group" hidden>
                                                <label>Createat:</label>
                                                <textarea  class="form-control" name="txtCreatedAt" >{{ $data['createdAt'] }}</textarea>
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
                                            @foreach($data_edu as $index => $education)
                                                <hr>
                                                <input type="hidden" class="form-control" name="education[{{ $index }}][staffId]" value="{{ $education['staffId'] }}">
                                                <input type="hidden" class="form-control" name="education[{{ $index }}][id]" value="{{ $education['id'] }}">

                                                <div class="row">
                                                    <div class="col-md-2" hidden>
                                                        <div class="form-group">
                                                            <label>C???p B???c:</label>
                                                            <input type="text" class="form-control" name="education[{{ $index }}][level]" value="{{ $education['level'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>T??n C???p B???c:</label>
                                                            <select id="txtLevelName" class="form-control" name="education[{{ $index }}][levelName]">
                                                                <option value="Ti???u h???c" @if($education['levelName'] == 'Ti???u h???c') selected @endif>Ti???u h???c</option>
                                                                <option value="Trung h???c c?? s???" @if($education['levelName'] == 'Trung h???c c?? s???') selected @endif>Trung h???c c?? s???</option>
                                                                <option value="Trung h???c ph??? th??ng" @if($education['levelName'] == 'Trung h???c ph??? th??ng') selected @endif>THPT</option>
                                                                <option value="?????i h???c" @if($education['levelName'] == '?????i h???c') selected @endif>?????i h???c</option>
                                                                <option value="Th???c s??" @if($education['levelName'] == 'Th???c s??') selected @endif>Th???c s??</option>
                                                                <option value="Ti???n s??" @if($education['levelName'] == 'Ti???n s??') selected @endif>Ti???n s??</option>
                                                                <option value="Ph?? gi??o s??" @if($education['levelName'] == 'Ph?? gi??o s??') selected @endif>Ph?? Gi??o s??</option>
                                                                <option value="Gi??o s??" @if($education['levelName'] == 'Gi??o s??') selected @endif>Gi??o s??</option>
                                                                <option value="Kh??c"> @if($education['levelName'] == 'Kh??c') selected @endif>Kh??c</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>T??n Tr?????ng: (*)</label>
                                                            <input type="text" class="form-control text-uppercase" id="txtSchool" name="education[{{ $index }}][school]" value="{{ $education['school'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Chuy??n ng??nh: (*)</label>
                                                            <input type="text" class="form-control" name="education[{{ $index }}][fieldOfStudy]" value="{{ $education['fieldOfStudy'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>N??m t???t nghi???p:(*)</label>
                                                            <input type="text" class="form-control" name="education[{{ $index }}][graduatedYear]" value="{{ $education['graduatedYear'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>X???p lo???i:</label>
                                                            <input type="text" class="form-control" name="education[{{ $index }}][grade]" value="{{ $education['grade'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>H??nh th???c h???c:</label>
                                                            <input type="text" class="form-control" name="education[{{ $index }}][modeOfStudy]" value="{{ $education['modeOfStudy'] }}">
                                                        </div>
                                                    </div>
                                                        <div class="col-md-2">
                                                            <a href="{{ action('EducationController@deleteEducation') }}?id={{ $education['id'] }}" class="btn btn-success" onclick="return confirm('B???n ch???c ch???n mu???n x??a?')" style="
                                                            margin-top: -15px;">X??a</a>
                                                        </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-success">L??u <i class="icon-paperplane ml-2"></i></button>
                    <a class="btn btn-primary" role="button" href="{{ action('StaffController@index') }}" style="color:white;">Quay l???i</a>
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
        let optionIndex = {{ count($data_edu) - 1 }};

        function addOption() {
            optionIndex++;
            $('#education').append(`
                    <hr>
                    <input type="hidden" value="{{$data['id']}}" name="education[${optionIndex}][staffId]"/>

                    <div class="row">
                        <div class="col-md-2" hidden>
                            <div class="form-group">
                                <label>C???p B???c:</label>
                                <input type="text" class="form-control" value="2" name="education[${optionIndex}][level]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>T??n C???p B???c:</label>
                                <select id="txtLevelName" class="form-control" name="education[${optionIndex}][levelName]">
                                    <option value="Ti???u h???c">Ti???u h???c</option>
                                    <option value="Trung h???c c?? s???">THCS</option>
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
