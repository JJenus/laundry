<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<title>Error | <?=APP_NAME?></title>
		<meta name="description" content="laundry management software." />
		<meta name="keywords" content="laundry, laundry software, startup, business" />
		
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="<?=base_url()?>/assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="<?=base_url()?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url()?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" data-sidebar="on" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled sidebar-enabled">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Error-->
			<div class="d-flex flex-column flex-column-fluid position-relative" style="background-color: #EAF9FC;">
				<!--begin::Background-->
				<div class="bgi-size-contain bgi-position-x-end bgi-position-y-center bgi-no-repeat position-absolute top-0 start-0 w-100 h-100 d-none d-lg-block" style="background-image: url(<?=base_url()?>/assets/media/svg/illustrations/404.svg);"></div>
				<div class="bgi-size-contain bgi-position-y-bottom bgi-position-x-end bgi-no-repeat position-absolute top-0 start-0 w-100 h-100 d-lg-none" style="background-image: url(<?=base_url()?>/assets/media/svg/illustrations/phone404.svg);"></div>
				<!--end::Background-->
				<!--begin::Content-->
				<div class="px-10 px-md-20 pt-10 pt-md-14 z-index-1">
					<a href="<?=base_url()?>/">
						<img alt="Logo" src="<?=base_url()?>/assets/media/logos/logo-default.svg" class="h-75px" />
					</a>
				</div>
				<div class="px-10 px-md-20 py-10 py-md-0 d-flex flex-column justify-content-md-center align-items-start flex-root w-md-700px z-index-1">
					<p class="display-6 fw-bolder text-gray-800 mb-8">Something went wrong..</p>
					<p class="fs-6 d-none mb-8">
					  Some plugins may ask a 
					  purchase code registration
					  activation once installed,
					  however, you can simply 
					  ignore these messages bundled 
					  plugins do not require activation 
					  or registration
					</p>
					<a href="<?=base_url()?>/main" class="btn btn-primary fs-6 fw-bolder py-4 px-6 me-auto">Return to main</a>
				</div>
				<!--end::Content-->
			</div>
			<!--end::Error-->
		</div>
		<!--end::Main-->
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="<?=base_url()?>/assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?=base_url()?>/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/start/general/error.html by HTTrack Website Copier/3.x [XR&CO'2017], Tue, 11 May 2021 00:33:21 GMT -->
</html>