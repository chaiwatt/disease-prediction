@extends('layouts.landing')
@push('styles')
<style>
    .spinner,
    .spinner1 {
        animation: spin 1s linear infinite;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
@endpush
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
                                    type="button btn-sm" class="btn btn-info text-white" id="show_modal"> AI
                                    guideline</a></label>
                            <textarea class="form-control" id="phrase" rows="15"></textarea>
                        </div>
                    </div>
                    <a type="button" class="btn btn-secondary" id="btn-clear">Clear</a>
                    <a type="button" class="btn btn-primary" style="float: right" id="btn-add"><i
                            class="fa-solid fa-spinner spinner1"></i> Add</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="genPhraseModal" tabindex="-1" aria-labelledby="genPhraseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="genPhraseModalLabel">AI Guideline</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="phrase" class="form-label">AI Prompt</label>
                        <textarea class="form-control" id="prompt" rows="7"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="generate-phrase"><i
                            class="fa-solid fa-spinner spinner"></i> Generate</button>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(".spinner").hide();
    $(".spinner1").hide();
    window.params = {
        storeSymptomRoute: '{{ route('dashboard.symptom.store') }}',
        genPhraseRoute: '{{ route('dashboard.symptom.gen-phrase') }}',
        url: '{{ url('/') }}',
        token: $('meta[name="csrf-token"]').attr('content')
    };

    $(document).on('click', '#show_modal', function (e) {
        e.preventDefault();
        var symptom = $('#symptom').val() || null;
          if (symptom === null) {
            Swal.fire(
                'Wrong',
                'Symptom cannot be empty.',
                'warning'
            )
            return
        }

        // var prompt = `Create an array of 15 ${symptom} sentences for Dialogflow training phrases by using this sentence "I have a ${symptom}" or similar as guidline. Then end with \\n of each sentence like this: sentence1\\n sentence2\\n sentence3\\n ... and do not add sentence numbers before each sentence.`;
        var prompt = `Create an array of 15 ${symptom} sentences for Dialogflow training phrases by using this sentence "I have a ${symptom}" or similar as guidline. Then list down line by line for each sentence like this: sentence1\\n sentence2\\n sentence3\\n ... and do not add sentence numbers before each sentence.`;
        $('#prompt').val(prompt);
        $('#genPhraseModal').modal('show');

    });

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

        var spinner = $(this).find('.spinner1');
            // แสดง Spinner
            spinner.show();

        postRequest(data, storeSymptomRoute, token).then(response => {
            spinner.hide();
             Swal.fire(
                'Done',
                'Symtomps successful created',
                'success'
            ).then(() => {
                location.reload();
            });
        }).catch(error => { })

    });

    $(document).on('click', '#generate-phrase', function (e) {
        e.preventDefault();
        var token = window.params.token
        var genPhraseRoute = window.params.genPhraseRoute
        
        var prompt = $('#prompt').val() || null;

        if (prompt === null) {
            Swal.fire(
                'Wrong',
                'Prompt cannot be empty.',
                'warning'
            )
            return
        }
        var spinner = $(this).find('.spinner');
        // แสดง Spinner
        spinner.show();
        var data = {
            'prompt': prompt
        }

        postRequest(data, genPhraseRoute, token).then(response => {
            // var response = response.replace(/\n\n/g, '\n');
            console.log(response);
            $('#genPhraseModal').modal('hide');
            var symptom = $('#symptom').val();
            var prompt = `${symptom}.\n${response} `;

             $('#phrase').val(prompt);
             spinner.hide();
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