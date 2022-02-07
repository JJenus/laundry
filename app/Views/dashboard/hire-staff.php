<?= $this->extend($config->viewLayout) ?>
  
  <?= $this->section('pageScripts') ?>
    <!-- begin::Page Custom Javascript(used by this page)-->
		<script src="<?= base_url("assets/js/custom/general/wizard.js") ?>"></script>
		<script src="<?= base_url("assets/js/vue.min.js") ?>"></script>
		<script src="<?= base_url("assets/js/dashboard/hire.vue.js") ?>"></script>
		
		<!-- end::Page Custom Javascript-->
  <?= $this->endSection() ?> 
  
  
  <?= $this->section('main') ?>
  <body id="kt_body" data-sidebar="on"  class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled sidebar-enabled ">
<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<?= view("dashboard/temp/top_bar") ?>
					<!--begin::Main-->
					<div id="app" class="d-flex flex-column flex-column-fluid">
						<!--begin::toolbar-->
						<div class="toolbar" id="kt_toolbar">
							<div class="container d-flex flex-stack flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-1">
									<!--begin::Title-->
									<h3 class="text-dark fw-bolder my-1">Hire</h3>
									<!--end::Title-->
									<!--begin::Breadcrumb-->
									<ul class="breadcrumb breadcrumb-line bg-transparent text-muted fw-bold p-0 my-1 fs-7">
										<li class="breadcrumb-item">
											<a href="<?=base_url("app/main")?>" class="text-muted text-hover-primary">App</a>
										</li>
										<li class="breadcrumb-item">dashboard</li>
										<li class="breadcrumb-item text-dark">hire-staff</li>
									</ul>
									<!--end::Breadcrumb-->
								</div>
								<!--end::Info-->
							</div>
						</div>
						<!--end::toolbar-->
						<!--begin::Content-->
						<div class="content fs-6 d-flex flex-column-fluid" id="kt_content">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Card-->
								<div class="card">
									<!--begin::Card Body-->
									<div class="card-body p-10 p-lg-15 p-xxl-30">
										<!--begin::Stepper 1-->
										<div class="stepper stepper-1 d-flex flex-column flex-xl-row flex-row-fluid" id="kt_stepper">
											<!--begin::Aside-->
											<div class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px w-xxl-400px">
												<!--begin::Nav-->
												<div class="stepper-nav d-flex flex-column py-15">
													<!--begin::Step 1-->
													<div class="stepper-item current" data-kt-stepper-element="nav">
														<div class="stepper-wrapper">
															<div class="stepper-icon">
																<i class="stepper-check fas fa-check"></i>
																<span class="stepper-number">1</span>
															</div>
															<div class="stepper-label">
																<h3 class="stepper-title">Personal info</h3>
																<div class="stepper-desc">Setup Your Account Details</div>
															</div>
														</div>
													</div>
													<!--end::Step 1-->
													<!--begin::Step 2-->
													<div class="stepper-item" data-kt-stepper-element="nav">
														<div class="stepper-wrapper">
															<div class="stepper-icon">
																<i class="stepper-check fas fa-check"></i>
																<span class="stepper-number">2</span>
															</div>
															<div class="stepper-label">
																<h3 class="stepper-title">Address info</h3>
																<div class="stepper-desc">Setup Residence Address</div>
															</div>
														</div>
													</div>
													<!--end::Step 2-->
													<!--begin::Step 3-->
													<div class="stepper-item " data-kt-stepper-element="nav">
														<div class="stepper-wrapper">
															<div class="stepper-icon">
																<i class="stepper-check fas fa-check"></i>
																<span class="stepper-number">3</span>
															</div>
															<div class="stepper-label">
																<h3 class="stepper-title">Photograph</h3>
																<div class="stepper-desc">Add a recently taken image of employee</div>
															</div>
														</div>
													</div>
													<!--end::Step 3-->
													<!--begin::Step 4-->
													<div class="stepper-item" data-kt-stepper-element="nav">
														<div class="stepper-wrapper">
															<div class="stepper-icon">
																<i class="stepper-check fas fa-check"></i>
																<span class="stepper-number">4</span>
															</div>
															<div class="stepper-label">
																<h3 class="stepper-title">Bank Details</h3>
																<div class="stepper-desc">Add bank details </div>
															</div>
														</div>
													</div>
													<!--end::Step 4-->
													<!--begin::Step 5-->
													<div class="stepper-item" data-kt-stepper-element="nav">
														<div class="stepper-wrapper">
															<div class="stepper-icon">
																<i class="stepper-check fas fa-check"></i>
																<span class="stepper-number">5</span>
															</div>
															<div class="stepper-label">
																<h3 class="stepper-title">Completed!</h3>
																<div class="stepper-desc">Review and Submit</div>
															</div>
														</div>
													</div>
													<!--end::Step 5-->
												</div>
												<!--end::Nav-->
											</div>
											<!--begin::Aside-->
											<!--begin::Content-->
											<div class="d-flex flex-row-fluid justify-content-center">
												<!--begin::Form-->
												<form @submit.prevent="hire()" class="pt-10 w-100 w-md-400px w-xl-500px" novalidate="novalidate" id="kt_stepper_form">
													<!--begin::Step 1-->
													<div class="current" data-kt-stepper-element="content">
														<div class="w-100">
															<!--begin::Heading-->
															<div class="pb-10 pb-lg-15">
																<h3 class="fw-bolder text-dark display-6">Personal info</h3>
																<div class="text-muted fw-bold fs-3">Having Issues? 
																<a class="text-primary fw-bolder">Get Help</a></div>
															</div>
															<!--begin::Heading-->
															<!--begin::Form Group-->
															<div class="fv-row mb-10">
																<label class="fs-6 form-label fw-bolder text-dark">Full Name</label>
																<input v-model="form.fullname" type="text" class="form-control form-control-lg form-control-solid" name="name" placeholder="Jenus Alakere" value="" />
															</div>
															<!--end::Form Group-->
															
															<!--begin::Form Group-->
															<div class="fv-row mb-10">
																<label class="fs-6 form-label fw-bolder text-dark">Username/ID</label>
																<input @keyup="checkAvailability('username')" v-model="form.username" type="text" class="form-control form-control-lg form-control-solid" name="username" placeholder="JJenus" value="" />
																<div v-if="error.username" class="text-danger text-muted">
																  {{error.username}} 
																</div>
															</div>
															<!--end::Form Group-->
															
															<!--begin::Form Group-->
															<div class="fv-row mb-10">
																<label class="fs-6 form-label fw-bolder text-dark">Email</label>
																<input @keyup="checkAvailability('email')" v-model="form.email" type="text" class="form-control form-control-lg form-control-solid" name="email" placeholder="JJenus@gmail.com" value="" />
																<div v-if="error.email" class="text-danger text-muted">
																  {{error.email}} 
																</div>
															</div>
															<!--end::Form Group-->
															
															<!--begin::Form Group-->
															<div class="fv-row mb-10">
															  <label class="fs-6 form-label fw-bolder text-dark">Gender </label>
																<div class="d-flex">
  																<div class="form-check me-3  form-check-lg form-check-custom form-check-solid">
                                    <input @click="form.gender='male'" name="gender" class="form-check-input" type="radio" value="" id="flexRadioDefault"/>
                                    <label class="form-check-label" for="flexRadioDefault">
                                        Male
                                    </label>
                                  </div>
  																<div class="form-check form-check-lg form-check-custom form-check-solid">
                                    <input @click="form.gender='female'" name="gender" class="form-check-input" type="radio" value="" id="flexRadioDefault"/>
                                    <label class="form-check-label" for="flexRadioDefault">
                                        Female 
                                    </label>
                                  </div>
																</div>
															</div>
															<!--end::Form Group-->
															
															<!--begin::Form Group-->
															<div class="fv-row mb-10">
															  <label class="fs-6 form-label fw-bolder text-dark">Role </label>
																<!--begin::Row-->
      													<div class="row" data-kt-buttons="true">
      														<input @click="form.role='washer'" type="radio" class="btn-check" name="role" value="washer" id="kt_form_fleet_1" />
      														<label  class="col btn btn-lg btn-outline btn-bg-light btn-color-gray-600 btn-active-light-primary border-dashed border-active py-5 px-4 m-2 min-w-90px" for="kt_form_fleet_1">
      															<span class="text-gray-800 fw-bold">Washer </span>
      														</label>
      														<input @click="form.role='ironer'" type="radio" class="btn-check" name="role" value="ironer" id="kt_form_fleet_2" />
      														<label class="col btn btn-lg btn-outline btn-bg-light btn-color-gray-600 btn-active-light-primary border-dashed border-active  py-5 px-4 m-2 min-w-90px" for="kt_form_fleet_2">
      															<span class="text-gray-800 fw-bold">Ironer</span>
      														</label>
      														<input @click="form.role='receptionist'" type="radio" class="btn-check" name="role" checked="checked" value="receptionist" id="kt_form_fleet_3" />
      														<label  class="col active btn btn-lg btn-outline btn-bg-light btn-color-gray-600 btn-active-light-primary border-dashed border-active py-5 px-4 m-2 min-w-90px" for="kt_form_fleet_3">
      															<span class="text-gray-800 fw-bold">Receptionist</span>
      														</label>
      														<input @click="form.role='manager'" type="radio" class="btn-check" name="role" value="manager" id="kt_form_fleet_4" />
      														<label class="col btn btn-lg btn-outline btn-bg-light btn-color-gray-600 btn-active-light-primary border-dashed border-active py-5 px-4 m-2 min-w-90px" for="kt_form_fleet_4">
      															<span class="text-gray-800 fw-bold">Manager</span>
      														</label>
      													</div>
      													<!--end::Row--> 
															</div>
															<!--end::Form Group-->
															
															<!--begin::Form Group-->
															<div class="fv-row mb-10">
																<label class="fs-6 form-label fw-bolder text-dark">Password</label>
																<input v-model="form.password" type="text" class="form-control text-center fw-bolder form-control-lg form-control-solid" name="password" placeholder="" value="" />
															</div>
															<!--end::Form Group-->
														</div>
													</div>
													<!--end::Step 1-->
													<!--begin::Step 2-->
													<div class="" data-kt-stepper-element="content">
														<div class="w-100">
															<!--begin::Heading-->
															<div class="pb-10 pb-lg-15">
																<h3 class="fw-bolder text-dark display-6">Contact Address</h3>
																<div class="text-muted fw-bold fs-3">Have a Different Address ? 
																<a href="#" class="text-primary fw-bolder">Add Address</a></div>
															</div>
															<!--end::Heading-->
															<!--begin::Form Group-->
															<div class="fv-row mb-10">
																<label class="fs-6 form-label fw-bolder text-dark">Address</label>
																<input v-model="form.address" type="text" class="form-control form-control-lg form-control-solid" name="address" placeholder="" value="Address Line" />
															</div>
															<!--begin::Form Group-->
															<!--end::Row-->
															<div class="fv-row row">
																<div class="col-lg-6 col-md-6">
																	<!--end::Form Group-->
																	<div class="">
																		<label class="fs-6 form-label fw-bolder text-dark">City</label>
																		<input v-model="form.city" type="text" class="form-control form-control-lg form-control-solid" name="city" placeholder="" value="Melbourne" />
																	</div>
																	<!--begin::Form Group-->
																</div>
																<div class="col-lg-6 col-md-6">
																	<!--end::Form Group-->
																	<div class="">
																		<label class="fs-6 form-label fw-bolder text-dark">Phone</label>
																		<input v-model="form.phone" type="text" class="form-control form-control-lg form-control-solid" name="phone" placeholder="" />
																	</div>
																	<!--begin::Form Group-->
																</div>
															</div>
															<!--begin::Row-->
														</div>
													</div>
													<!--end::Step 2-->
													<!--begin::Step 3-->
													<div class="" data-kt-stepper-element="content">
														<div class="w-100">
															<!--begin::Heading-->
															<div class="pb-10 pb-lg-15">
																<h3 class="fw-bolder text-dark display-6">Photo</h3>
																<div class="text-muted fw-bold fs-3">most recent image is advised? 
																<a href="#" class="text-primary fw-bolder">Get Help</a></div>
															</div>
															<!--begin::Image-->
    													<div class="d-flex align-items-center justify-content-center bgi-no-repeat bgi-size-cover rounded min-h-250px" :style="bgImage">
														  	<!--begin::Row-->
      													<div class="row " data-kt-buttons="true">
      														<input @change="readURL(this)" type="file" accept="image/*;capture=camera" class="btn-check" name="photo" id="kt_form_photo_1" />
      														<label  class="col active bg-transparent btn btn-lg btn-outline btn-bg-light btn-color-gray-600 btn-active-light-primary border-dashed border-active py-5 px-4 m-2 min-w-90px" for="kt_form_photo_1">
      															<span class="text-gray-800 fw-bold">Select/Capture</span>
      														</label>
      													</div>
      													<!--end::Row--> 
    													</div>
    													<!--end::Image-->
														</div>
													</div>
													<!--end::Step 3-->
													<!--begin::Step 4-->
													<div class="" data-kt-stepper-element="content">
														<div class="w-100">
															<!--begin::Heading-->
															<div class="pb-10 pb-lg-15">
																<h3 class="fw-bolder text-dark display-6">Bank details</h3>
																<div class="text-muted fw-bold fs-3">
																  Add employee's bank account details
																</div>
															</div>
															<!--begin::Heading-->
															<div class="row">
																<div class="col-xl-6">
																	<!--begin::Input-->
																	<div class="mb-10">
																		<label class="fs-6 form-label fw-bolder text-dark form-label">Bank</label>
																		<input v-model="form.bank" type="text" class="form-control form-control-lg form-control-solid" name="bank" placeholder="City bank" />
																		<span class="form-text text-muted">Please enter your Bank Name.</span>
																	</div>
																	<!--end::Input-->
																</div>
																<div class="col-xl-6">
																	<!--begin::Input-->
																	<div class="mb-10">
																		<label class="fs-6 form-label fw-bolder text-dark form-label">Account Name</label>
																		<input v-model="form.accountname" type="text" class="form-control form-control-lg form-control-solid" name="accountname" placeholder="Neil Armstrong" />
																		<span class="form-text text-muted">Please enter your account name.</span>
																	</div>
																	<!--end::Input-->
																</div>
															</div>
															<div class="row">
																<div class="col-xl-4">
																	<!--begin::Input-->
																	<div class="mb-10">
																		<label class="fs-6 form-label fw-bolder text-dark form-label">Account Number</label>
																		<input v-model="form.accountnumber" type="number" class="form-control form-control-lg form-control-solid" name="accountnumber" placeholder="1006478902" />
																		<span class="form-text text-muted">Please enter your Account Number .</span>
																	</div>
																	<!--end::Input-->
																</div>
															</div>
														</div>
													</div>
													<!--end::Step 4-->
													<!--begin::Step 5-->
													<div class="" data-kt-stepper-element="content">
														<div class="w-100">
															<!--begin::Heading-->
															<div class="pb-10 pb-lg-15">
																<h3 class="fw-bolder text-dark display-6">Complete</h3>
																<div class="text-muted fw-bold fs-3">Complete Registration!</div>
															</div>
															<!--end::Heading-->
															<div v-if="errors" class="p-4 mb-4 alert alert-danger">
															  <ul>
															    <li v-for="error in errors">{{error}}</li>
															  </ul>
															</div>
															<!--begin::Section-->
															<h4 class="fw-bolder mb-3">Personal info:</h4>
															<div class="d-flex align-items-center justify-content-center text-gray-600 fw-bold lh-lg mb-8">
															  <!--begin::Symbol-->
      													<div class="symbol symbol-200px ">
      														<span class="symbol-label bg-light align-items-center">
      															<img alt="Logo" :src="form.photo" class="mh-200px" />
      														</span>
      													</div>
      													<!--end::Symbol--> 
															</div>
															
															<div class="text-gray-600 fw-bold lh-lg mb-8">
																<div class="fw-bolder">{{form.fullname}}</div>
																<div><span class="fw-bold">{{form.username}}</span> <span class="fs-9 text-muted">write down your username</span></div>
																<div>{{form.email}} </div>
																<div>{{form.gender}}</div>
																<div>{{form.role}}</div>
																<div>Password: {{form.password}}</div>
															</div>
															<!--end::Section-->
															<!--begin::Section-->
															<h4 class="fw-bolder mb-3">Contact Address:</h4>
															<div class="text-gray-600 fw-bold lh-lg mb-8">
																<div>{{form.address}} </div>
																<div>{{form.city}}</div>
																<div>{{form.phone}}</div>
															</div>
															<!--end::Section-->
															<!--begin::Section-->
															<h4 class="fw-bolder mb-3">Bank Details:</h4>
															<div class="text-gray-600 fw-bold lh-lg mb-8">
																<div>{{form.bank}}</div> 
																<div>{{form.accountname}}</div> 
																<div>{{form.accountnumber}}</div> 
															</div>
															<!--end::Section-->
														</div>
													</div>
													<!--end::Step 5-->
													<!--begin::Actions-->
													<div class="d-flex justify-content-between pt-10">
														<div class="mr-2">
															<button type="button" class="btn btn-lg btn-light-primary fw-bolder py-4 pe-8 me-3" data-kt-stepper-action="previous">
															<!--begin::Svg Icon | path: icons/stockholm/Navigation/Left-2.svg-->
															<span class="svg-icon svg-icon-4 me-1">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24" />
																		<rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000)" x="14" y="7" width="2" height="10" rx="1" />
																		<path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997)" />
																	</g>
																</svg>
															</span>
															<!--end::Svg Icon-->Previous
															</button>
														</div>
														<div>
															<button id="btn-kt-hire" type="button" class="btn btn-lg btn-primary fw-bolder py-4 ps-8 me-3" data-kt-stepper-action="submit">
															  <span class="indicator-label">
                                    Submit
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span> 
  															<!--begin::Svg Icon | path: icons/stockholm/Navigation/Right-2.svg-->
  															<span class="svg-icon svg-icon-4 ms-2">
  																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
  																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
  																		<polygon points="0 0 24 0 24 24 0 24" />
  																		<rect fill="#000000" opacity="0.5" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
  																		<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
  																	</g>
  																</svg>
  															</span>
  															<!--end::Svg Icon-->
															</button>
															<button type="button" class="btn btn-lg btn-primary fw-bolder py-4 ps-8 me-3" data-kt-stepper-action="next">Next Step 
															<!--begin::Svg Icon | path: icons/stockholm/Navigation/Right-2.svg-->
															<span class="svg-icon svg-icon-4 ms-1">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24" />
																		<rect fill="#000000" opacity="0.5" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
																		<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
																	</g>
																</svg>
															</span>
															<!--end::Svg Icon-->
															</button>
														</div>
													</div>
													<!--end::Actions-->
													<button id="hire-btn" type="submit" class="d-none"></button>
												</form>
												<!--end::Form-->
											</div>
											<!--end::Content-->
										</div>
										<!--end::Stepper 1-->
									</div>
									<!--end::Card Body-->
								</div>
								<!--end::Card-->
								
								<?= view("temp/navbar") ?>
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
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		
<?= $this->endSection() ?>