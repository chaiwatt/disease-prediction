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
</section>



@endsection