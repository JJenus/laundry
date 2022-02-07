<!DOCTYPE html>
<html lang="en"> 
  <?= view('temp/header') ?> 
  <div class="page-loading active">
      <div class="page-loading-inner">
        <div class="loader09 mb-8"></div><span>Loading...</span>
      </div>
    </div>
  <!--nav goes into main  -->
  <?= $this->renderSection("main") ?>
  <!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/stockholm/Navigation/Up-2.svg-->
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.5" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
		<!--end::Scrolltop-->
	<!--begin::Javascript-->
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="<?= base_url() ?>/assets/plugins/global/plugins.bundle.js"></script>
	<script src="<?= base_url() ?>/assets/js/scripts.bundle.js"></script>
	<script src="<?= base_url() ?>/assets/libs/moment.js"></script>
	<!--end::Global Javascript Bundle-->
  <!--
   Notify () sweetalert2 
  -->
  <script type="text/javascript" charset="utf-8">
  
   function base_url(){
     return "<?= base_url() ?>";
   }
   var base_url =  base_url();
   
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
    					KTUtil.scrollTop();
    			});
  		  }
  	} 
  </script>
  <?= $this->renderSection("pageScripts") ?>
 <script>
   (function () {
        'use strict'
      
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
 </body>
</html> 
