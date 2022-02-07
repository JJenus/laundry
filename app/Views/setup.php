<!DOCTYPE html>
<html>
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
  		  let base_url = "<?=base_url()?>/";
  		  (function () {
          window.onload = function () {
            const preloader = document.querySelector('.page-loading');
            preloader.classList.remove('active');
            setTimeout(function () {
              preloader.remove();
            }, 5000);
          };
        })();
  		</script>
  		  
  		<!--begin::Global Stylesheets Bundle(used by all pages)-->
  		<link href="<?= base_url() ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
  		<link href="<?= base_url() ?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
  		<link href="<?= base_url() ?>/assets/css/loaders.css" rel="stylesheet" type="text/css" />
  		<!--end::Global Stylesheets Bundle-->
  </head>
  <body class="vw-100 pt-10 vh-100 container-fluid">
    <div class="page-loading active">
      <div class="page-loading-inner">
        <div class="loader09 mb-8"></div><span>Loading...</span>
      </div>
    </div>
    
    <main v-if="progress" id="app" class="d-flex flex-wrap w-100 h-75 ">
      <div v-if="!progress.installed"  class="m-auto flex-wrap d-flex align-items-center justify-content-center h-75 bg-transparent w-75 p-4">
          <button @click="install('install')" id="btn-install" class="fs-4x d-flex align-items-center justify-content-center shadow  h-200px w-200px btn-light-primary btn rounded-circle">
            <span class="indicator-label">Install</span>
            <span class="indicator-progress">Installing...</span>
            <span class="indicator-progress position-absolute spinner-border h-200px w-200px text-warning"></span>
          </button> 
          <div v-if="!installing && !progress.installed" class="mt-10 mb-3 ">
            <ul>
              <li>Make sure database is created with the appropriate name.</li>
              <li>Simply click install.</li>
              <li>Sit tight and wait for installation to complete. Shouldn't take more than 15 seconds.</li>
              <li>Create/Register admin, login and enjoy.</li>
            </ul>
            <span class="text-dark fw-bold p-3">
              <i class="bi fs-3 me-2 text-warning bi-exclamation-circle"></i>
              Please remember to give your feedback via feedback.jjenus@gmail.com, use app name as subject. It's necessary to build better solutions for your businesses. 
            </span>
          </div>
      </div>
      <div v-else-if="!progress.isAdminCreated && progress.installed" class="m-auto">
        <div class="card card-rounded card-hover ">
          <div class="card-header">
            <h3 class="card-title">Create Admin</h3>
          </div>
          <div class="card-body">
            <p class="card-description">
              Register administrator with super user access. This can be done once. After registration, you can login to app. 
            </p>
            <!--begin::Signin Form-->
						<form @submit.prevent="submit()" method="post" action="<?=base_url('register')?>" class="form w-100 needs-validation" novalidate="novalidate" id="kt_signup_form" in-url="../auth">
							<!--begin::Title-->
							<div class="pb-5 pb-lg-15">
								<h3 class="fw-bolder text-dark display-6">Welcome to <a href="<?= base_url() ?>"> <?= APP_NAME ?> </a></h3>
								<div class="text-muted fw-bold fs-3">
								  Laundry management software. 
								</div>
							</div>
              
              <div v-if="errors" class="alert p-3 alert-danger" >
              	<ul>
              		<li v-for="error in errors">{{error}}</li>
              	</ul>
              </div>
              
							<!--begin::Form group-->
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Name</label>
								<input required value="<?=old('name')?>" class="form-control form-control-lg form-control-solid" type="text" name="name" autocomplete="off" />
							</div>
							<!--end::Form group-->
							
							<!--begin::Form group-->
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Username</label>
								<input required value="<?=old('username')?>" class="form-control form-control-lg form-control-solid" type="text" name="username" autocomplete="off" />
							</div>
							<!--end::Form group-->
						
							<!--begin::Form group-->
							<div class="fv-row mb-10">
								<label required class="form-label fs-6 fw-bolder text-dark">Email</label>
								<input value="<?=old('email')?>" class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
							</div>
							<!--end::Form group-->
							<!--begin::Form group-->
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark pt-5">Password</label>
								<input required value="<?=old('password')?>" class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
							</div>
							<!--end::Form group-->
							<!--begin::Form group-->
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark pt-5">Confirm Password</label>
								<input required value="<?=old('pass_confirm')?>" class="form-control form-control-lg form-control-solid" type="password" name="pass_confirm" autocomplete="off" />
							</div>
							<!--end::Form group-->
							<!--begin::Action-->
							<div class="pb-lg-0 pb-5">
								<button type="submit" id="btn-submit" class="btn btn-primary fw-bolder fs-6 px-8 py-4 my-3 me-3">
								  <span class="indicator-label">
                    Submit
                  </span>
                  <span class="indicator-progress">
                      Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                  </span>
								</button>
							</div>
							<!--end::Action-->
						</form>
						<!--end::Signin Form-->
						
          </div>
        </div>
      </div>
      <div  v-else class="m-auto flex-wrap d-flex flex-wrap align-items-center justify-content-center h-75 bg-transparent w-75 p-4">
        <button @click="install('reinstall', 'btn-reinstall')" id="btn-reinstall" class="fs-4x d-flex flex-wrap align-items-center justify-content-center shadow  h-200px w-200px btn-light-primary btn rounded-circle">
            <span class="indicator-label">Re-install</span>
            <span class="indicator-progress">Installing...</span>
            <span class="indicator-progress position-absolute spinner-border h-200px w-200px text-warning"></span>
          </button> 
          <div v-if="progress.installed" class="mt-10 mb-3 ">
            <ul>
              <li>Login as Admin to re-install.</li>
            </ul>
            <div class="text-danger d-flex fw-bold p-3">
              <i class="bi fs-3 me-2 text-danger bi-exclamation-circle"></i>
              <span>
                This will delete all data and it’s irreversible. 
              </span>
            </div>
          </div>
      </div>
    </main>
    
    <script src="<?= base_url() ?>/assets/plugins/global/plugins.bundle.js"></script>
    <script src="<?= base_url() ?>/assets/js/scripts.bundle.js"></script>
    <script>
       (function () {

          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.querySelectorAll('.needs-validation')
        
          // Loop over them and prevent submission
          Array.prototype.slice.call(forms)
            .forEach(function (form) {
              form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                  event.preventDefault()
                  event.stopPropagation()
                }
        
                form.classList.add('was-validated')
              }, false)
            })
        })();
    </script>
    <script type="text/javascript" charset="utf-8">
      let notify = function(type="success", msg){
    		  if(type === 'success'){
    		    swal.fire({
              text: msg,
              icon: "success",
              buttonsStyling: false,
              confirmButtonText: "Ok",
              customClass: {
      					confirmButton: "btn fw-bold btn-light-primary"
      				}
            }).then(function() {
      					KTUtil.scrollTop();
      			});
    		  }else{
    		    swal.fire({
              text: msg,
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Ok",
              customClass: {
      					confirmButton: "btn fw-bold btn-light-primary"
      				}
            }).then(function() {
      					//KTUtil.scrollTop();
      			});
    		  }
    	} 
    </script>
    <script src="<?= base_url() ?>/assets/js/vue.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/setup.js"></script>
  </body>
</html>