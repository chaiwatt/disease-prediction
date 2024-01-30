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
                    <h2>Symptoms</h2>
                    <a href="{{route('dashboard.symptom.create')}}" class="btn btn-primary">Add</a>
                    <div class="cs_blog_details mt-4">

                        <table class="table" style="padding: 28px 20px;line-height:50px">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 40%">Symptom</th>
                                    <th style="text-align: right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($symptoms as $key => $symptom)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$symptom->name}}</td>
                                    <td style="text-align: right">
                                        <a href="" id="view" data-id="{{$symptom->id}}" class="btn btn-primary">View</a>
                                        <a href="{{route('dashboard.symptom.delete',['id' => $symptom->id])}}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>



                    </div>


                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="trainingPhraseModal" tabindex="-1" aria-labelledby="trainingPhraseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trainingPhraseModalLabel">Training phrase</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Training phrase</th>
                            </tr>
                        </thead>
                        <tbody id="training_phrase_wrapper">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    window.params = {
        viewSymptomRoute: '{{ route('dashboard.symptom.view') }}',
        url: '{{ url('/') }}',
        token: $('meta[name="csrf-token"]').attr('content')
    };

    $(document).on('click', '#view', function (e) {
        e.preventDefault();
        var token = window.params.token
        var viewSymptomRoute = window.params.viewSymptomRoute
        
        var symptomId = $(this).data('id');

        var data = {
            'symptomId': symptomId
        }

        postRequest(data, viewSymptomRoute, token).then(response => {
            // console.log(response);
            const trainingPhraseWrapper = document.getElementById("training_phrase_wrapper");
            trainingPhraseWrapper.innerHTML = '';
            
            // วนลูปผ่าน response.message (array ของ training phrases)
            response.message.forEach((phrase, index) => {
                const row = document.createElement("tr");
            
                const indexCell = document.createElement("th");
                indexCell.textContent = index + 1;
        
                const phraseCell = document.createElement("td");
                phraseCell.textContent = phrase;
        
                row.appendChild(indexCell);
                row.appendChild(phraseCell);
        
                trainingPhraseWrapper.appendChild(row);
            });

        }).catch(error => { })

        $('#trainingPhraseModal').modal('show');

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