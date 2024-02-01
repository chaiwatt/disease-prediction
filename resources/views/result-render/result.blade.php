<div class="cs_height_100 cs_height_xl_145 cs_height_lg_105"></div>
<div class="container">
    <div class="cs_section_heading cs_style_1 text-center">
        <h3 class="cs_section_subtitle text-uppercase cs_accent_color cs_semibold m-0 cs_accent_color cs_fs_32">
            There are</h3>
        <div class="cs_height_5"></div>
        <h2 class="cs_section_title cs_fs_72 m-0">{{$allDiseaseWithSymptoms->count()}} related found</h2>
    </div>
    <div class="cs_height_72 cs_height_lg_50"></div>
    @if ($allDiseaseWithSymptoms->count() == 0)
    <div class="row">
        <div class="col-lg-8 offset-lg-2" style="text-align: center">
            <div class="cs_accordians cs_style1 cs_heading_color" style="text-align: center">
                <button class="cs_btn cs_style_1" id="ask-ai">
                    <span>Ask AI</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="cs_accordians cs_style1 cs_heading_color">
                @foreach ($allDiseaseWithSymptoms as $key => $disease)
                <div class="cs_accordian active">
                    <h2 class="cs_accordian_head cs_heading_color">
                        {{$disease->name}}
                    </h2>
                    <div class="cs_accordian_body">
                        <p>{{$disease->description}}<a href="{{$disease->url}}" target="blank">More
                                Info</a> </p>
                        <button class="cs_btn cs_style_1 mt-3">
                            <span>More Info</span>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>