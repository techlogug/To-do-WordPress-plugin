jQuery(document).ready(function ($) {
  /** Variables from Customizer for Slider settings */
  var slider_auto, slider_loop, slider_control, slider_animation, rtl, mrtl;

  if (kalon_data.auto == "1") {
    slider_auto = true;
  } else {
    slider_auto = false;
  }

  if (kalon_data.loop == "1") {
    slider_loop = true;
  } else {
    slider_loop = false;
  }

  if (kalon_data.control == "1") {
    slider_control = true;
  } else {
    slider_control = false;
  }

  if (kalon_data.mode == "slide") {
    slider_animation = "";
  } else {
    slider_animation = "fadeOut";
  }

  if (kalon_data.rtl == "1") {
    rtl = true;
    mrtl = false;
  } else {
    rtl = false;
    mrtl = true;
  }

  /** Home Page Slider */
  $("#lightSlider").owlCarousel({
    items: 1,
    margin: 0,
    loop: slider_loop,
    autoplay: slider_auto,
    nav: false,
    dots: slider_control,
    animateOut: slider_animation,
    lazyLoad: true,
    mouseDrag: false,
    rtl: rtl,
    autoplaySpeed: kalon_data.speed,
  });

  //mobile-menu
  $(".btn-menu-opener").on("click", function () {
    $("body").addClass("menu-open");
  });

  $(".overlay").on("click", function () {
    $("body").removeClass("menu-open");
  });

  //Custom Js added
  $(".close").on("click", function () {
    $("body").toggleClass("menu-open");
  });

  $('<button class="angle-down"></button>').insertAfter(
    $(".mobile-menu ul .menu-item-has-children > a")
  );
  $(".mobile-menu ul li .angle-down").on("click", function () {
    $(this).next().slideToggle();
    $(this).toggleClass("active");
  });

  //accessible menu in IE
  $("#site-navigation ul li a")
    .on("focus", function () {
      $(this).parents("li").addClass("focus");
    })
    .on("blur", function () {
      $(this).parents("li").removeClass("focus");
    });

  var windowWidth = window.innerWidth;
  if (windowWidth >= 1025) {
    window.addEventListener("resize", function () {
      document.body.classList.remove("menu-open");
    });
  }

  //  heading line // 

  $(".wp-block-group__inner-container h2").wrapInner(
    "<span> </span>"
  );

  $(".wp-block-search__label").wrapInner(
    "<span> </span>"
  );

  // $(".block-editor-block-list__layout h2").wrapInner(
  //   "<span> </span>"
  // );
  



});
