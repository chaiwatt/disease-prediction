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
                    <h2>Symptom Engangement: {{$disease->name}}</h2>
                    <input type="text" id="disease-id" value="{{$disease->id}}" hidden>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select id="symptom" class="form-control select2 " style="width: 100%">
                                    <option value="{{null}}">==select==</option>
                                    @foreach ($symptoms as $symptom)
                                    <option value="{{ $symptom->id }}">
                                        {{ $symptom->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" style="float: right"
                                    id="btn-add">Add</button>
                            </div>
                        </div>
                    </div>
                    <div class="cs_blog_details mt-4">
                        <table class="table" style="padding: 28px 20px;line-height:50px">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 15%">#</th>
                                    <th>Symptom Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($disease->symptoms as $key => $symptom)
                                <tr>
                                    <th>{{$key + 1}}</th>
                                    <td>{{$symptom->name}}</td>
                                </tr>
                                @endforeach
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