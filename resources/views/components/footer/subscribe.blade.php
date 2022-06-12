<div class="subscribe-section">
    <div class="holder row ">

 
 
        <div class="content-section col-12 col-md-6 p-0">
            <div class="header text-left"> Subscribe </div>
            <div class="paragraph"> Subscribe to the Select Fashion newsletter to receive exclusive content, offers
                offers, discounts and many special promotions. </div>
        </div>
        <div class="subscribe-form col-12 col-md-6">
            <span class = "paragraph"> Email Address *</span>
            <form method="post" action="{{ route('subscriber.add') }}" autocomplete="false">
                @csrf
                <input autocomplete="false" name="hidden" type="text" class="d-none">
              
                <input type="email" name="email" class="form-controll"required="true" />
                 <button class=" subscribe-button" type="submit"> Send
                </button> 
            </form>
        </div>
      
      </div>
</div>
