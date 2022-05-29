<div class="links-section" id = 'navbar_links_section'>
    <div class="holder">


    <div class="links" id = "navbar_links_holder">
        @foreach ($categories as $item)
            <a class =""  href = "{{ route('customers-shop', ['category' =>  getQueryString($item->name) ,]) }}">
                {{ $item->name }}
            </a>
        @endforeach
    </div>     </div>
</div>
