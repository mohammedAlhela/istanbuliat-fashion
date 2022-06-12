<div class="product-details-accordion" id="product_details_accordion">

@if($product->long_description)
    <div class="accordion-item">
        <div class="accordion-header" id="panelsStayOpen-headingOne">
            <button id="product_details_toggle_details_button" class="accordion-button main-color" type="button"
                data-toggle="collapse" href="#panelsStayOpen-collapseOne" aria-expanded="true"
                aria-controls="panelsStayOpen-collapseOne">
                Details
            </button>
            <i id="product_details_toggle_details_icon" class="fa fa-plus" data-toggle="collapse"
               href="#panelsStayOpen-collapseOne" aria-expanded="true"
                aria-controls="panelsStayOpen-collapseOne"></i>
            <div class="clearing"></div>
        </div>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
            aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
                <div class="long-description">
                {{ $product->long_description }}
                </div>
                @if($product->wash_care)
                <div class="care">
                    Care : <span class="paragraph"> {{ $product->wash_care }} </span>
                </div>
           @endif
            </div>
        </div>
    </div>
@endif


@if($product->contents)
    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button id="product_details_toggle_contents_button" class="accordion-button " type="button"
                data-toggle="collapse" href="#panelsStayOpen-collapseTwo" aria-expanded="false"
                aria-controls="panelsStayOpen-collapseTwo">
                Contents
            </button>
            <i id="product_details_toggle_contents_icon" class="fa fa-minus" data-toggle="collapse"
               href="#panelsStayOpen-collapseTwo" aria-expanded="false"
                aria-controls="panelsStayOpen-collapseTwo"></i>
        </h2>
        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
            aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">


                <ul class="contents-ul">
                    @foreach (explode(',', $product->contents) as $item)
                        <li>
                           {{ $item }}
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
    @endif



    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
            <button id="product_details_toggle_return_button" class="accordion-button" type="button"
                data-toggle="collapse" href="#panelsStayOpen-collapseThree" aria-expanded="false"
                aria-controls="panelsStayOpen-collapseThree">
                Shipping , Return
            </button>
            <i id="product_details_toggle_return_icon" class="fa fa-minus" data-toggle="collapse"
                href="#panelsStayOpen-collapseThree" aria-expanded="false"
                aria-controls="panelsStayOpen-collapseThree"></i>
        </h2>
        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
            aria-labelledby="panelsStayOpen-headingThree">
            <div class="accordion-body">






                <div class="measurements-size">
                    <ul>
                        <li>
                            shipping is free for orderes more than 300 AED
                        </li>

                        <li>
                            Most items will be available within 24 hours. We'll send you an email once your items are
                            ready for pick-up! Available.
                        </li>

                        <li>
                            Return received within 30 days from delivery
                        </li>

                        <li>
                            Return will lose 30 of the order amount
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


  

</div>
