function zoom(event) {
    const p = calculateZoomOverlay(
        { x: event.pageX, y: event.pageY },
        $(event.target)
    );
    moveCursorOverlay(p.left, p.top);
    movePreviewBackground(p.offsetX, p.offsetY);
}

function calculateZoomOverlay(mouse, thumb) {
    let t = thumb.position();
    t.width = thumb.width();
    t.height = thumb.height();

    let z = {}; // Zoom overlay
    z.width = t.width / ZOOM_LEVEL;
    z.height = t.height / ZOOM_LEVEL;
    z.top = mouse.y - z.height / 2;
    z.left = mouse.x - z.width / 2;

    // Bounce off boundary
    if (z.top < t.top) z.top = t.top;
    if (z.left < t.left) z.left = t.left;
    if (z.top + z.height > t.top + t.height)
        z.top = t.top + t.height - z.height;
    if (z.left + z.width > t.left + t.width)
        z.left = t.left + t.width - z.width;

    z.offsetX = ((z.left - t.left) / z.width) * 100;
    z.offsetY = ((z.top - t.top) / z.height) * 100;

    return z;
}

function moveCursorOverlay(left, top) {
    $(".cursor-overlay").css({
        top: top,
        left: left,
    });
}

function movePreviewBackground(offsetX, offsetY) {
    $(".preview").css({
        "background-position": offsetX + "% " + offsetY + "%",
    });
}

function enter() {
    // Setup preview image
    const imageUrl = $(this).attr("src");
    const backgroundWidth = $(".preview").width() * ZOOM_LEVEL;
    $(".preview").css({
        "background-image": `url(${imageUrl})`,
        "background-size": `${backgroundWidth} auto`,
    });
    $(".preview").show();

    $(".cursor-overlay").width($(this).width() / ZOOM_LEVEL);
    $(".cursor-overlay").height($(this).height() / ZOOM_LEVEL);
    $(".cursor-overlay").show();
}

function leave() {
    $(".preview").hide();
    $(".cursor-overlay").hide();
}

jQuery(document).ready(function ($) {
    $(".sliders-owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        smartSpeed: 1000,
        autoplay: true,
        autoplayTimeout: 7000,
        navText: ["", ""],
        responsive: {
            0: {
                items: 1,
            },
        },
    });

    $(".product_details-owl-carousel").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,

        autoplay: false,
        dots: false,
        navText: [
            "<i class ='fa fa-chevron-left'> </i>",
            "<i class ='fa fa-chevron-right'> </i>",
        ],
        responsive: {
            0: {
                items: 1,
            },
        },
    });

    $(".categories-owl-carousel").owlCarousel({
        loop: true,

        nav: true,
        smartSpeed: 600,

        autoplay: true,
        autoplayTimeout: 3000,

        navText: ["", ""],

        responsive: {
            0: {
                items: 2,
                margin: 20,
            },

            768: {
                margin: 20,
                items: 3,
            },

            992: {
                margin: 40,
                items: 4,
            },
        },
    });

    $(".deals-owl-carousel").owlCarousel({
        loop: true,

        // nav: true,
        smartSpeed: 600,

        autoplay: true,
        autoplayTimeout: 5000,

        // navText: ["", ""],

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
            download: true,
        },
    });

    // light gallery  +++++++++++

    $(".shop-filter-menus-dropdown-toggle").click(function () {
        //
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
            nav: true,
            autoplay: false,
            dots: true,
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
            items: 4,
            smartSpeed: 1000,
            nav: true,
            autoplay: false,
            dots: true,
            loop: true,
            responsiveRefreshRate: 200,
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

    //  product details section +++++++++++++++++++++++++++

    setTimeout(() => {
        $(".zomm-image").zoom({
            magnify: 1.5,
        });
    }, 100);

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
