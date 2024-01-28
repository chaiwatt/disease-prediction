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
                        data-bs-target="#exampleModal">Add</button>
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
                                        {{-- <a type="button" class="btn btn-primary">Edit</a> --}}
                                        <a href="{{route('dashboard.engage',['id' => $disease->id])}}"
                                            class="btn btn-primary">Engage</a>
                                        <a href="{{route('delete-disease',['id' => $disease->id])}}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                {{-- <tr>
                                    <th scope="row">1</th>
                                    <td>Fever</td>
                                    <td style="text-align: center">5</td>
                                    <td style="text-align: right">
                                        <a type="button" class="btn btn-primary">Edit</a>
                                        <a type="button" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr> --}}

                            </tbody>
                        </table>



                    </div>


                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add desease</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="symdiseaseptom" class="form-label">Disease</label>
                        <input type="text" class="form-control" id="disease">
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary" id="btn-save">Save</button>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    window.params = {
        storeDiseaseRoute: '{{ route('store-disease') }}',
        url: '{{ url('/') }}',
        token: $('meta[name="csrf-token"]').attr('content')
    };
    $(document).on('click', '#btn-save', function (e) {
        e.preventDefault();
        var token = window.params.token
        var storeDiseaseRoute = window.params.storeDiseaseRoute
        
        var disease = $('#disease').val() || null;

        if (disease === null) {
            return
        }
        
        var data = {
            'disease': disease,
        }

        postRequest(data, storeDiseaseRoute, token).then(response => {
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
</script>
@endpush

@endsection