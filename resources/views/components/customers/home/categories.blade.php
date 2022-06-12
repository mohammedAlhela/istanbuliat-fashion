<div class="categories-section">


    <div class="categories-owl-carousel owl-carousel owl-theme" >
        @foreach ($categories as $key => $category)
            <a  href = "{{ route('customers-shop', ['category' =>  getQueryString($category->name) ,]) }}" class="category-block">
                <div class="image-container"> <img src="{{ $category->image }}" alt="">       </div>    <div class="category-name">
                    {{$category->name}}  
                </div>
            </a>
        @endforeach
    </div>
</div>
