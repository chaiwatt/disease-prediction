@extends('layouts.landing')

@section('content')
<!-- Start Appointment Section -->
<section class="cs_shape_wrap" id="appointment">
    <div class="cs_shape_2">
        <svg width="1089" height="1002" viewBox="0 0 1089 1002" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.2"
                d="M444.57 826.314C529.104 1065.89 739.237 1008.47 834.547 949.171C981.567 843.507 997.742 626.309 999.967 542.103C1001.75 474.739 1058.26 303.318 1086.29 226.028C1115.11 -40.9119 843.814 0.833657 795.515 6.26561C747.215 11.6976 593.662 71.4673 441.083 40.606C319.02 15.917 205.529 28.8791 164.042 38.4462C-13.0065 100.952 -2.22156 200.043 3.13034 242.954C8.48234 285.864 53.2821 366.319 234.465 453.073C379.411 522.475 435.469 730.386 444.57 826.314Z"
                fill="url(#paint0_linear_5_285)" />
            <defs>
                <linearGradient id="paint0_linear_5_285" x1="844.274" y1="950.214" x2="424.319" y2="-69.4782"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#86BBF1" offset="0" />
                    <stop offset="1" stop-color="#D2EAEF" />
                </linearGradient>
            </defs>
        </svg>
    </div>
    <div class="cs_height_150 cs_height_xl_125 cs_height_lg_90"></div>
    <div class="container">
        <div class="row align-items-center cs_gap_y_40">
            <div class="col-lg-6">
                <div class="cs_height_35 cs_height_lg_50"></div>
                <form action="#" class="row">
                    <h3 class="cs_section_subtitle text-uppercase cs_accent_color cs_semibold m-0 cs_accent_color"
                        style="font-size:24px">
                        Introduction</h3>
                    <!-- <div class="cs_height_5"></div> -->
                    <span class="mt-2">The ability to accurately diagnose diseases based on symptoms is a critical skill
                        for healthcare professionals. This is
                        because it allows them to provide the appropriate treatment and prevent further complications.
                        However, the process of
                        diagnosis can be time-consuming and challenging, especially in cases where the symptoms are
                        vague or non-specific.</span>
                    <div class="cs_height_20 cs_height_lg_45"></div>
                    <h3 class="cs_section_subtitle text-uppercase cs_accent_color cs_semibold m-0 cs_accent_color "
                        style="font-size:24px">
                        Problem Statement</h3>
                    <!-- <div class="cs_height_5"></div> -->
                    <span class="mt-2">The current methods for diagnosing diseases are based on a combination of
                        clinical judgment, laboratory tests, and
                        imaging studies. These methods can be accurate, but they can also be expensive, time-consuming,
                        and invasive. In
                        addition, they may not be available in all settings, such as in rural or developing
                        areas.</span>
                    <div class="cs_height_20 cs_height_lg_45"></div>
                    <h3 class="cs_section_subtitle text-uppercase cs_accent_color cs_semibold m-0 cs_accent_color "
                        style="font-size:24px">
                        Solution</h3>
                    <!-- <div class="cs_height_5"></div> -->
                    <span class="mt-2">Machine learning (ML) has the potential to revolutionize the way diseases are
                        diagnosed. ML algorithms can be trained on
                        large datasets of patient data, including symptoms, laboratory results (symptoms). This allows
                        them to learn the
                        relationships between symptoms and diseases.</span>
                    <div class="cs_height_20 cs_height_lg_45"></div>
                    <h3 class="cs_section_subtitle text-uppercase cs_accent_color cs_semibold m-0 cs_accent_color "
                        style="font-size:24px">
                        Objectives</h3>
                    <!-- <div class="cs_height_5"></div> -->
                    <span class="mt-2">The objective of this project is to develop an ML-based system for diagnosing
                        diseases from symptoms. The system will be
                        trained on a dataset of patient data, including symptoms, laboratory results(symptoms). The
                        system will then be
                        evaluated on a test dataset of patient data to assess its accuracy.</span>
                    <div class="cs_height_20 cs_height_lg_45"></div>
                    <h3 class="cs_section_subtitle text-uppercase cs_accent_color cs_semibold m-0 cs_accent_color "
                        style="font-size:24px">
                        Methods</h3>
                    <!-- <div class="cs_height_5"></div> -->
                    <span class="mt-2">
                        <ul>
                            <li>Collect a comprehensive dataset of patient data by collecting patient descriptions of
                                symptoms.</li>
                            <li>Categorize training data based on Dialog Flow symptom intents.</li>
                        </ul>
                    </span>
                    <div class="cs_height_20 cs_height_lg_45"></div>
                    <h3 class="cs_section_subtitle text-uppercase cs_accent_color cs_semibold m-0 cs_accent_color "
                        style="font-size:24px">
                        Conclusion</h3>
                    <!-- <div class="cs_height_5"></div> -->
                    <span class="mt-2">
                        The development of an ML-based system for diagnosing diseases from symptoms has the potential to
                        revolutionize the way
                        diseases are diagnosed. ML algorithms can be accurate, efficient, and affordable. They can also
                        be used in settings
                        where traditional diagnostic methods are not available.
                    </span>
                    <div class="cs_height_20 cs_height_lg_45"></div>

                    {{-- <img src="{{asset('assets/img/diagram.png')}}" alt=""> --}}

                </form>
            </div>
            <div class="col-lg-5 offset-lg-1 text-center">
                <img src="assets/img/home_1/appointment.png" alt="Appointment" class="cs_radius_30">
            </div>
        </div>
    </div>
</section>

<section id="result-area-wrapper">

</section>
<!-- End FAQ Section -->
<!-- Start Brands -->


@endsection