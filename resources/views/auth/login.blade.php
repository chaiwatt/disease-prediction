@extends('layouts.landing')

@section('content')
<!-- Start Appointment Section -->
<div class="cs_height_150 cs_height_xl_145 cs_height_lg_105"></div>
<div class="cs_height_100 cs_height_xl_105 cs_height_lg_105"></div>
<section>
    <div class="container cs_mt_minus_110">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="cs_contact_form cs_style_1 cs_white_bg cs_radius_30">
                    <div class="row">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h2 class="cs_fs_55 mb-0">Sign In</h2>
                            <div class="cs_height_40 cs_height_xl_40 cs_height_lg_40"></div>
                            <div class="col-lg-12">
                                <label class="cs_input_label cs_heading_color">Email</label>
                                <input type="text" class="cs_form_field" name="email" placeholder="Email">
                                <div class="cs_height_42 cs_height_xl_25"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="cs_input_label cs_heading_color">Password</label>
                                <input type="password" class="cs_form_field" name="password" placeholder="Password">
                                <div class="cs_height_42 cs_height_xl_25"></div>
                            </div>

                            <div class="col-lg-12">
                                <div class="cs_height_18"></div>
                                <button type="submit" class="cs_btn cs_style_1">
                                    <span>Login</span>
                                    <i>
                                        <img src="assets/img/icons/arrow_white.svg" alt="Icon">
                                        <img src="assets/img/icons/arrow_white.svg" alt="Icon">
                                    </i>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


@endsection