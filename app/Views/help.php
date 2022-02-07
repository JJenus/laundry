<?= $this->extend($config->viewLayout) ?>
  
  <?= $this->section('pageScripts') ?>
    
		<!-- end::Page Custom Javascript-->
  <?= $this->endSection() ?> 
  
  
  <?= $this->section('main') ?>
    <!--begin::Body-->
	<body id="kt_body" data-sidebar="on" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled sidebar-enabled">
		<!--begin::Main-->
		<!--begin::Root-->
		<div id="app" class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				  <?= view("temp/top_bar") ?> 
					<!--begin::Main-->
					<div class="d-flex flex-column flex-column-fluid">
						<!--begin::toolbar-->
						<div class="toolbar" id="kt_toolbar">
							<div class="container d-flex flex-stack flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-1">
									<!--begin::Title-->
									<h3 class="text-dark fw-bolder my-1">Help</h3>
									<!--end::Title-->
									<!--begin::Breadcrumb-->
									<ul class="breadcrumb breadcrumb-line bg-transparent text-muted fw-bold p-0 my-1 fs-7">
										<li class="breadcrumb-item">
											<a href="<?=base_url("app/main")?>" class="text-muted text-hover-primary">App</a>
										</li>
										<li class="breadcrumb-item text-dark">Help</li>
									</ul>
									<!--end::Breadcrumb-->
								</div>
								<!--end::Info-->
								<!--begin::Nav-->
								<div class="d-flex align-items-center flex-nowrap text-nowrap overflow-auto py-1">
									<a href="<?=base_url("app/main")?>" class="btn btn-active-accent fw-bolder ms-3">Main</a>
									<a href="<?=base_url("app/laundry")?>" class="btn btn-active-accent fw-bolder">Laundry</a>
									<a href="<?=base_url("app/dashboard")?>" class="btn btn-active-accent fw-bolder ms-3">Dashboard</a>
								</div>
								<!--end::Nav-->
							</div>
						</div>
						<!--end::toolbar-->
						<!--begin::Content-->
						<div class="content fs-6 d-flex flex-column-fluid" id="kt_content">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Page Layout-->
								<div class="d-flex flex-column flex-md-row">
									<!--begin::Aside-->
									<div class="d-none flex-column flex-md-row-auto w-100 w-md-250px w-xxl-350px">
										<!--begin::List Widget 2-->
										<div class="card mb-10 mb-md-0">
											<!--begin::Body-->
											<div class="card-body py-10 px-6">
												<!--begin::Search Input-->
												<div class="d-flex flex-column mb-10 px-3">
													<!--begin::Form-->
													<form>
														<div class="input-group input-group-solid" id="kt_chat_aside_search">
															<span class="input-group-text" id="basic-addon1">
																<!--begin::Svg Icon | path: icons/stockholm/General/Search.svg-->
																<span class="svg-icon svg-icon-1 svg-icon-dark">
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
																		</g>
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</span>
															<input type="text" class="form-control ps-0 py-4 h-auto" placeholder="Search" />
														</div>
													</form>
													<!--end::Form-->
												</div>
												<!--end::Search Input-->
												<!--begin::Authors List-->
												<ul class="menu menu-column menu-rounded menu-gray-600 menu-hover-bg-light-primary menu-active-bg-light-primary fw-bold mb-10">
													<li class="menu-content fw-bold pb-2 px-3">
														<span class="fs-3 fw-bolder">Premium Authors</span>
													</li>
													<li class="menu-item px-3 pb-1">
														<a href="#" class="menu-link fs-6 px-3">Getting Started</a>
													</li>
													<li class="menu-item px-3 pb-1">
														<a href="#" class="menu-link fs-6 px-3 active">Popular Articles</a>
													</li>
													<li class="menu-item px-3 pb-1">
														<a href="#" class="menu-link fs-6 px-3">Uploading Theme</a>
													</li>
													<li class="menu-item px-3">
														<a href="#" class="menu-link fs-6 px-3">Licensing</a>
													</li>
												</ul>
												<!--end::Authors List-->
												<!--begin::Theme List-->
												<ul class="menu menu-column menu-rounded menu-gray-600 menu-hover-bg-light-primary menu-active-bg-light-primary fw-bold">
													<li class="menu-content fw-bold pb-2 px-3">
														<span class="fs-3 fw-bolder">Theme Customers</span>
													</li>
													<li class="menu-item px-3 pb-1">
														<a href="#" class="menu-link fs-6 px-3">User Profile</a>
													</li>
													<li class="menu-item px-3 pb-1">
														<a href="#" class="menu-link fs-6 px-3">Timeline</a>
													</li>
													<li class="menu-item px-3 pb-1">
														<a href="#" class="menu-link fs-6 px-3">Pricing Tables</a>
													</li>
													<li class="menu-item px-3">
														<a href="#" class="menu-link fs-6 px-3">Wizard Options</a>
													</li>
												</ul>
												<!--end::Theme List-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::List Widget 2-->
									</div>
									<!--end::Aside-->
									<!--begin::Layout-->
									<div class="flex-md-row-fluid ms-md-12">
										<!--begin::Card-->
										<div class="card">
											<div class="card-body py-10">
												<h2 class="text-dark fw-bolder fs-1 mb-5">Popular Articles</h2>
												<!--begin::Accordion-->
												<div class="accordion accordion-icon-toggle" id="kt_accordion_1">
													<!--begin::Item-->
													<div class="mb-5">
														<!--begin::Header-->
														<div class="accordion-header py-3 d-flex" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_item_1">
															<span class="accordion-icon">
																<!--begin::Svg Icon | path: icons/stockholm/Navigation/Right-2.svg-->
																<span class="svg-icon svg-icon-4">
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<polygon points="0 0 24 0 24 24 0 24" />
																			<rect fill="#000000" opacity="0.5" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
																			<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
																		</g>
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</span>
															<h3 class="fs-4 text-gray-800 fw-bold mb-0 ms-4">The best way to quick start business</h3>
														</div>
														<!--end::Header-->
														<!--begin::Body-->
														<div id="kt_accordion_1_item_1" class="fs-6 collapse show ps-10" data-bs-parent="#kt_accordion_1">
															<div class="mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
															<div>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
														</div>
														<!--end::Body-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="mb-5">
														<!--begin::Header-->
														<div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_item_2">
															<span class="accordion-icon">
																<!--begin::Svg Icon | path: icons/stockholm/Navigation/Right-2.svg-->
																<span class="svg-icon svg-icon-4">
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<polygon points="0 0 24 0 24 24 0 24" />
																			<rect fill="#000000" opacity="0.5" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
																			<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
																		</g>
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</span>
															<h3 class="fs-4 text-gray-800 fw-bold mb-0 ms-4">How To Create Channel ?</h3>
														</div>
														<!--end::Header-->
														<!--begin::Body-->
														<div id="kt_accordion_1_item_2" class="collapse fs-6 ps-10" data-bs-parent="#kt_accordion_1">
															<div class="mb-5">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</div>
															<div class="mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
															<div>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
														</div>
														<!--end::Body-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="mb-5">
														<!--begin::Header-->
														<div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_item_3">
															<span class="accordion-icon">
																<!--begin::Svg Icon | path: icons/stockholm/Navigation/Right-2.svg-->
																<span class="svg-icon svg-icon-4">
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<polygon points="0 0 24 0 24 24 0 24" />
																			<rect fill="#000000" opacity="0.5" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
																			<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
																		</g>
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</span>
															<h3 class="fs-4 text-gray-800 fw-bold mb-0 ms-4">What are the support terms &amp; conditions ?</h3>
														</div>
														<!--end::Header-->
														<!--begin::Body-->
														<div id="kt_accordion_1_item_3" class="collapse fs-6 ps-10" data-bs-parent="#kt_accordion_1">Some plugins may ask for a purchase code for registration/activation once installed, however, you can simply ignore these messages as bundled plugins do not require activation or registration.</div>
														<!--end::Body-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="mb-5">
														<!--begin::Header-->
														<div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_item_4">
															<span class="accordion-icon">
																<!--begin::Svg Icon | path: icons/stockholm/Navigation/Right-2.svg-->
																<span class="svg-icon svg-icon-4">
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<polygon points="0 0 24 0 24 24 0 24" />
																			<rect fill="#000000" opacity="0.5" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
																			<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
																		</g>
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</span>
															<h3 class="fs-4 text-gray-800 fw-bold mb-0 ms-4">What is the 6 Months support extention ?</h3>
														</div>
														<!--end::Header-->
														<!--begin::Body-->
														<div id="kt_accordion_1_item_4" class="collapse fs-6 ps-10" data-bs-parent="#kt_accordion_1">Some plugins may ask for a purchase code for registration/activation once installed, however, you can simply ignore these messages as bundled plugins do not require activation or registration. The plugin will still work as intended with the theme once the theme has been activated/registered. When a plugin is updated, the theme author will include the latest version of the bundled plugin with their next theme update.</div>
														<!--end::Body-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="mb-5">
														<!--begin::Header-->
														<div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_item_5">
															<span class="accordion-icon">
																<!--begin::Svg Icon | path: icons/stockholm/Navigation/Right-2.svg-->
																<span class="svg-icon svg-icon-4">
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<polygon points="0 0 24 0 24 24 0 24" />
																			<rect fill="#000000" opacity="0.5" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
																			<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
																		</g>
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</span>
															<h3 class="fs-4 text-gray-800 fw-bold mb-0 ms-4">How can I keep up to date my item ?</h3>
														</div>
														<!--end::Header-->
														<!--begin::Body-->
														<div id="kt_accordion_1_item_5" class="collapse fs-6 ps-10" data-bs-parent="#kt_accordion_1">Some plugins may ask for a purchase code for registration/activation once installed, however, you can simply ignore these messages as bundled plugins do not require activation or registration. The plugin will still work as intended with the theme once the theme has been activated/registered.</div>
														<!--end::Body-->
													</div>
													<!--end::Item-->
												</div>
												<!--end::Accordion-->
											</div>
										</div>
										<!--end::Card-->
									</div>
									<!--end::Layout-->
								</div>
								<!--end::Page Layout-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Main-->
					<!--begin::Footer-->
					<?= view ("temp/footer") ?> 
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
				<!--begin::Sidebar-->
				<div id="kt_sidebar" class="sidebar bg-info" data-kt-drawer="true" data-kt-drawer-name="sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '350px': '300px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_sidebar_toggler">
					<!--begin::Sidebar Content-->
					<div class="d-flex flex-column sidebar-body">
						<!--begin::Sidebar Content-->
						<div id="kt_sidebar_content" class="py-10 px-2 px-lg-8">
							<div class="hover-scroll-y me-lg-n5 pe-lg-4" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-offset="0px" data-kt-scroll-wrappers="#kt_sidebar_content">
								<!--begin::Card-->
								<div class="card bg-info">
									<!--begin::Body-->
									<div class="card-body px-0">
										<div class="pt-0">
											<!--begin::Chart-->
											<div class="d-flex flex-center position-relative bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-center" style="background-image:url('../assets/media/svg/illustrations/bg-2.svg')">
												<div class="position-absolute mb-7">
													<div class="symbol symbol-circle symbol-100px overflow-hidden d-flex flex-center z-index-1">
														<span class="symbol-label bg-warning align-items-end">
															<img alt="Logo" src="../assets/media/svg/avatars/016-boy-7.svg" class="mh-75px" />
														</span>
													</div>
												</div>
												<div id="kt_user_chart" style="height: 200px"></div>
											</div>
											<!--end::Chart-->
											<!--begin::Items-->
											<div class="pt-4">
												<!--begin::Title-->
												<div class="text-center pb-12">
													<!--begin::Username-->
													<h3 class="fw-bolder text-white fs-2 pb-4">Mr. Anderson</h3>
													<!--end::Username-->
													<!--end::Action-->
													<span class="fw-bolder fs-6 text-primary px-4 py-2 rounded bg-white bg-opacity-10">Python Dev</span>
													<!--begin::Action-->
												</div>
												<!--end::Title-->
												<!--begin::Row-->
												<div class="row row-cols-2 px-xl-12 sidebar-toolbar">
													<div class="col p-3">
														<a href="#" class="btn p-5 w-100 text-start btn-active-primary">
															<span class="text-white fw-bolder fs-1 d-block pb-1">38</span>
															<span class="fw-bold">Pending</span>
														</a>
													</div>
													<div class="col p-3">
														<a href="#" class="btn p-5 w-100 text-start btn-active-primary">
															<span class="text-white fw-bolder fs-1 d-block pb-1">204</span>
															<span class="fw-bold">Completed</span>
														</a>
													</div>
													<div class="col p-3">
														<a href="#" class="btn p-5 w-100 text-start btn-active-primary">
															<span class="text-white fw-bolder fs-1 d-block pb-1">76</span>
															<span class="fw-bold">On Hold</span>
														</a>
													</div>
													<div class="col p-3">
														<a href="#" class="btn p-5 w-100 text-start btn-active-primary">
															<span class="text-white fw-bolder fs-1 d-block pb-1">9</span>
															<span class="fw-bold">In Progress</span>
														</a>
													</div>
												</div>
												<!--end::Row-->
											</div>
											<!--end::Items-->
										</div>
									</div>
									<!--end::Body-->
								</div>
								<!--end::Card-->
								<!--begin::Card-->
								<div class="card bg-info">
									<!--begin::Header-->
									<div class="card-header border-0">
										<h3 class="card-title fw-bolder text-white fs-3">Fox Bestsellers</h3>
										<div class="card-toolbar">
											<!--begin::Dropdown-->
											<button type="button" class="btn btn-md btn-icon btn-icon-white btn-info" data-kt-menu-trigger="click" data-kt-menu-overflow="true" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
												<!--begin::Svg Icon | path: icons/stockholm/Layout/Layout-4-blocks-2.svg-->
												<span class="svg-icon svg-icon-1">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
															<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
															<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
															<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
														</g>
													</svg>
												</span>
												<!--end::Svg Icon-->
											</button>
											<!--begin::Menu-->
											<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
												<div class="menu-item px-3">
													<div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Manage</div>
												</div>
												<div class="separator mb-3 opacity-75"></div>
												<div class="menu-item px-3">
													<a href="#" class="menu-link px-3">Add User</a>
												</div>
												<div class="menu-item px-3">
													<a href="#" class="menu-link px-3">Add Role</a>
												</div>
												<div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start" data-kt-menu-flip="left-start, top">
													<a href="#" class="menu-link px-3">
														<span class="menu-title">Add Group</span>
														<span class="menu-arrow"></span>
													</a>
													<div class="menu-sub menu-sub-dropdown w-200px py-4">
														<div class="menu-item px-3">
															<a href="#" class="menu-link px-3">Admin Group</a>
														</div>
														<div class="menu-item px-3">
															<a href="#" class="menu-link px-3">Staff Group</a>
														</div>
														<div class="menu-item px-3">
															<a href="#" class="menu-link px-3">Member Group</a>
														</div>
													</div>
												</div>
												<div class="menu-item px-3">
													<a href="#" class="menu-link px-3">Reports</a>
												</div>
												<div class="separator mt-3 opacity-75"></div>
												<div class="menu-item px-3">
													<div class="menu-content px-3 py-3">
														<a class="btn btn-primary fw-bold btn-sm px-4" href="#">Create New</a>
													</div>
												</div>
											</div>
											<!--end::Menu-->
											<!--end::Dropdown-->
										</div>
									</div>
									<!--end::Header-->
									<!--begin::Body-->
									<div class="card-body">
										<!--begin::Item-->
										<div class="d-flex flex-wrap align-items-center mb-7">
											<!--begin::Symbol-->
											<div class="symbol symbol-40px symbol-2by3 me-4">
												<img src="../assets/media/stock/600x400/img-17.jpg" alt="" class="mw-100" />
											</div>
											<!--end::Symbol-->
											<!--begin::Title-->
											<div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
												<a href="#" class="text-white fw-bolder text-hover-primary fs-6">Blue Donut</a>
												<span class="text-white opacity-25 fw-bold fs-7 my-1">Study the highway types</span>
											</div>
											<!--end::Title-->
										</div>
										<!--end::Item-->
										<!--begin: Item-->
										<div class="d-flex flex-wrap align-items-center mb-7">
											<!--begin::Symbol-->
											<div class="symbol symbol-40px symbol-2by3 me-4">
												<img src="../assets/media/stock/600x400/img-10.jpg" alt="" class="mw-100" />
											</div>
											<!--end::Symbol-->
											<!--begin::Title-->
											<div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
												<a href="#" class="text-white fw-bolder text-hover-primary fs-6">Lovely Hearts</a>
												<span class="text-white opacity-25 fw-bold fs-7 my-1">Study the highway types</span>
											</div>
											<!--end::Title-->
										</div>
										<!--end: Item-->
										<!--begin::Item-->
										<div class="d-flex flex-wrap align-items-center mb-7">
											<!--begin::Symbol-->
											<div class="symbol symbol-40px symbol-2by3 me-4">
												<img src="../assets/media/stock/600x400/img-1.jpg" alt="" class="mw-100" />
											</div>
											<!--end::Symbol-->
											<!--begin::Title-->
											<div class="d-flex flex-column flex-grow-1 pe-3">
												<a href="#" class="text-white fw-bolder text-hover-primary fs-6">Hands &amp; Yellow</a>
												<span class="text-white opacity-25 fw-bold fs-7 my-1">Study the highway types</span>
											</div>
											<!--end::Title-->
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex flex-wrap align-items-center mb-7">
											<!--begin::Symbol-->
											<div class="symbol symbol-40px symbol-2by3 me-4">
												<img src="../assets/media/stock/600x400/img-9.jpg" alt="" class="mw-100" />
											</div>
											<!--end::Symbol-->
											<!--begin::Title-->
											<div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
												<a href="#" class="text-white fw-bolder text-hover-primary fs-6">Cup &amp; Green</a>
												<span class="text-white opacity-25 fs-7 fw-bold my-1">Study the highway types</span>
											</div>
											<!--end::Title-->
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex flex-wrap align-items-center">
											<!--begin::Symbol-->
											<div class="symbol symbol-40px symbol-2by3 me-4">
												<img src="../assets/media/stock/600x400/img-4.jpg" alt="" class="mw-100" />
											</div>
											<!--end::Symbol-->
											<!--begin::Title-->
											<div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
												<a href="#" class="text-white fw-bolder text-hover-primary fs-6">Bose QC 35 II</a>
												<span class="text-white opacity-25 fs-7 fw-bold my-1">Study the highway types</span>
											</div>
											<!--end::Title-->
										</div>
										<!--end::Item-->
									</div>
									<!--end: Card Body-->
								</div>
								<!--end::Card-->
							</div>
						</div>
						<!--end::Sidebar Content-->
					</div>
					<!--end::Sidebar Content-->
				</div>
				<!--end::Sidebar-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
	

  <?= $this->endSection() ?> 