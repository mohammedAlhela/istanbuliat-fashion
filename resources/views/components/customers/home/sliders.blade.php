<div class = "sliders-section">
    <div class="sliders-owl-carousel owl-carousel owl-theme" id = "big-screen-sliders">
     @foreach($sliders as $key=>$slider)
        <a  class = "slider-block" href="{{ route('customers-shop', ['type' =>  getQueryString($slider->link) ,]) }}"> <img src="{{ $slider->big_image }}" alt=""> </a>
     @endforeach
    </div>

    <div class="sliders-owl-carousel owl-carousel owl-theme" id = "small-screen-sliders">
        @foreach($sliders as $key=>$slider)
        <a href="{{ route('customers-shop', ['type' =>  getQueryString($slider->link) ,]) }}">  <img src="{{ $slider->small_image }}" alt=""> </a>
        @endforeach
       </div>
</div>
