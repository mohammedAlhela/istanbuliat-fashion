<div class="links-section" id='navbar_links_section'>
    <div class="holder">


        <div class="links" id="navbar_links_holder">

            <a href="/">
                Home
            </a>

            <a href="/shop">
                All collections
            </a>


            
            @foreach ($categories as $item)
    
                <a href="{{ route('customers-shop', ['category' => getQueryString($item->name)]) }}">
                    {{ $item->name }}
                </a>
            @endforeach

        </div>

        <div class="clearing"></div>
    </div>
</div>
