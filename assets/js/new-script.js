$(document).ready(function(){var e=$("#menu"),o=$("body");e.wrapInner('<div class="inner"></div>'),e._locked=!1,e._lock=function(){return!e._locked&&(e._locked=!0,window.setTimeout(function(){e._locked=!1},350),!0)},e._show=function(){e._lock()&&o.addClass("is-menu-visible")},e._hide=function(){e._lock()&&o.removeClass("is-menu-visible")},e._toggle=function(){e._lock()&&o.toggleClass("is-menu-visible")},e.appendTo(o).on("click",function(e){e.stopPropagation()}).on("click","a",function(o){var n=$(this).attr("href");o.preventDefault(),o.stopPropagation(),e._hide(),"#menu"!=n&&window.setTimeout(function(){window.location.href=n},350)}).append('<a class="close" href="#menu">Close</a>'),o.on("click",'a[href="#menu"]',function(o){o.stopPropagation(),o.preventDefault(),e._toggle()}).on("click",function(o){e._hide()}).on("keydown",function(o){27==o.keyCode&&e._hide()}),$("#testimonial").owlCarousel({items:1,loop:!0,autoplay:!0,navText:["<i class='fa fa-angle-right'></i>","<i class='fa fa-angle-left'></i>"],center:!0,margin:0,nav:!0,dots:!1,autoHeight:!0}),$("#header_slide").owlCarousel({items:1,loop:!0,autoplay:!0})}),$(".inline-popup").magnificPopup({type:"inline",midClick:!0,gallery:{enabled:!0}});