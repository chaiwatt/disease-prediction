@extends('layouts.landing')

@section('content')

<!-- Start Appointment Section -->
<section class="cs_shape_wrap" id="appointment">

    <div class="cs_height_190 cs_height_xl_145 cs_height_lg_105"></div>
    <div class="container">
        <div class="row align-items-center cs_gap_y_40">

            <div class="row">
                <div class="col-lg-3">
                    @include('dashboard.partial.sidebar')
                </div>
                <div class="col-lg-9">
                    <h2>API Link</h2>
                    <div class="cs_blog_details mt-4">
                        <table class="table" style="padding: 28px 20px;line-height:50px">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 50%">Detail</th>
                                    <th>Email</th>
                                    <th style="text-align: right">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Dialogflow</td>
                                    <td>pg516944@gmail.com</td>
                                    <td style="text-align: right"><a class="btn btn-sm btn-primary"
                                            href="https://dialogflow.cloud.google.com/#/agent/disease-prediction-413503/intents"
                                            target="_blank">Open</a></td>
                                </tr>
                                <tr>
                                    <td>Google Dev Console</td>
                                    <td>pg516944@gmail.com</td>
                                    <td style="text-align: right"><a class="btn btn-sm btn-primary"
                                            href="https://console.cloud.google.com/apis/dashboard?authuser=1&project=disease-prediction-413503"
                                            target="_blank">Open</a></td>
                                </tr>
                                <tr>
                                    <td>Googel Gemini</td>
                                    <td>pg516944@gmail.com</td>
                                    <td style="text-align: right"><a class="btn btn-sm btn-primary"
                                            href="https://makersuite.google.com/app" target="_blank">Open</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(function () {
        $('.select2').select2()
        window.params = {
            assignSymptomRoute: '{{ route('dashboard.assign') }}',
            url: '{{ url('/') }}',
            token: $('meta[name="csrf-token"]').attr('content')
        };

        $(document).on('click', '#btn-add', function (e) {
            e.preventDefault();
            var token = window.params.token
            var assignSymptomRoute = window.params.assignSymptomRoute
            
            var diseaseId = $('#disease-id').val();
            var symptom = $('#symptom').val() || null;

            console.log(symptom);

            if (symptom === null) {
                Swal.fire(
                    'Wrong',
                    'Please select valid symptom.',
                    'warning'
                )
                return
            }
            
            var data = {
                'diseaseId': diseaseId,
                'symptom': symptom,
            }

            postRequest(data, assignSymptomRoute, token).then(response => {
                location.reload();
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
    });
</script>
@endpush

@endsection