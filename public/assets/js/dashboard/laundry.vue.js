/**
 * Todo: complete revenue/activities share
 *       piechart, after writing a better seeder 
*/

Vue.component("clothe-comp", {
  props: ["index", "cpos", "clothe"],
  data(){
    return {
      actions: {
        created_by: "loading...",
        washed_by: "loading...",
        ironed_by: "loading...",
        dispensed_by: "loading...",
        confirmed_by: "loading...",
      } 
    };
  }, 
  mounted(){
    
    if (this.clothe.created_at != null) {
      this.getStaff("created_by", this.clothe.id);
    }
    if (this.clothe.washed_at != null) {
      this.getStaff("washed_by", this.clothe.id);
    }
    if (this.clothe.ironed_at != null) {
      this.getStaff("ironed_by", this.clothe.id);
    }
    if (this.clothe.ready_at != null) {
      this.getStaff("confirmed_by", this.clothe.id);
    }
    if (this.clothe.dispensed_at != null) {
      this.getStaff("dispensed_by", this.clothe.id);
    }
  },
  methods: {
    getStaff($key, $id){
      $.ajax({
        url: base_url+"/staffs/"+$id, 
        method: "get",
        success: (res)=>{
          //console.log(res);
          if(res)
            this.actions[$key] = res.name;
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        $("#btn-load-more").attr("data-kt-indicator", null);
      });
    },
    timeline($date){
      if(!$date)
        return "00:00";
      let date = (moment($date, 'YYYY-MM-DD HH:mm:ss')).format("hh:mm a, MMM DD yyyy");
      return date;
    }, 
  }, 
  template: `
    <div class="accordion-item ">
      <h2 class="accordion-header" id="flush-headingTwo">
        <button class="accordion-button fs-6 fw-bold py-0 collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="'#flush-collapseTwo'+cpos+'_'+index" aria-expanded="false" :aria-controls="'flush-collapseTwo'+cpos+'_'+index">
          <div class="table-responsive mb-0 pb-0">
            <table class="table mb-0 pb-0 table-borderless">
              <tr>
                <th><span class="fas fa-tshirt fs-1 text-primary"></span></th>
                <th>{{clothe.id}}</th>
                <th class="pe-3 ps-3">{{clothe.clotheType}}</th>
                <th>{{timeline(clothe.created_at)}}</th>
              </tr>
            </table>
          </div>
        </button>
      </h2>
      <div :id="'flush-collapseTwo'+cpos+'_'+index" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" :data-bs-parent="'#accordionFlush_'+index">
        <div class="accordion-body">
          <!--begin::Timeline-->
					<div class="timeline mt-3">
						<!--begin::Item-->
						<div class="timeline-item align-items-start pb-1">
							<!--begin::Label-->
							<div class="timeline-label fw-bolder text-gray-800 fs-6">
							  {{timeline(clothe.created_at)}} 
							</div>
							<!--end::Label-->
							<!--begin::Badge-->
							<div class="timeline-badge">
								<i class="fa fa-genderless fs-1 text-gray-200"></i>
							</div>
							<!--end::Badge-->
							<!--begin::Content-->
							<div class="timeline-content d-flex">
								<span class="fw-bolder text-gray-800 ps-3 pe-3">
								  Created
								</span>
								<!--begin::Symbol-->
								<div class="symbol symbol-35px bg-light-primary mt-n3 me-2 align-self-center">
									<span class="symbol-label bg-light align-items-end">
										<img alt="Logo" src="${base_url}/assets/media/svg/avatars/004-boy-1.svg" class="mh-25px" />
									</span>
								</div>
								<!--end::Symbol-->
								<!--begin::Symbol-->
								<div class=" mt-n3 align-self-end">
									<span>
									  {{actions.created_by}} 
									</span>
								</div>
								<!--end::Symbol-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Item-->
						<!--begin::Item-->
						<div v-if="clothe.washed_at" class="timeline-item align-items-start pb-1">
							<!--begin::Label-->
							<div class="timeline-label fw-bolder text-gray-800 fs-6">
							  {{timeline(clothe.washed_at)}} 
							</div>
							<!--end::Label-->
							<!--begin::Badge-->
							<div class="timeline-badge">
								<i class="fa fa-genderless fs-1 text-gray-200"></i>
							</div>
							<!--end::Badge-->
							<!--begin::Content-->
							<div class="timeline-content d-flex">
								<span class="fw-bolder text-gray-800 ps-3 pe-3">
								  Washed
								</span>
								<!--begin::Symbol-->
								<div class="symbol symbol-35px bg-light-primary mt-n3 me-2 align-self-center">
									<span class="symbol-label bg-light align-items-end">
										<img alt="Logo" src="${base_url}/assets/media/svg/avatars/004-boy-1.svg" class="mh-25px" />
									</span>
								</div>
								<!--end::Symbol-->
								<!--begin::Symbol-->
								<div class=" mt-n3 align-self-end">
									<span>
									  {{actions.washed_by}} 
									</span>
								</div>
								<!--end::Symbol-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Item-->
						<!--begin::Item-->
						<div v-if="clothe.ironed_at" class="timeline-item align-items-start pb-1">
							<!--begin::Label-->
							<div class="timeline-label fw-bolder text-gray-800 fs-6">
							  {{timeline(clothe.ironed_at)}}
							</div>
							<!--end::Label-->
							<!--begin::Badge-->
							<div class="timeline-badge">
								<i class="fa fa-genderless fs-1 text-gray-200"></i>
							</div>
							<!--end::Badge-->
							<!--begin::Content-->
							<div class="timeline-content d-flex">
								<span class="fw-bolder text-gray-800 ps-3 pe-3">
								  Ironed
								</span>
								<!--begin::Symbol-->
								<div class="symbol symbol-35px bg-light-primary mt-n3 me-2 align-self-center">
									<span class="symbol-label bg-light align-items-end">
										<img alt="Logo" src="${base_url}/assets/media/svg/avatars/004-boy-1.svg" class="mh-25px" />
									</span>
								</div>
								<!--end::Symbol-->
								<!--begin::Symbol-->
								<div class=" mt-n3 align-self-end">
									<span>
									  {{actions.ironed_by}} 
									</span>
								</div>
								<!--end::Symbol-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Item-->
						<!--begin::Item-->
						<div v-if="clothe.issue" class="timeline-item align-items-start pb-1">
							<!--begin::Label-->
							<div class="timeline-label fw-bolder text-danger fs-6">
							  {{timeline(clothe.issue.created_at)}}
							</div>
							<!--end::Label-->
							<!--begin::Badge-->
							<div class="timeline-badge">
								<i class="fa fa-genderless fs-1 text-gray-200"></i>
							</div>
							<!--end::Badge-->
							<!--begin::Content-->
							<div class="timeline-content d-flex">
								<span class="fw-bolder text-danger ps-3 pe-3">
								  Issue
								</span>
								<!--begin::Symbol-->
								
								<!--end::Symbol-->
								<!--begin::Symbol-->
									<span  class="fw-bold  ps-3 pe-3">
									  {{clothe.issue.created_at}}
									</span>
								<!--end::Symbol-->
								<!--begin::Symbol-->
								<div class=" mt-n3 align-self-start">
									<span>
									  {{clothe.issue.description}} 
									</span>
								</div>
								<!--end::Symbol-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Item-->
						<!--begin::Item-->
						<div v-if="clothe.ready_at"  class="timeline-item align-items-start pb-1">
							<!--begin::Label-->
							<div class="timeline-label fw-bolder text-primary fs-6">
							  {{timeline(clothe.ready_at)}} 
							</div>
							<!--end::Label-->
							<!--begin::Badge-->
							<div class="timeline-badge">
								<i class="fa fa-genderless fs-1 text-gray-200"></i>
							</div>
							<!--end::Badge-->
							<!--begin::Content-->
							<div class="timeline-content d-flex">
								<span class="fw-bolder text-primary ps-3 pe-3">
								  Ready 
								</span>
								<!--begin::Symbol-->
								<div class="symbol symbol-35px bg-light-primary mt-n3 me-2 align-self-center">
									<span class="symbol-label bg-light align-items-end">
										<img alt="Logo" src="${base_url}/assets/media/svg/avatars/004-boy-1.svg" class="mh-25px" />
									</span>
								</div>
								<!--end::Symbol-->
								<!--begin::Symbol-->
								<div class=" mt-n3 align-self-end">
									<span>
									  {{actions.confirmed_by}} 
									</span>
								</div>
								<!--end::Symbol-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Item-->
						
						<!--begin::Item-->
						<div v-if="clothe.dispensed_at"  class="timeline-item align-items-start pb-1">
							<!--begin::Label-->
							<div class="timeline-label fw-bolder text-primary fs-6">
							  {{timeline(clothe.dispensed_at)}} 
							</div>
							<!--end::Label-->
							<!--begin::Badge-->
							<div class="timeline-badge">
								<i class="fa fa-genderless fs-1 text-gray-200"></i>
							</div>
							<!--end::Badge-->
							<!--begin::Content-->
							<div class="timeline-content d-flex">
								<span class="fw-bolder text-primary ps-3 pe-3">
								  Dispensed 
								</span>
								<!--begin::Symbol-->
								<div class="symbol symbol-35px bg-light-primary mt-n3 me-2 align-self-center">
									<span class="symbol-label bg-light align-items-end">
										<img alt="Logo" src="${base_url}/assets/media/svg/avatars/004-boy-1.svg" class="mh-25px" />
									</span>
								</div>
								<!--end::Symbol-->
								<!--begin::Symbol-->
								<div class=" mt-n3 align-self-end">
									<span>
									  {{actions.dispensed_by}} 
									</span>
								</div>
								<!--end::Symbol-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Item-->
						
					</div>
					<!--end::Timeline-->
        </div>
      </div>
    </div>
                
  `
});

Vue.component("customer-comp", {
  props: ["customer", "index"],
  mounted(){
    console.log(this.customer.clothes);
  }, 
  computed:{
    role(){
      for(let i in this.staff.roles){
        return this.staff.roles[i];
      }
    }
  }, 
  methods:{
    getStatusFlag(){
      let flag = "";
      if (this.customer.status === "ready") {
        flag = "badge-light-success ";
      } else if(this.customer.status === "pending") {
        flag = "badge-light-warning";
      } else if (this.customer.status === "pending"){
        flag = "badge-light-danger";
      } else 
        flag = "badge-light-primary" ;
          
      return flag;
    },
    readyClothes(){
      var count = 0;
      for(let clothe of this.customer.clothes){
        if (clothe.status === "ready") {
          count++;
        }
      }
      return count;
    }, 
    date($date){
      if (!$date) {
        return 'unknown';
      }
      return (moment($date, 'YYYY-MM-DD HH:mm:ss')).format("LLLL");
    }, 
    dispensed(){
      for(let clothe of this.customer.clothes){
        if (!clothe.dispensed_at) {
          return false;
        }
      }
      return true;
    },
  }, 
  template: `
    <div class="col-6 mb-3 col-xl-4">
  		<!--begin::Modal - Select Location-->
  		<div class="modal fade" :id="'kt_modal_about_clothes_'+index" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  			<div class="modal-dialog modal-fullscreen" role="document">
  				<div class="modal-content">
  					<div class="modal-header border-0">
  						<div class="d-flex justify-content-between flex-column" >
  						  <h5 class="modal-title fs-2x">{{customer.name }}</h5>
                <div class="" >
                  <span :class="getStatusFlag()"  class="badge badge-lg">
      					    {{customer.status}}
      				    </span>
                </div> 
  						</div>
  						<!--begin::Close-->
  						<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal">
  							<!--begin::Svg Icon | path: icons/stockholm/Navigation/Close.svg-->
  							<span class="svg-icon svg-icon-2x">
  								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
  									<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
  										<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
  										<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
  									</g>
  								</svg>
  							</span>
  							<!--end::Svg Icon-->
  						</div>
  						<!--end::Close-->
  					</div>
  					<!-- HERE -->
  					<div class="modal-body">
  					  <table class="table mb-5  table-borderless fw-bold align-middle">
  							<thead>
  								<tr>
  									<th class="p-0 w-50px"></th>
  									<th class="p-0 min-w-150px"></th>
  							  </tr>
  						  </thead>
  						  <tbody>
  						    <tr>
  									<td class="px-0 py-3">
  										<div class="symbol symbol-55px mt-1 me-5">
  											<span class="symbol-label bg-light-primary align-items-end">
  												<img alt="Logo" src="${base_url}/assets/media/svg/avatars/001-boy.svg" class="mh-40px" />
  											</span>
  										</div>
  									</td>
  									<td class="px-0">
  										<a href="#" class="text-gray-800 fw-bolder text-hover-primary fs-6">Brad Simmons</a>
  										<span class="text-muted fw-bold d-block mt-1">{{customer.create_at}}</span>
  									</td>
  								</tr>
  								<tr class="">
  								  <td class="p-2">
  								    Cost:
  								  </td>
  								  <td class="p-2">{{customer.total_cost}} </td>
  								</tr>
  								<tr class="">
  								  <td class="p-2">
  								    Paid:
  								  </td>
  								  <td class="p-2">{{customer.amount_paid}}</td>
  								</tr>
  								<tr v-if="customer.credit">
  								  <td class="p-2" >
  								    Change:
  								  </td>
  								  <td class="p-2">{{customer.credit}}</td>
  								</tr>
  								<tr v-if="customer.debt">
  								  <td class="p-2" >
  								    Debt:
  								  </td>
  								  <td class="p-2">{{customer.debt}} </td>
  								</tr>
  						  </tbody>
  					  </table>
  					  <h5 class="fs-3 fw-bold">Clothes</h5>
              <div class="accordion accordion-flush" :id="'accordionFlush_'+index">
              
                <clothe-comp v-for="clothe in customer.clothes" :key="clothe.id" :index="index" :cpos="clothe.id"  :clothe="clothe"></clothe-comp>
              
              </div>
  				  </div>
  					<div class="modal-footer">
  						<button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">Close</button>
  					</div>
  				</div>
  			</div>
  		</div>
  		<!--end::Modal - Select Location-->
			
  		<div class="card mb-0 mb-md-5 mb-lg-0 mb-xxl-8 overflow-hidden">
  			<div class="card-body card-rounded bg-light-success">
  				<a class="text-dark text-hover-primary fw-bolder" data-bs-toggle="modal" :data-bs-target="'#kt_modal_about_clothes_'+index">
  					<div class="">
  						<h3 class="fs-2">
  							<span class="text-hover-primary fw-bolder">{{customer.name}}</a>
  						</h3>
  						<div class="fs-6 text-grey-100 mb-5">{{customer.id}}</div>
  					  <div class="fs-6 text-muted fw-bolder">
  					    {{customer.total_cost}} 
  					  </div>
  					  <div class="fs-3 mb-3">
  					    <span class="p me-6">
  					      <i class="fas fa-tshirt fs-2"></i>
  					      {{customer.clothes.length}} 
  					    </span>
  					    <span class=""><i class="bi bi-check2-square fs-2"></i> 
  					      {{readyClothes()}} 
  					    </span>
  					  </div>
  					  <span :class="getStatusFlag()" class="badge ">
  					    <span>{{customer.status}}</span>
  				    </span>
  					</div>
  				</a>
  			</div>
  		</div> 
  	</div>
  `
});

var App = new Vue({
  el: "#app", 
  data: {
    inputs: {
      search:"Bea", 
    }, 
    search:{
      limit:10,
      result:[],
    }, 
    customers: [], 
    selectRange:{
      today: "Today", 
      yesterday : "Yesterday", 
      week: "This Week", 
      lastweek: "Last Week", 
      month: "This Month", 
      lastmonth: "Last Month", 
    },
    stats: {
      clothes: 0, 
      ironed: 0, 
      dispensed: 0, 
      washed: 0, 
    }, 
    widget: {
      labels: [], 
      data: [], 
      colors: [], 
    } 
  },
  mounted(){
    this.searchDB(10, 0);
    this.loadStats("all", "week");
    this.getCategories();
  }, 
  methods: {
    
    loadStats(stat, selected){
      console.log(stat+': '+selected);
      $.ajax({
        url: base_url+"/clothes/stats/"+stat, 
        method: "GET",
        data: {date:selected}, 
        success: (res)=>{
          if(stat === "all"){
            this.stats = res;
          }else{
            this.stats[stat] = res[stat];
          }
          console.log(res);
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        
      });
    }, 
    
    searchDB(limit, offset){
      $.ajax({
        url: base_url+"/search/customers", 
        method: "POST",
        data: {"limit":limit, "offset":offset, "q":this.inputs.search}, 
        success: (res)=>{
          if (offset == 0) {
            this.customers = [];
          }
          this.search.result = res;
          this.customers.push(...res);
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        $("#btn-product").attr("data-kt-indicator", null);
      });
            
    },
      
    makeRandomColor(){
      var c = '';
      while (c.length < 6) {
        c += (Math.random()).toString(16).substr(-6).substr(-1)
      }
      return '#' + c;
    }, 
      
    percentage(val, arr){
      let rate = (val/arr.reduce((pre,sum)=>{
        return pre+sum;
      },0))*100;
      return Math.round(rate, 2)+'%';
    }, 
    
    // Stats widgets
    revenueShareWidget() {
        var element = document.querySelector("#kt_stats_widget_1_chart");

        if ( !element ) {
            return;
        }

        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };

        var tooltipBgColor = KTUtil.getCssVariableValue('--bs-gray-200');
        var tooltipColor = KTUtil.getCssVariableValue('--bs-gray-800');

        
        var colors = [];
        for (var i = 0; i < this.widget.data.length; i++) {
          this.widget.colors.push(this.makeRandomColor());
        }
        
        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: this.widget.data,
                    backgroundColor: this.widget.colors, 
                }],
                labels: this.widget.labels
            },
            options: {
                chart: {
                    fontFamily: 'inherit'
                },
                cutoutPercentage: 75,
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Technology'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                tooltips: {
                    enabled: true,
                    intersect: false,
                    mode: 'nearest',
                    bodySpacing: 5,
                    yPadding: 10,
                    xPadding: 10,
                    caretPadding: 0,
                    displayColors: false,
                    backgroundColor: tooltipBgColor,
                    bodyFontColor: tooltipColor,
                    cornerRadius: 4,
                    footerSpacing: 0,
                    titleSpacing: 0
                }
            }
        };

        var ctx = element.getContext('2d');
        var myDoughnut = new Chart(ctx, config);
    }, 
    
    getCategories(){
      $.ajax({
        url: base_url+"/clothes/categories", 
        method: "GET",
        data: {"stats":true}, 
        success: (res)=>{
          
          for (var i in res) {
            this.widget.data.push(res[i].count);
            this.widget.labels.push(res[i].name);
          }
          
          this.revenueShareWidget(); 
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        
      });
    }

  }
});

function onChange(stat,value){
  App.loadStats(stat, value);
}


