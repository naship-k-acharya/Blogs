<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
<body style="width: 70%; margin: 0 auto;">
    <div class="header" style="display: flex; align-items: center; justify-content: space-between">
        <h2>
            USER PROFILE
        </h2>
     
        
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="btn btn-success waves-effect">Logout</i>
               
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        
        
    </div>
    @yield('content')


    <div class="copyright">
        &copy; {{ date('Y') }} <a href="{{ route('home') }}">Blog Project on Laravel</a>.
    </div>
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