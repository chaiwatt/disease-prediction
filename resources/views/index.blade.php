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
                    <h3
                        class="cs_section_subtitle text-uppercase cs_accent_color cs_semibold m-0 cs_accent_color cs_fs_32">
                        Descripe your symptoms</h3>
                    <!-- <div class="cs_height_5"></div> -->
                    <span class="mt-4">To help our disease prediction system accurately analyze your symptoms,
                        please be as specific as possible with each
                        symptom, listing one per line for best results, <a href="#" id="example">click for
                            example.</a></span>
                    <div class="cs_height_20 cs_height_lg_50"></div>

                    <div class="col-lg-12">
                        <input type="text" id="prompt" class="cs_form_field"
                            placeholder="Describe single symptom here then press enter to add to list.">
                        <div class="cs_height_42 cs_height_xl_25"></div>
                    </div>

                    <div class="col-lg-12">
                        <textarea id="symptoms" cols="30" rows="12" class="cs_form_field" id="symptoms"
                            readonly></textarea>
                        <div class="cs_height_42 cs_height_xl_25"></div>
                    </div>

                    <div class="col-lg-12">
                        <div class="cs_height_18"></div>
                        <button class="cs_btn cs_style_1" id="checkup">
                            <span>Checkup</span>
                            <i>
                                <img src="assets/img/icons/arrow_white.svg" alt="Icon">
                                <img src="assets/img/icons/arrow_white.svg" alt="Icon">
                            </i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-5 offset-lg-1 text-center">
                <img src="assets/img/home_1/appointment.jpg" alt="Appointment" class="cs_radius_30">
            </div>
        </div>
    </div>
</section>

<section id="result-area-wrapper">

</section>
<!-- End FAQ Section -->
<!-- Start Brands -->

@push('scripts')

<script>
    window.params = {
        textDetectionRoute: '{{ route('processing.text-detection') }}',
        diseaseMatchingRoute: '{{ route('processing.disease-matching') }}',
        
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
                console.log(response);
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

    $(document).on('click', '#checkup', function (e) {
        e.preventDefault();

        var token = window.params.token
        var diseaseMatchingRoute = window.params.diseaseMatchingRoute
        
        var symptoms = $('#symptoms').val() || null;

        if (symptoms === null) {
            Swal.fire(
                'Wrong',
                'Training phrase cannot be empty.',
                'warning'
            )
            return
        }
        
        
        if (symptoms !== null) {
            var symptomsArray = symptoms.split('\n').filter(function(symptom) {
                return symptom.trim() !== ''; // กรองค่าว่างทิ้ง
            });
        } 
            
        var data = {
            'symptoms': symptomsArray,
        }

        postRequest(data, diseaseMatchingRoute, token).then(response => {
            // console.log(response);
            $('#result-area-wrapper').html(response);
               
        }).catch(error => { })
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