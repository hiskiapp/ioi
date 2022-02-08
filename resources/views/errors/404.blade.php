<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="shortcut icon" href="{{ CRUDBooster::getSetting('favicon')?asset(CRUDBooster::getSetting('favicon')):asset('vendor/crudbooster/assets/logo_crudbooster.png') }}">
	<!-- loader-->
	<link href="{{ asset('vendor/rocker-admin/assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('vendor/rocker-admin/assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('vendor/rocker-admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('vendor/rocker-admin/assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/rocker-admin/assets/css/icons.css') }}" rel="stylesheet">
	<title>404 PAGE NOT FOUND</title>
</head>

<body class="bg-theme bg-theme1">
	<!-- wrapper -->
    <div class="wrapper">
        <div class="error-404 d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="card py-5">
                    <div class="row g-0">
                        <div class="col col-xl-6">
                            <div class="card-body p-4">
                                <h1 class="display-1 fw-bold">
                                    404
                                </h1>
                                <h2 class="font-weight-bold display-4">{{cbLang('page_not_found')}}</h2>
                                <p>{{cbLang('page_not_found_text')}}
                                    <br>
                                    <br>Tips:
                                    <br>{!! cbLang('page_not_found_tips') !!}</p>
                                <div class="mt-5"> <a href="{{ url('/') }}" class="btn btn-primary btn-lg px-md-5 radius-30">Go Home</a>
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark btn-lg ms-3 px-md-5 radius-30">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <img src="{{ asset('vendor/rocker-admin/assets/images/errors-images/404-error.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
	<!-- end wrapper -->

<!-- Bootstrap JS -->
<script src="{{ asset('vendor/rocker-admin/assets/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
