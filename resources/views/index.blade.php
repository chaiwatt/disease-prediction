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
    <div class="cs_height_190 cs_height_xl_145 cs_height_lg_105"></div>
    <div class="container">
        <div class="row align-items-center cs_gap_y_40">

            <!-- <div class="cs_contact_form cs_style_1 cs_white_bg cs_radius_30"> -->

            <!-- </div> -->
            <div class="col-lg-6">
                <div class="cs_section_heading cs_style_1">
                    <h3
                        class="cs_section_subtitle text-uppercase cs_accent_color cs_semibold m-0 cs_accent_color cs_fs_32">
                        Descripe your symptoms</h3>
                    <!-- <div class="cs_height_5"></div> -->
                    <div class="cs_height_20 cs_height_lg_50"></div>
                    <span class="mt-4">To help our disease prediction system accurately analyze your symptoms,
                        please be as specific as possible with each
                        symptom, listing one per line for best results, <a href="#" id="example">click for
                            example.</a></span>

                    <!-- <h2 class="cs_section_title cs_fs_72 m-0">Below</h2> -->
                </div>
                <div class="cs_height_35 cs_height_lg_50"></div>
                <form action="#" class="row">
                    <div class="col-lg-12">
                        {{-- <label class="cs_input_label cs_heading_color">Age</label> --}}
                        <input type="text" id="prompt" class="cs_form_field"
                            placeholder="Describe single symptom here then press enter to add to list.">
                        <div class="cs_height_42 cs_height_xl_25"></div>
                    </div>

                    <div class="col-lg-12">


                        <!-- <div class="row">
                     
                      <div class="col-lg-12"> -->
                        <!-- <label class="cs_input_label cs_heading_color">Message</label> -->
                        <textarea id="symptoms" cols="30" rows="8" class="cs_form_field" readonly></textarea>
                        <div class="cs_height_42 cs_height_xl_25"></div>
                    </div>
                    <div class="col-lg-6">
                        {{-- <label class="cs_input_label cs_heading_color">Gender</label> --}}
                        <select name="reason_for_visit" class="cs_select" data-placeholder="Gender">
                            <!-- <option></option> -->
                            <option value="routine-checkup">Male</option>
                            <option value="Operation">Female</option>
                        </select>
                        <div class="cs_height_42 cs_height_xl_25"></div>
                    </div>

                    <div class="col-lg-6">
                        {{-- <label class="cs_input_label cs_heading_color">Age</label> --}}
                        <input type="text" class="cs_form_field" placeholder="Age in years">
                        <div class="cs_height_42 cs_height_xl_25"></div>
                    </div>
                    <div class="col-lg-6">
                        {{-- <label class="cs_input_label cs_heading_color">Weight</label> --}}
                        <input type="text" class="cs_form_field" placeholder="Weight in Kgs">
                        <div class="cs_height_42 cs_height_xl_25"></div>
                    </div>
                    <div class="col-lg-6">
                        {{-- <label class="cs_input_label cs_heading_color">Height</label> --}}
                        <input type="text" class="cs_form_field" placeholder="Height in cm">
                        <div class="cs_height_42 cs_height_xl_25"></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="cs_height_18"></div>
                        <button class="cs_btn cs_style_1">
                            <span>Checkup</span>
                            <i>
                                <img src="assets/img/icons/arrow_white.svg" alt="Icon">
                                <img src="assets/img/icons/arrow_white.svg" alt="Icon">
                            </i>
                        </button>
                        <!-- </div>
    
                  </div> -->

                        <!-- <label class="cs_input_label cs_heading_color cs_fs_18 cs_medium">Comment*</label>
                  <textarea cols="30" rows="8" class="cs_form_field_2"></textarea>
                  <div class="cs_height_42 cs_height_xl_25"></div> -->
                    </div>



                    <!-- <div class="col-lg-12">
                    <label class="cs_input_label cs_heading_color">Reason for Visit</label>
                    <div class="cs_radio_group">
                      <div class="cs_radio_wrap">
                        <input class="cs_radio_input" type="radio" name="reasonForVisit" id="routineCheckup" value="routineCheckup">
                        <label class="cs_radio_label" for="routineCheckup">Routine Checkup</label>
                      </div>
                      <div class="cs_radio_wrap">
                        <input class="cs_radio_input" type="radio" name="reasonForVisit" id="newPatientVisit" value="newPatientVisit" checked>
                        <label class="cs_radio_label" for="newPatientVisit">New Patient Visit</label>
                      </div>
                      <div class="cs_radio_wrap">
                        <input class="cs_radio_input" type="radio" name="reasonForVisit" id="specificConcern" value="specificConcern">
                        <label class="cs_radio_label" for="specificConcern">Specific Concern</label>
                      </div>
                    </div>
                    <div class="cs_height_42 cs_height_xl_25"></div>
                  </div>
                -->
                    <!-- <div class="col-lg-12">
                    <button class="cs_btn cs_style_1">
                      <span>Submit</span>
                      <i>
                        <img src="assets/img/icons/arrow_white.svg" alt="Icon">
                        <img src="assets/img/icons/arrow_white.svg" alt="Icon">
                      </i>
                    </button>
                  </div> -->
                </form>
            </div>
            <div class="col-lg-5 offset-lg-1 text-center">
                <img src="assets/img/home_1/appointment.jpg" alt="Appointment" class="cs_radius_30">
            </div>
        </div>
    </div>
</section>
<!-- End Appointment Section -->
<!-- Start FAQ Section -->
<section hidden>
    <div class="cs_height_100 cs_height_xl_145 cs_height_lg_105"></div>
    <div class="container">
        <div class="cs_section_heading cs_style_1 text-center">
            <h3 class="cs_section_subtitle text-uppercase cs_accent_color cs_semibold m-0 cs_accent_color cs_fs_32">
                There are</h3>
            <div class="cs_height_5"></div>
            <h2 class="cs_section_title cs_fs_72 m-0">4 possible found</h2>
        </div>
        <div class="cs_height_72 cs_height_lg_50"></div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="cs_accordians cs_style1 cs_heading_color">
                    <div class="cs_accordian active">
                        <h2 class="cs_accordian_head cs_heading_color">
                            Acute Flaccid Myelitis (AFM)
                            <span class="cs_accordian_arrow">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M-6.11959e-07 14C-2.74531e-07 21.7195 6.28053 28 14 28C21.7195 28 28 21.7195 28 14C28 6.28053 21.7195 -9.49388e-07 14 -6.11959e-07C6.28053 -2.74531e-07 -9.49388e-07 6.28053 -6.11959e-07 14ZM26.25 14C26.25 20.7548 20.7548 26.25 14 26.25C7.24522 26.25 1.75 20.7548 1.75 14C1.75 7.24522 7.24522 1.75 14 1.75C20.7548 1.75 26.25 7.24522 26.25 14ZM13.3814 8.13137C13.7233 7.78947 14.2769 7.78947 14.6186 8.13137L18.9936 12.5064C19.1645 12.6772 19.25 12.9012 19.25 13.125C19.25 13.3488 19.1645 13.5728 18.9936 13.7436C18.6517 14.0855 18.0981 14.0855 17.7564 13.7436L14.875 10.8622L14.875 19.25C14.875 19.7332 14.4837 20.125 14 20.125C13.5163 20.125 13.125 19.7332 13.125 19.25L13.125 10.8622L10.2436 13.7436C9.90172 14.0855 9.34806 14.0855 9.00637 13.7436C8.66469 13.4017 8.66447 12.8481 9.00637 12.5064L13.3814 8.13137Z"
                                        fill="#307BC4" />
                                </svg>
                            </span>
                        </h2>
                        <div class="cs_accordian_body">
                            <p>Most patients will have sudden onset of limb weakness and loss of muscle tone and
                                reflexes. Some patients also will
                                experience:

                                facial droop/weakness
                                difficulty moving the eyes
                                drooping eyelids
                                difficulty with swallowing or slurred speech
                                Numbness or tingling is rare in patients with AFM, though some patients have pain in
                                their arms or legs. Some patients
                                with AFM may be unable to pass urine. The most severe symptom of AFM is respiratory
                                failure that can happen when the
                                muscles involved with breathing become weak. This can require urgent ventilator
                                support (breathing machines).

                                If you or your child develops any of these symptoms, you should seek medical care
                                right away. <a
                                    href="https://dph.illinois.gov/topics-services/diseases-and-conditions/diseases-a-z-list/afm.html">More
                                    Info</a> </p>
                            <button class="cs_btn cs_style_1 mt-3">
                                <span>More Info</span>

                            </button>
                        </div>
                    </div><!-- .cs_accordian -->
                    <div class="cs_accordian">
                        <h2 class="cs_accordian_head cs_heading_color">
                            How do I schedule an appointment with ProHealth?
                            <span class="cs_accordian_arrow">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M-6.11959e-07 14C-2.74531e-07 21.7195 6.28053 28 14 28C21.7195 28 28 21.7195 28 14C28 6.28053 21.7195 -9.49388e-07 14 -6.11959e-07C6.28053 -2.74531e-07 -9.49388e-07 6.28053 -6.11959e-07 14ZM26.25 14C26.25 20.7548 20.7548 26.25 14 26.25C7.24522 26.25 1.75 20.7548 1.75 14C1.75 7.24522 7.24522 1.75 14 1.75C20.7548 1.75 26.25 7.24522 26.25 14ZM13.3814 8.13137C13.7233 7.78947 14.2769 7.78947 14.6186 8.13137L18.9936 12.5064C19.1645 12.6772 19.25 12.9012 19.25 13.125C19.25 13.3488 19.1645 13.5728 18.9936 13.7436C18.6517 14.0855 18.0981 14.0855 17.7564 13.7436L14.875 10.8622L14.875 19.25C14.875 19.7332 14.4837 20.125 14 20.125C13.5163 20.125 13.125 19.7332 13.125 19.25L13.125 10.8622L10.2436 13.7436C9.90172 14.0855 9.34806 14.0855 9.00637 13.7436C8.66469 13.4017 8.66447 12.8481 9.00637 12.5064L13.3814 8.13137Z"
                                        fill="#307BC4" />
                                </svg>
                            </span>
                        </h2>
                        <div class="cs_accordian_body">
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesent
                                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
                                occaecati cupiditate non provident, similique sunt in culpa qui.</p>
                        </div>
                    </div><!-- .cs_accordian -->
                    <div class="cs_accordian">
                        <h2 class="cs_accordian_head cs_heading_color">
                            Do you accept insurance?
                            <span class="cs_accordian_arrow">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M-6.11959e-07 14C-2.74531e-07 21.7195 6.28053 28 14 28C21.7195 28 28 21.7195 28 14C28 6.28053 21.7195 -9.49388e-07 14 -6.11959e-07C6.28053 -2.74531e-07 -9.49388e-07 6.28053 -6.11959e-07 14ZM26.25 14C26.25 20.7548 20.7548 26.25 14 26.25C7.24522 26.25 1.75 20.7548 1.75 14C1.75 7.24522 7.24522 1.75 14 1.75C20.7548 1.75 26.25 7.24522 26.25 14ZM13.3814 8.13137C13.7233 7.78947 14.2769 7.78947 14.6186 8.13137L18.9936 12.5064C19.1645 12.6772 19.25 12.9012 19.25 13.125C19.25 13.3488 19.1645 13.5728 18.9936 13.7436C18.6517 14.0855 18.0981 14.0855 17.7564 13.7436L14.875 10.8622L14.875 19.25C14.875 19.7332 14.4837 20.125 14 20.125C13.5163 20.125 13.125 19.7332 13.125 19.25L13.125 10.8622L10.2436 13.7436C9.90172 14.0855 9.34806 14.0855 9.00637 13.7436C8.66469 13.4017 8.66447 12.8481 9.00637 12.5064L13.3814 8.13137Z"
                                        fill="#307BC4" />
                                </svg>
                            </span>
                        </h2>
                        <div class="cs_accordian_body">
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesent
                                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
                                occaecati cupiditate non provident, similique sunt in culpa qui.</p>
                        </div>
                    </div><!-- .cs_accordian -->
                    <div class="cs_accordian">
                        <h2 class="cs_accordian_head cs_heading_color">
                            What should I bring to my appointment?
                            <span class="cs_accordian_arrow">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M-6.11959e-07 14C-2.74531e-07 21.7195 6.28053 28 14 28C21.7195 28 28 21.7195 28 14C28 6.28053 21.7195 -9.49388e-07 14 -6.11959e-07C6.28053 -2.74531e-07 -9.49388e-07 6.28053 -6.11959e-07 14ZM26.25 14C26.25 20.7548 20.7548 26.25 14 26.25C7.24522 26.25 1.75 20.7548 1.75 14C1.75 7.24522 7.24522 1.75 14 1.75C20.7548 1.75 26.25 7.24522 26.25 14ZM13.3814 8.13137C13.7233 7.78947 14.2769 7.78947 14.6186 8.13137L18.9936 12.5064C19.1645 12.6772 19.25 12.9012 19.25 13.125C19.25 13.3488 19.1645 13.5728 18.9936 13.7436C18.6517 14.0855 18.0981 14.0855 17.7564 13.7436L14.875 10.8622L14.875 19.25C14.875 19.7332 14.4837 20.125 14 20.125C13.5163 20.125 13.125 19.7332 13.125 19.25L13.125 10.8622L10.2436 13.7436C9.90172 14.0855 9.34806 14.0855 9.00637 13.7436C8.66469 13.4017 8.66447 12.8481 9.00637 12.5064L13.3814 8.13137Z"
                                        fill="#307BC4" />
                                </svg>
                            </span>
                        </h2>
                        <div class="cs_accordian_body">
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesent
                                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
                                occaecati cupiditate non provident, similique sunt in culpa qui.</p>
                        </div>
                    </div><!-- .cs_accordian -->
                </div><!-- .cs_accordians -->
            </div>
        </div>
    </div>
</section>
<!-- End FAQ Section -->
<!-- Start Brands -->

@push('scripts')

<script>
    window.params = {
        textDetectionRoute: '{{ route('processing.text-detection') }}',
        url: '{{ url('/') }}',
        token: $('meta[name="csrf-token"]').attr('content')
    };

    $(document).on('keypress', '#prompt', function (e) {
        if (e.which === 13) { 
            e.preventDefault(); 
           
            var token = window.params.token
            var textDetectionRoute = window.params.textDetectionRoute
            var data = {
                'message': $(this).val()
            }

            postRequest(data, textDetectionRoute, token).then(response => {
                var bot = response.message.intentBot;
                var fulfilmentText = response.message.fulfilmentText;
                console.log(response.message);
                if(bot !== 'Default Fallback Intent'){
                    if ($('#symptoms').val().indexOf(fulfilmentText) === -1) {
                        $('#symptoms').val(function (index, currentValue) {
                            return currentValue + fulfilmentText + '\n';
                        });
                    }
                }else{
                    Swal.fire({
                    position: "center",
                    icon: "error",
                    title: fulfilmentText,
                    showConfirmButton: false,
                    timer: 3000
                    });
                }
            }).catch(error => { })
            
            $(this).val('');
        }
    });

    $(document).on('click', '#example', function (e) {
        e.preventDefault(); 
        $('#prompt').val('My temperature feels way above normal.')
    });

    function postRequest(dataSet, url, token) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: {
                    data: dataSet
                },
                success: function (data) {
                    resolve(data)
                },
                error: function (error) {
                    reject(error)
                },
            })
        })
    }
</script>
@endpush
@endsection