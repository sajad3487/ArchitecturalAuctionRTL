@extends('layouts.customer.master')
@section('content')

    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">


        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <div class="row">
                    <div class="col-xl-12 mb-3">

                        <!--begin::Engage Widget 15-->
                        <div class="card card-custom ">
                            <div class="card-body rounded p-0 d-flex bg-light justify-content-between">
                                <div
                                    class="d-flex flex-column flex-lg-row-auto w-auto w-lg-350px w-xl-450px w-xxl-650px py-10 py-md-6 px-6 px-md-20 pr-lg-0">
                                    <h1 class="font-weight-bolder text-dark mb-2">
                                        @if(isset($project))
                                            Project No : {{$project->id ?? ''}}
                                            @else
                                            New Project
                                            @endif
                                    </h1>
                                {{--                                    <div class="font-size-h4 mb-8">Get Amazing Gadgets</div>--}}

                                </div>
                                <div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover mr-10"
                                     style="background-image: url({{asset('/media/bg/search.png')}}); background-size: 200px; background-position: right"
                                         >
{{--                                    <img src="{{asset('media/bg/search.png')}}" style="width: 100%" alt="">--}}

                                </div>
                            </div>
                        </div>
                        <!--end::Engage Widget 15-->
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <div class="card card-custom">
                    <div class="card-body p-0">
                    @if(!isset($proposal))
                        <form class="form" action="
                            @if(isset($proposal))
                            {{url("designer/proposal/$proposal->id/update")}}
                            @else
                            {{url("designer/proposal/store")}}
                            @endif
                            " method="post" enctype="multipart/form-data">

                            @if(isset($proposal))
                                @method('PUT')
                            @endif

                            @csrf
                            <div class="card-body">
                                <div class="px-5">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h3>Project Title: {{$project->title ?? ''}}</h3>
                                            <h6>{{$project->subtitle ?? ''}}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="text-success">{{$project->net_price ?? ''}} $</h3>
                                            <h4>Price</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row ">
                                        <div class="col-12 col-md-4">
                                            <h6>Description:</h6>
                                            <p>{{$project->description ?? ''}}</p>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <h6>Objective:</h6>
                                            <p>{{$project->objective ?? ''}}</p>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <h6>Address:</h6>
                                            <p>{{$project->address ?? ''}}</p>
                                        </div>
                                    </div>




                                </div>
                                <hr>
                                <div class="pt-5 px-5">
                                    <h3 class="mb-5">Send Your Proposal :</h3>
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control form-control-solid" value="{{old('title') ?? $proposal->title ?? ''}}" placeholder="Project title"/>
                                    </div>
                                    <input type="number" name="project_id" value="{{$project->id}}" class="d-none">
                                    <div class="form-group">
                                        <label for="exampleTextarea">Description</label>
                                        <textarea name="description" class="form-control form-control-solid" rows="3" >{{old('description') ?? $proposal->description ?? ''}}</textarea>
                                    </div>

                                    <div class="row mb-6">
                                        <div class="col-lg-12 p-0">
                                            <!--begin::Card-->
                                                        <div>
                                                            <div class="form-group row m-0" id="kt_repeater_1">
                                                                <div data-repeater-list="" class="col-lg-10 p-0">
                                                                    <div data-repeater-item class="form-group row align-items-center m-0">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>File Browser</label>
                                                                                <div></div>
                                                                                <div class="custom-file">
                                                                                    <input type="file" name="file[]" class="custom-file-input" id="file_input_0"/>
                                                                                    <label class="custom-file-label" for="file_input_0">Choose file</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="form-group row m-0">
                                                                <div class="col-lg-4">
                                                                    <a onclick="add_input()" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                                                                        <i class="la la-plus"></i>Add More File
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                            <!--end::Card-->
                                        </div>

                                    </div>
                                </div>
{{--                                <div class="form-group row">--}}
{{--                                    <label class="col-form-label text-right col-lg-3 col-sm-12">Minimum Setup</label>--}}
{{--                                    <div class="col-lg-4 col-md-9 col-sm-12">--}}
{{--                                        <input type="text" name="deadline" class="form-control" id="kt_datepicker_1"  readonly placeholder="Select date"/>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>

                            <div class="card-footer">
                                <a href="@if(isset($project)) {{url("designer/project/$project->id/view")}}@else{{url('owner/project')}}@endif" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </div>
                        </form>
                    @else
                            <div class="card-body">
                                <div class="px-5">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h3>Project Title: {{$project->title ?? ''}}</h3>
                                            <h6>{{$project->subtitle ?? ''}}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="text-success">{{$project->net_price ?? ''}} $</h3>
                                            <h4>Price</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row ">
                                        <div class="col-12 col-md-4">
                                            <h6>Description:</h6>
                                            <p>{{$project->description ?? ''}}</p>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <h6>Objective:</h6>
                                            <p>{{$project->objective ?? ''}}</p>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <h6>Address:</h6>
                                            <p>{{$project->address ?? ''}}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="px-5 mt-5 pt-5">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h3>Project Title:</h3>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-12 my-5">
                                            <h6>Your Proposal Title:</h6>
                                            <p>{{$proposal->title ?? ''}}</p>
                                        </div>
                                        <div class="col-12 my-5">
                                            <h6>Your Proposal Description:</h6>
                                            <p>{{$proposal->description ?? ''}}</p>
                                        </div>
                                        <div class="col-12 my-5">
                                            <h6>Your Proposal file:</h6>
                                            <div class="row mt-5 pt-5">
                                                @foreach($files as $file)
                                                <!--begin::Col-->
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4">
                                                    <!--begin::Card-->
                                                    <div class="card card-custom gutter-b card-stretch">
                                                        <div class="card-header border-0 p-0">
                                                            <h3 class="card-title">
                                                            </h3>
                                                            <div class="card-toolbar">
                                                                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left">
                                                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                                                        <i class="ki ki-bold-more-hor"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                                                        <!--begin::Navigation-->
                                                                        <ul class="navi navi-hover">
                                                                            <li class="navi-item">
                                                                                <a href="{{url($file->media_path)}}" class="navi-link" download>
                                                                                    <span class="navi-icon text-success"><i class="flaticon-download"></i></span>
                                                                                    <span class="navi-text text-success">Download</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        <!--end::Navigation-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body p-4">
                                                            <div class="d-flex flex-column align-items-center" style="overflow: hidden">
                                                                <!--begin: Icon-->
                                                                <img alt="" class="max-h-65px" src="{{asset('media/logos/file.png')}}"/>
                                                                <!--end: Icon-->

                                                                <!--begin: Tite-->
                                                                <a href="{{url($file->media_path)}}" class="text-dark-75 font-weight-bold mt-15 font-size-lg" download>
                                                                    {{str_replace('/image/',' ',$file->media_path)}}
                                                                </a>
                                                                <!--end: Tite-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end:: Card-->
                                                </div>
                                                <!--end::Col-->
                                                    @endforeach


                                            </div>
                                            @if($project->deadline >now() && $project->designer_id == null)
                                                <div>
                                                    <form action="{{url("designer/proposal/$proposal->id/add_file")}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group row m-0" id="kt_repeater_1">
                                                            <div data-repeater-list="" class="col-lg-10 p-0">
                                                                <div data-repeater-item class="form-group row align-items-center m-0">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>File Browser</label>
                                                                            <div></div>
                                                                            <div class="custom-file">
                                                                                <input type="file" name="file" class="custom-file-input" id="file_input_0"/>
                                                                                <label class="custom-file-label" for="file_input_0">Choose file</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row m-0">
                                                            <div class="col-lg-4">
                                                                <button type="submit" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-success w-100px">
                                                                    <i class="la la-plus"></i>Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->

    </div>
    <!--end::Content-->
    <script>
        var count = 1;
        function add_input() {
            var place = document.getElementById('kt_repeater_1');
            var get_input = '        <div data-repeater-list="" class="col-lg-10 p-0">\n' +
                '            <div data-repeater-item class="form-group row align-items-center m-0">\n' +
                '                <div class="col-md-6">\n' +
                '                    <div class="form-group">\n' +
                '                        <label>File Browser</label>\n' +
                '                        <div></div>\n' +
                '                        <div class="custom-file">\n' +
                '                            <input type="file" name="file[]" class="custom-file-input" id="file_input_';
            get_input += count;
            get_input += '"/>\n' +
                '<label class="custom-file-label" for="file_input_';
            get_input += count;
            get_input += '" >Choose file</label>\n' +
                '                </div>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '</div>';
            place.insertAdjacentHTML('beforeend',get_input);
            count ++;
        }


    </script>

@endsection
