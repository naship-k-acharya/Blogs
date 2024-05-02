<!DOCTYPE html>
<html lang="zxx">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<title>Blogging Category</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<meta name="keywords" content="Weblog a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

	<script>
		addEventListener(
        "load",
        function () {
          setTimeout(hideURLbar, 0);
        },
        false
      );

      function hideURLbar() {
        window.scrollTo(0, 1);
      }
	</script>

	<link href="{{ asset('frontend') }}/css/bootstrap.css" rel="stylesheet" />
	<link href="{{ asset('frontend') }}/css/jquery.desoslide.css" rel="stylesheet" />
	<link href="{{ asset('frontend') }}/css/style.css" rel="stylesheet" />
	<link href="{{ asset('frontend') }}/css/fontawesome-all.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
	<link
		href="http://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800"
		rel="stylesheet" />

		@stack('css')

</head>

<body>
	<!--Header-->
	@include('layouts.frontend.layouts.header')
	<!--//header-->

	@yield('main_content')

	<!---728x90--->
	<!--footer-->
	@include('layouts.frontend.layouts.footer')
	<!---->
	<!-- js -->
	<script src="{{ asset('frontend') }}/js/jquery-2.2.3.min.js"></script>
	<!-- //js -->
	<!-- desoslide-JavaScript -->
	<script src="{{ asset('frontend') }}/js/jquery.desoslide.js"></script>
	<script>
		$("#demo1_thumbs").desoSlide({
        main: {
          container: "#demo1_main_image",
          cssClass: "img-responsive",
        },
        effect: "sideFade",
        caption: true,
      });
	</script>

	<!-- requried-jsfiles-for owl -->
	<script>
		$(window).load(function () {
        $("#flexiselDemo1").flexisel({
          visibleItems: 3,
          animationSpeed: 1000,
          autoPlay: true,
          autoPlaySpeed: 3000,
          pauseOnHover: true,
          enableResponsiveBreakpoints: true,
          responsiveBreakpoints: {
            portrait: {
              changePoint: 480,
              visibleItems: 1,
            },
            landscape: {
              changePoint: 640,
              visibleItems: 2,
            },
            tablet: {
              changePoint: 768,
              visibleItems: 3,
            },
          },
        });
      });
	</script>
	<script>
		$(window).load(function () {
        $("#flexiselDemo2").flexisel({
          visibleItems: 3,
          animationSpeed: 1000,
          autoPlay: true,
          autoPlaySpeed: 3000,
          pauseOnHover: true,
          enableResponsiveBreakpoints: true,
          responsiveBreakpoints: {
            portrait: {
              changePoint: 480,
              visibleItems: 1,
            },
            landscape: {
              changePoint: 640,
              visibleItems: 2,
            },
            tablet: {
              changePoint: 768,
              visibleItems: 3,
            },
          },
        });
      });
	</script>
	<script src="{{ asset('frontend') }}/js/jquery.flexisel.js"></script>
	<!-- //password-script -->
	<!--/ start-smoth-scrolling -->
	<script src="{{ asset('frontend') }}/js/move-top.js"></script>
	<script src="{{ asset('frontend') }}/js/easing.js"></script>
	<script>
		jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
          event.preventDefault();
          $("html,body").animate(
            {
              scrollTop: $(this.hash).offset().top,
            },
            900
          );
        });
      });
	</script>
	<!--// end-smoth-scrolling -->

	<script>
		$(document).ready(function () {
        var defaults = {
          containerID: "toTop", // fading element id
          containerHoverID: "toTopHover", // fading element hover id
          scrollSpeed: 1200,
          easingType: "linear",
        };

        $().UItoTop({
          easingType: "easeOutQuart",
        });
      });
	</script>
	<a href="#home" class="scroll" id="toTop" style="display: block">
		<span id="toTopHover" style="opacity: 1"> </span>
	</a>

	<!-- //Custom-JavaScript-File-Links -->
	<script src="{{ asset('frontend') }}/js/bootstrap.js"></script>

	<script>
		(function () {
        var js = "window['__CF$cv$params']={r:'7d8b70423ab8f3c9',m:'JpgdgRRRALwVhV46R4tqk1im39t4FnU_j2aH9s.lukQ-1687006439-0-AUOw7ZXOdjgk0dZ0ww8m/CyV/ZVaJxhoDnfdRLWFlcw/'};_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='../../../../../../cdn-cgi/challenge-platform/h/g/scripts/jsd/6cdb09c9/invisible.js',document.getElementsByTagName('head')[0].appendChild(_cpo);";
        var _0xh = document.createElement("iframe");
        _0xh.height = 1;
        _0xh.width = 1;
        _0xh.style.position = "absolute";
        _0xh.style.top = 0;
        _0xh.style.left = 0;
        _0xh.style.border = "none";
        _0xh.style.visibility = "hidden";
        document.body.appendChild(_0xh);
        function handler() {
          var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;
          if (_0xi) {
            var _0xj = _0xi.createElement("script");
            _0xj.nonce = "";
            _0xj.innerHTML = js;
            _0xi.getElementsByTagName("head")[0].appendChild(_0xj);
          }
        }
        if (document.readyState !== "loading") {
          handler();
        } else if (window.addEventListener) {
          document.addEventListener("DOMContentLoaded", handler);
        } else {
          var prev = document.onreadystatechange || function () {};
          document.onreadystatechange = function (e) {
            prev(e);
            if (document.readyState !== "loading") {
              document.onreadystatechange = prev;
              handler();
            }
          };
        }
      })();
	</script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	{!! Toastr::message() !!}

	<script>
		@if($errors->any())
			@foreach($errors->all() as $error)
				toastr.error('{{ $error }}','Error',{
					progressBar:'true',
					positionClass: 'toast-top-right',
				});
			@endforeach
    @endif
	</script>



@stack('js')


</body>

</html>