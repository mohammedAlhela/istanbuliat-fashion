

jQuery(document).ready(function ($) {
    $(".sliders-owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        smartSpeed: 1000,
        autoplay: true,
        autoplayTimeout: 8000,
        navText: ["", ""],
        responsive: {
            0: {
                items: 1,
            },
        },
    });


    $(".categories-owl-carousel").owlCarousel({
        smartSpeed: 600,
        loop: false,
        navText: [
            "<i class ='fa fa-chevron-left'> </i>",
            "<i class ='fa fa-chevron-right'> </i>",
        ],
        responsive: {
            0: {
                margin: 10,
                items: 2,
            },

            700: {
                margin: 20,
                items: 3,
            },

            992: {
                margin: 20,
                items: 4,
            },
        },
    });

    $(".deals-owl-carousel").owlCarousel({  nav: true,
        
        smartSpeed: 600,
        loop: false,
        navText: [
            "<i class ='fa fa-chevron-left'> </i>",
            "<i class ='fa fa-chevron-right'> </i>",
        ],
        responsive: {
            0: {
                margin: 10,
                items: 2,
            },

            700: {
                margin: 20,
                items: 3,
            },

            992: {
                margin: 20,
                items: 4,
            },
        },
    });

    $("#play_vedio_button").on("click", function () {
        $("#vedio_fashion_section").css("opacity", "1");
        $("#vedio_cover").css("background-image", "url(" + "" + ")");

        $("#play_vedio_icon").toggleClass("fa-pause");
        if ($("#play_vedio_icon").hasClass("fa-pause")) {
            $("#vedio_fashion_section")[0].play();
        } else {
            $("#vedio_fashion_section")[0].pause();
        }
    });

    // sticky navbar +++++++++++
    var stickyNavTop = $(".sticky-navbar").offset().top;
    var stickyNav = function () {
        var scrollTop = $(window).scrollTop();
        if (scrollTop > stickyNavTop) {
            $(".sticky-navbar").addClass("sticky");
        } else {
            $(".sticky-navbar").removeClass("sticky");
        }
    };
    stickyNav();
    $(window).scroll(function () {
        stickyNav();
    });
    // sticky navbar +++++++++++

    // light gallery  +++++++++++
    lightGallery(document.getElementById("share_gallery"), {
        download: false,
        share: false,
        mobileSettings: {
            controls: true,
            showCloseIcon: true,
            download: false,
        },
    });

    // light gallery  +++++++++++

    $(".shop-filter-menus-dropdown-toggle").click(function () {
        $(".shop-filter-menus-dropdown-toggle").removeClass('active')
       $(this).addClass('active')
        if ($(this).next(".shop-filter-menu").css("display") == "none") {
            $(".shop-filter-menu").fadeOut(10);
            $(this).next(".shop-filter-menu").fadeIn(300);
        } else {
            $(this).next(".shop-filter-menu").fadeOut(10);
        }
    });

    $(".close-menu-span").click(function () {
        $(this).parent().parent().fadeToggle(10);
    });

    $(document).click(function (e) {
        var target = e.target;

        let parentsBlocks = Array.from($(target).parents());

        let oneParentIsTheMenu = false;
        parentsBlocks.forEach((item) => {
            item.classList.contains("shop-filter-menu")
                ? (oneParentIsTheMenu = true)
                : false;
        });

        if (
            !$(target).hasClass("shop-filter-menu") &&
            !oneParentIsTheMenu &&
            !$(target).hasClass("shop-filter-menus-dropdown-toggle") &&
            !$(target).hasClass("toggle-menu-icon")
        ) {
            $(".shop-filter-menu").fadeOut(10);

            
    $(".shop-filter-menus-dropdown-toggle").removeClass('active')


            
        }
    });

    // product details slider

    var sync1 = $("#product_details_preview_image_slider");
    var sync2 = $("#product_details_thumb_image_slider");
    var slidesPerPage = 4; //globaly define number of elements per page
    var syncedSecondary = true;



        sync1
        .owlCarousel({
            items: 1,
            smartSpeed: 1000,
            dots: false,
            nav: false,
            autoplay: false,
         
            loop: true,
            responsiveRefreshRate: 200,
            navText: [
                '<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
                '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>',
            ],
        })
          .on("changed.owl.carousel", syncPosition);
  


    sync2
        .on("initialized.owl.carousel", function () {
            sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: slidesPerPage,
            dots: false,
            nav: true,
            margin: 10,
            smartSpeed: 1000,
            slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
            responsiveRefreshRate: 100,
            navText: [
                '<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
                '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>',
            ],
        })
         .on("changed.owl.carousel", syncPosition2);

    function syncPosition(el) {
        //if you set loop to false, you have to restore this next line
        //var current = el.item.index;

        //if you disable loop you have to comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }

        //end block

        sync2
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync2.find(".owl-item.active").length - 1;
        var start = sync2.find(".owl-item.active").first().index();
        var end = sync2.find(".owl-item.active").last().index();

        if (current > end) {
            sync2.data("owl.carousel").to(current, 300, true);
        }
        if (current < start) {
            sync2.data("owl.carousel").to(current - onscreen, 300, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data("owl.carousel").to(number, 300, true);
        }
    }

    sync2.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data("owl.carousel").to(number, 300, true);
    });

    // product details section +++++++++++++++++++++++++++

    if(window.innerWidth >= 650) { 
        setTimeout(() => {
            $(".zomm-image").zoom({
                magnify: 1.5,
            });
        }, 100);
    }


    $("#product_details_toggle_details_button").on("click", function () {
        $element = $(this);
        $element.next().toggleClass("fa-plus").toggleClass("fa-minus");
        $element.toggleClass("main-color");

 
    });

    $("#product_details_toggle_details_icon").on("click", function () {
        $element = $(this);
        $element.toggleClass("fa-plus").toggleClass("fa-minus");
        $element.prev().toggleClass("main-color");
    });

    $("#product_details_toggle_contents_button").on("click", function () {
        $element = $(this);
        $element.next().toggleClass("fa-plus").toggleClass("fa-minus");
        $element.toggleClass("main-color");

 
    });

    $("#product_details_toggle_contents_icon").on("click", function () {
        $element = $(this);
        $element.toggleClass("fa-plus").toggleClass("fa-minus");
        $element.prev().toggleClass("main-color");
    });

    $("#product_details_toggle_return_button").on("click", function () {
        $element = $(this);
        $element.next().toggleClass("fa-plus").toggleClass("fa-minus");
        $element.toggleClass("main-color");

 
    });

    $("#product_details_toggle_return_icon").on("click", function () {
        $element = $(this);
        $element.toggleClass("fa-plus").toggleClass("fa-minus");
        $element.prev().toggleClass("main-color");
    });

    //  product details section +++++++++++++++++++++++++++
});
