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

                    <h2>Add Symptom</h2>
                    <div class="cs_blog_details mt-4">

                        <div class="mb-3">
                            <label for="symptom" class="form-label">Symptom</label>
                            <input type="text" class="form-control" id="symptom">
                        </div>
                        <div class="mb-3">
                            <label for="phrase" class="form-label">Training phrase (One per line) <a
                                    type="button btn-sm" class="btn btn-info text-white" id="btn-ai-guideline">AI
                                    guideline</a></label>
                            <textarea class="form-control" id="phrase" rows="15"></textarea>
                        </div>
                    </div>
                    <a type="button" class="btn btn-secondary" id="btn-clear">Clear</a>
                    <a type="button" class="btn btn-primary" style="float: right" id="btn-add">Add</a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    window.params = {
        storeSymptomRoute: '{{ route('dashboard.symptom.store') }}',
        genPhraseRoute: '{{ route('dashboard.symptom.gen-phrase') }}',
        url: '{{ url('/') }}',
        token: $('meta[name="csrf-token"]').attr('content')
    };

    $(document).on('click', '#btn-add', function (e) {
        e.preventDefault();
        var token = window.params.token
        var storeSymptomRoute = window.params.storeSymptomRoute
        
        var symptom = $('#symptom').val() || null;
        var phrase = $('#phrase').val() || null;

        if (symptom === null) {
            Swal.fire(
                'Wrong',
                'Symptom cannot be empty.',
                'warning'
            )
            return
        }
        if (phrase === null) {
            Swal.fire(
                'Wrong',
                'Training phrase cannot be empty.',
                'warning'
            )
        return
        }
        
        var phrases = phrase.split('\n');
        
        var data = {
            'symptom': symptom,
            'phrases': phrases,
        }

        postRequest(data, storeSymptomRoute, token).then(response => {
             Swal.fire(
                'Done',
                'Symtomps successful created',
                'success'
            ).then(() => {
                location.reload();
            });
        }).catch(error => { })

    });

    $(document).on('click', '#btn-ai-guideline', function (e) {
        e.preventDefault();
        var token = window.params.token
        var genPhraseRoute = window.params.genPhraseRoute
        
        var symptom = $('#symptom').val() || null;

        if (symptom === null) {
            Swal.fire(
                'Wrong',
                'Symptom cannot be empty.',
                'warning'
            )
            return
        }
        
        var data = {
            'symptom': symptom,
        }

        postRequest(data, genPhraseRoute, token).then(response => {
             $('#phrase').val(response);
        }).catch(error => { })

    });

    $(document).on('click', '#btn-clear', function (e) {
        e.preventDefault();
       $('#symptom').val('');
       $('#phrase').val('');
        
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