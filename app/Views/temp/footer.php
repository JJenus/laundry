<!--begin::Footer-->
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
	<!--begin::Container-->
	<div class="container d-flex flex-column flex-md-row flex-stack">
		<!--begin::Copyright-->
		<div class="text-dark order-2 order-md-1">
			<span class="text-muted fw-bold me-2">2021©</span>
			<a href="<?= base_url() ?>" target="_blank" class="text-gray-800 text-hover-primary"> 
			  <?= APP_NAME ?>
			</a>
		</div>
		<!--end::Copyright-->
		<!--begin::Nav-->
		<ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
			<li class="menu-item">
				<a href="<?= base_url('app/dashboard') ?>" class="menu-link ps-0 pe-2">Dashboard</a>
			</li>
			<li  class="menu-item">
				<a href="<?= base_url("app/about") ?>" class="menu-link ps-0 pe-2">About</a>
			</li>
			<li class="menu-item">
				<a href="<?= base_url("app/help") ?>" class="menu-link pe-0 pe-2">Help</a>
			</li>
		</ul>
		<!--end::Nav-->
	</div>
	<!--end::Container-->
</div>
<!--end::Footer-->