<div class="slider-wrapper custom-container px-0">
    <div class="homeSlider slider-1 owl-carousel">
        @foreach ($slides as $slide)
        <div class="item" style="background: url({{ asset($slide->mobile_src) }});background-size:cover;background-repeat:no-repeat;">
            <div class="container slider-content">
                <div class="row">
                    <div class="col-12">
                        <div class="slider-text active">
                            <p class="slider-head">{!! $slide->title !!}</p>
                            <p>{!! $slide->text !!}</p>
                            @if($slide->btn_href && $slide->btn_name)
                            <div class="btn-wrapper">
                                <a href="{{$slide->btn_href}}" class="animated-btn">{{ $slide->btn_name }}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- Col End -->
                </div>
                <!-- Row End -->
            </div>
        </div>
        @endforeach
    </div>
    <div class="wefewfe">
        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
        <div class="wave wave4"></div>
    </div>
</div>