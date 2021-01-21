@extends('layouts.owner.master')
@section('content')

    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">


        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <div class="row">
                    <div class="col-xl-12">

                        <!--begin::Engage Widget 15-->
                        <div class="card card-custom ">
                            <div class="card-body rounded p-0 d-flex bg-light justify-content-between">
                                <div
                                    class="d-flex flex-column flex-lg-row-auto w-auto w-lg-350px w-xl-450px w-xxl-650px py-10 py-md-6 px-6 px-md-20 pr-lg-0">
                                    <h1 class="font-weight-bolder text-dark m-0">Active Project</h1>
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

        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <!--begin::Row-->
                <div class="row mt-4">
                    @foreach($projects as $key=>$project)
                    <div class="col-md-4">
                        <!--begin::Nav Panel Widget 4-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body px-6">
                                <!--begin::Wrapper-->
                                <div class="d-flex justify-content-between flex-column h-100">
                                    <!--begin::Container-->
                                    <div class="h-100">
                                        <!--begin::Header-->
                                        <div class="d-flex flex-column flex-center" >
                                            <!--begin::Image-->
                                            <div class="bgi-no-repeat bgi-size-cover rounded min-h-180px w-100" style="background-image: url({{asset($project->project_image[0]->media_path)}})"></div>
                                            <!--end::Image-->
                                            <!--begin::Title-->
                                            <a href="{{url("owner/project/$project->id/view")}}" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">
                                                <h3>{{$project->title ?? ''}}</h3>
                                            </a>
                                            <!--end::Title-->

                                            <!--begin::Text-->
                                            <div class="font-weight-bold text-dark-50 font-size-sm pb-7"></div>
                                            <input type="text" class="d-none" id="deadline-{{$key}}" value="{{$project->deadline}}">
                                            <!--end::Text-->
                                            <p class="pcounter" id="demo-{{$key}}"></p>

                                            <script>
                                                var deadline{{$key}} = document.getElementById('deadline-{{$key}}').value;
                                                var countDownDate{{$key}} = new Date(deadline{{$key}}).getTime();

                                                // Update the count down every 1 second
                                                var x{{$key}} = setInterval(function() {

                                                    // Get today's date and time
                                                    var now{{$key}} = new Date().getTime();
                                                    // Find the distance between now and the count down date
                                                    var distance{{$key}} = countDownDate{{$key}} - now{{$key}};

                                                    // Time calculations for days, hours, minutes and seconds
                                                    var days{{$key}} = Math.floor(distance{{$key}} / (1000 * 60 * 60 * 24));
                                                    var hours{{$key}} = Math.floor((distance{{$key}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                    var minutes{{$key}} = Math.floor((distance{{$key}} % (1000 * 60 * 60)) / (1000 * 60));
                                                    var seconds{{$key}} = Math.floor((distance{{$key}} % (1000 * 60)) / 1000);
                                                    // Output the result in an element with id="demo"


                                                    // If the count down is over, write some text
                                                    if (distance{{$key}} < 0) {
                                                        document.getElementById('demo-{{$key}}').innerHTML = "EXPIRED";
                                                        document.getElementById('demo-{{$key}}').style.color = "red";
                                                        clearInterval(x);
                                                    }else{
                                                        document.getElementById('demo-{{$key}}').innerHTML = days{{$key}} + "d " + hours{{$key}} + "h "
                                                            + minutes{{$key}} + "m " + seconds{{$key}} + "s ";
                                                    }
                                                }, 1000);
                                            </script>
                                        </div>
                                        <!--end::Header-->
                                    </div>
                                    <!--eng::Container-->

                                    <!--begin::Footer-->
                                    <div class="d-flex flex-center mt-md-1" id="kt_sticky_toolbar_chat_toggler" data-toggle="tooltip" title="" data-placement="right" data-original-title="">
                                        <h6 class="col-6 px-0">Price : {{$project->net_price ?? ''}} $</h6>

                                        <a href="{{url("owner/project/$project->id/view")}}" class="btn btn-outline-primary font-weight-bolder font-size-sm py-3 px-14">View</a>
                                    </div>
                                    <!--end::Footer-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Nav Panel Widget 4-->
                    </div>
                    @endforeach
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
    </div>

    <!--end::Content-->
@endsection
