<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="<?= base_url() ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url() ?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script src="<?= base_url() ?>/node_modules/eruda/eruda.js"></script>
		<script type="text/javascript" charset="utf-8">
		  eruda.init();
		</script>
    <title>Trials</title>
  </head>
  <body>
    <div class="p-5 vh-100 container d-flex align-items-center justify-content-center">
      <button onclick="queryServer()" id="btn-load-more" class="btn  btn-primary">
        <span class="indicator-label">Check data</span>
        <span class="indicator-progress">
          Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
        </span> 
      </button>
       <img src="<?= base_url().'/assets/media/avatars/avatar-male.jpeg'?>">
    </div>
    
    
    <script src="<?= base_url() ?>/assets/plugins/global/plugins.bundle.js"></script>
	  <script src="<?= base_url() ?>/assets/js/scripts.bundle.js"></script>
    <script>
      function queryServer(){
        $("#btn-load-more").attr("data-kt-indicator", "on");
        $.ajax({
          url: "http://localhost:8080/customers/range", 
          method: "GET",
          success: (res)=>{
            console.log(res);
            let label = res.map(e=>e.month)
            let data = res.map(e=>e.total_cost)
            console.log (label);
          },
          error: (err)=>{
            console.log(err);
          } 
        }).always(()=>{
          $("#btn-load-more").attr("data-kt-indicator", null);
        });
      } 
    </script>
  </body>
</html>