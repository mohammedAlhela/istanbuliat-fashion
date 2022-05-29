

            <div class="navigation-section">
                <div class="navigation-block" >
               <a href="/orders">    <span class="navigation-link"> my Orders</span> <span class="items-number">0</span> </a>
                </div>

                <div class="navigation-block">
                    <a href="/wishlist" class="navigation-link"> <span class="navigation-link"> my Wishlist</span> <span
                            class="items-number">2</span> </a>
                </div>

                <div class="navigation-block" >
                  <a href="/address"><span class="navigation-link"> Address</span> </a>
                </div>

                <div class="navigation-block" >
               <a href="/account"> <span class="navigation-link">Account</span></a>
                </div>

                <div class="navigation-block">
                    <form class="d-inline-block" id="account_page_logout" method="post" action="{{ route('logout') }}">
                        @csrf
                        <a href="javascript:{}" class="logout-link"
                            onclick="document.getElementById('account_page_logout').submit();">Sign out</a>
                    </form>
                </div>

            </div>







