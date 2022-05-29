<div class="subscribe-section">
    <div class="content-holder">
        <div class="header"> Subscribe </div>
        <div class="text"> Subscribe to the Select Fashion newsletter to receive exclusive content, offers
            offers, discounts and many special promotions. </div>


        <div class="subscribe-form">


            <form method="post" action="{{ route('subscriber.add') }}" autocomplete="false">
                @csrf
                <input autocomplete="false" name="hidden" type="text" class="d-none">
                <input type="email" name="email" class="form-controll" placeholder="Your email here" required="true" />
                <button class=" subscribe-button" type="submit"> <i class="fa fa-paper-plane" aria-hidden="true"></i>
                </button>
            </form>

        </div>


    </div>
</div>
