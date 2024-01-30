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
                    <h2>Diseases</h2>
                    <button href="" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addDiseaseModal">Add</button>
                    <div class="cs_blog_details mt-4">

                        <table class="table" style="padding: 28px 20px;line-height:50px">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 40%">Name</th>
                                    <th style="text-align: center">Num of symptoms</th>
                                    <th style="text-align: right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($diseases as $key => $disease)
                                <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>{{$disease->name}}</td>
                                    <td style="text-align: center">{{$disease->symptoms->count()}}</td>
                                    <td style="text-align: right">
                                        <a type="button" class="btn btn-info text-white" id="show-edit-modal"
                                            data-id="{{$disease->id}}">Edit</a>
                                        <a href="{{route('dashboard.engage',['id' => $disease->id])}}"
                                            class="btn btn-primary">Engage</a>
                                        <a href="{{route('delete-disease',['id' => $disease->id])}}"
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
    <!-- Modal -->
    <div class="modal fade" id="addDiseaseModal" tabindex="-1" aria-labelledby="addDiseaseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDiseaseModalLabel">Add desease</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="symdiseaseptom" class="form-label">Disease</label>
                        <input type="text" class="form-control" id="disease">
                    </div>
                    <div class="mb-3">
                        <label for="phrase" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="symdiseaseptom" class="form-label">Url</label>
                        <input type="text" class="form-control" id="url">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editDiseaseModal" tabindex="-1" aria-labelledby="editDiseaseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDiseaseModalLabel">Edit desease</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="symdiseaseptom" class="form-label">Disease</label>
                        <input type="text" class="form-control" id="disease-edit">
                    </div>
                    <div class="mb-3">
                        <label for="phrase" class="form-label">Description</label>
                        <textarea class="form-control" id="description-edit" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="symdiseaseptom" class="form-label">Url</label>
                        <input type="text" class="form-control" id="url-edit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-edit">Save</button>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    var editDiseaseId;
    window.params = {
        storeDiseaseRoute: '{{ route('store-disease') }}',
        getDiseaseRoute: '{{ route('get-disease') }}',
        updateDiseaseRoute: '{{ route('update-disease') }}',
        url: '{{ url('/') }}',
        token: $('meta[name="csrf-token"]').attr('content')
    };
    $(document).on('click', '#btn-save', function (e) {
        e.preventDefault();
        var token = window.params.token
        var storeDiseaseRoute = window.params.storeDiseaseRoute
        
        var disease = $('#disease').val() || null;
        var description = $('#description').val() || null;
        var url = $('#url').val() || null;

        if (disease === null || disease === null || url === null) {
            return
        }
        
        var data = {
            'disease': disease,
            'description': description,
            'url': url,
        }

        postRequest(data, storeDiseaseRoute, token).then(response => {
            location.reload();
        }).catch(error => { })

    });

    $(document).on('click', '#show-edit-modal', function (e) {
        e.preventDefault();
        var token = window.params.token
        var getDiseaseRoute = window.params.getDiseaseRoute
        var diseaseId = $(this).data('id');
        
        var data = {
            'diseaseId': diseaseId
        }

        postRequest(data, getDiseaseRoute, token).then(response => {
            console.log(response)
            editDiseaseId = response.id;
            $('#disease-edit').val(response.name);
            $('#description-edit').val(response.description);
            $('#url-edit').val(response.url);
            $('#editDiseaseModal').modal('show');

        }).catch(error => { })

    });

    $(document).on('click', '#btn-edit', function (e) {
        e.preventDefault();
        var token = window.params.token
        var updateDiseaseRoute = window.params.updateDiseaseRoute
        var disease = $('#disease-edit').val() || null;
        var description = $('#description-edit').val() || null;
        var url = $('#url-edit').val() || null;

        if (disease === null || disease === null || url === null) {
            return
        }
        
        var data = {
            'diseaseId':editDiseaseId,
            'disease': disease,
            'description': description,
            'url': url,
        }

        postRequest(data, updateDiseaseRoute, token).then(response => {
            $('#editDiseaseModal').modal('hide');
            
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