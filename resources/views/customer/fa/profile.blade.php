@extends('layouts.customer.fa.master')
@section('content')
    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <div class="card card-custom">
                            <div class="card-header">
                                <h3 class="card-title">
                                    حساب کاربری
                                </h3>
                            </div>
                            <!--begin::Form-->
                            <form class="form" action="{{url("/designer/profile/update")}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body row">
                                    <div class="col-lg-9 p-0">
                                        @include('fragment.error')

                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label text-right px-0">نام و نام خانوادگی:</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="name" class="form-control" placeholder="نام خود را وارد نمایید" value="{{$user->name  ?? ''}}" required/>
                                            </div>
                                            <label class="col-lg-2 col-form-label text-right px-0">نام شرکت:</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="fname" class="form-control" placeholder="نام شرکت خود را وارد کنید" value="{{$user->lname  ?? ''}}" required/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label text-right px-0">ایمیل :</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="email" class="form-control" placeholder="ایمیل خود را وارد نمایید" value="{{$user->email  ?? ''}}" disabled/>
                                            </div>
                                            <label class="col-lg-2 col-form-label text-right px-0">تلفن :</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="tel" class="form-control" placeholder="شماره تلفن خود را وارد نمایید" value="{{$user->tel  ?? ''}}"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label text-right px-0">آدرس :</label>
                                            <div class="col-lg-8">
                                                <input type="text" name="address" class="form-control" placeholder="آدرس خود را وارد نمایید" value="{{$user->address  ?? ''}}" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label text-right px-0">تصویر حساب کاربری:</label>
                                            <div class="col-lg-3">
                                                <div class="input-group">
                                                    <input type="file" name="file" class="custom-file-input" id="customFile"/>
                                                    <label class="custom-file-label" for="customFile">انتخاب نمایید</label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-lg-3 p-0">
                                        <img src="{{asset($user->profile_picture)}}" alt="" style="width: 100%">
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7">
                                            <a href="{{url('designer')}}" type="reset" class="btn btn-secondary col-md-2 mr-2">بازگشت</a>
                                            <button type="submit" class="btn btn-success col-md-2">ذخیره</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card-->

                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->

    @endsection
