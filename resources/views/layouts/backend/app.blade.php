<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>Welcome To | Bootstrap Based Admin Template - Material Design</title>
	<!-- Favicon-->
	<link rel="icon" href="favicon.ico" type="image/x-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
		type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

	<!-- Bootstrap Core Css -->
	<link href="{{ asset('backend') }}/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- Waves Effect Css -->
	<link href="{{ asset('backend') }}/plugins/node-waves/waves.css" rel="stylesheet" />

	<!-- Animation Css -->
	<link href="{{ asset('backend') }}/plugins/animate-css/animate.css" rel="stylesheet" />

	<!-- JQuery DataTable Css -->
	<link href="{{ asset('backend') }}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"
		rel="stylesheet">

	<!-- Morris Chart Css-->
	<link href="{{ asset('backend') }}/plugins/morrisjs/morris.css" rel="stylesheet" />

	<!-- Toastr Css -->
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/toastr/toastr.min.css">

	<!-- Custom Css -->
	<link href="{{ asset('backend') }}/css/style.css" rel="stylesheet">

	<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
	<link href="{{ asset('backend') }}/css/themes/all-themes.css" rel="stylesheet" />

	@stack('css')

</head>

<body class="theme-red">
	<!-- Page Loader -->
	{{-- <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>  --}}
	<!-- #END# Page Loader -->
	<!-- Overlay For Sidebars -->
	<div class="overlay"></div>
	<!-- #END# Overlay For Sidebars -->
	<!-- Search Bar -->
	<div class="search-bar">
		<div class="search-icon">
			<i class="material-icons">search</i>
		</div>
		<input type="text" placeholder="START TYPING...">
		<div class="close-search">
			<i class="material-icons">close</i>
		</div>
	</div>
	<!-- #END# Search Bar -->
	<!-- Top Bar -->
	@include('layouts.backend.layouts.header')
	<!-- #Top Bar -->
	@include('layouts.backend.layouts.sidebar')

	<section class="content">
		<div class="container-fluid">

			@yield('main_content')

		</div>
	</section>

	<!-- Jquery Core Js -->
	<script src="{{ asset('backend') }}/plugins/jquery/jquery.min.js"></script>

	<!-- Bootstrap Core Js -->
	<script src="{{ asset('backend') }}/plugins/bootstrap/js/bootstrap.js"></script>
	
	<!-- Slimscroll Plugin Js -->
	<script src="{{ asset('backend') }}/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

	<!-- Waves Effect Plugin Js -->
	<script src="{{ asset('backend') }}/plugins/node-waves/waves.js"></script>

	<!-- Jquery CountTo Plugin Js -->
	<script src="{{ asset('backend') }}/plugins/jquery-countto/jquery.countTo.js"></script>

	<!-- Morris Plugin Js -->
	<script src="{{ asset('backend') }}/plugins/raphael/raphael.min.js"></script>
	<script src="{{ asset('backend') }}/plugins/morrisjs/morris.js"></script>

	<!-- ChartJs -->
	<script src="{{ asset('backend') }}/plugins/chartjs/Chart.bundle.js"></script>

	<!-- Flot Charts Plugin Js -->
	<script src="{{ asset('backend') }}/plugins/flot-charts/jquery.flot.js"></script>
	<script src="{{ asset('backend') }}/plugins/flot-charts/jquery.flot.resize.js"></script>
	<script src="{{ asset('backend') }}/plugins/flot-charts/jquery.flot.pie.js"></script>
	<script src="{{ asset('backend') }}/plugins/flot-charts/jquery.flot.categories.js"></script>
	<script src="{{ asset('backend') }}/plugins/flot-charts/jquery.flot.time.js"></script>

	<!-- Jquery DataTable Plugin Js -->
	<script src="{{ asset('backend') }}/plugins/jquery-datatable/jquery.dataTables.js"></script>
	<script src="{{ asset('backend') }}/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
	<script src="{{ asset('backend') }}/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
	<script src="{{ asset('backend') }}/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
	<script src="{{ asset('backend') }}/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
	<script src="{{ asset('backend') }}/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
	<script src="{{ asset('backend') }}/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
	<script src="{{ asset('backend') }}/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
	<script src="{{ asset('backend') }}/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

	<!-- Sparkline Chart Plugin Js -->
	<script src="{{ asset('backend') }}/plugins/jquery-sparkline/jquery.sparkline.js"></script>

	<!-- Custom Js -->
	<script src="{{ asset('backend') }}/js/admin.js"></script>
	<script src="{{ asset('backend') }}/js/pages/tables/jquery-datatable.js"></script>
	<script src="{{ asset('backend') }}/js/pages/index.js"></script>

	<!-- Toastr Js -->
	<script src="{{ asset('backend') }}/plugins/toastr/toastr.min.js"></script>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<!-- Demo Js -->
	<script src="{{ asset('backend') }}/js/demo.js"></script>
	
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


	<script>
		$(document).on('click', '#delete', function(e){
			e.preventDefault();
			var urlToRedirect = $(this).attr('href');

			swal({
				title: "Are you sure?",
				text: "You won't be able to revert this delete",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					window.location = urlToRedirect;
					swal("Poof! Your imaginary file has been deleted!", {
						icon: "success",
					});
				} else {
					swal("Now! Your imaginary file is safe!", {
						icon: "success",
					});
				}
			});

		});

	</script>

	@stack('script')

</body>

</html>