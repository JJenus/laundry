
	<!--begin::Head-->
<head>
		<meta charset="utf-8" />
		<title><?= APP_NAME ?></title>
		<meta name="description" content="Confectionery shop." />
		
		<link rel="canonical" href="<?= base_url() ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="<?= base_url() ?>/assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<script src="<?= base_url() ?>/node_modules/eruda/eruda.js"></script>
		<script type="text/javascript" charset="utf-8">
		  eruda.init();
		  (function () {
          window.onload = function () {
            const preloader = document.querySelector('.page-loading');
            preloader.classList.remove('active');
            setTimeout(function () {
              preloader.remove();
            }, 2000);
          };
        })();
		</script>
		  
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="<?= base_url() ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url() ?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url() ?>/assets/css/loaders.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<?= $this->renderSection ("pageStyles") ?>
</head>
<!--end::Head--> 
	
