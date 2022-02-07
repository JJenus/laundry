eventBus = new Vue();

Vue.component("search-card", {
  props: ["clothe", "permissions"],
  data(){
    return {
      actions: {
        showDetails: false, 
        pay:false
      }, 
      inputs:{
        amount_paid:null, 
        debt:null, 
        credit:null, 
      }, 
      currency: "$"
    };
  },
  computed: {
    getStatusFlag(){
      return this.clothe.status == "ready" ? "btn-light-warning":this.clothe.status == "pending"? "btn-light-danger":"btn-light-primary";
    }, 
   
  }, 
  methods:{
   
    date($date){
      if (!$date) {
        return 'unknown';
      }
      return (moment($date, 'YYYY-MM-DD HH:mm:ss')).format("LLLL");
    }, 
    
    dispensed(){
      if (this.clothe.dispensed_at) {
          return true;
      }
      return false;
    },
    
    disable($type){
      return this.clothe.status === $type || this.dispensed() || ($type=="ironed" && this.clothe. status=="pending") || ($type=="washed" && this.clothe.status=="ironed")  || this.clothe.status === "ready";
    }, 
    
    activate(action){
      console.log(action);
      $("#activate-btn"+this.clothe.id)[0].setAttribute("data-kt-indicator", "on");
      $.ajax({
        url: `${base_url}/clothes/${this.clothe.id}/${action}`, 
        method: "GET",
        success: (res)=>{
          console.log(res);
          if (res.status) {
            this.clothe = res.data;
            //console.log("success"); 
            notify("success", "Done");
          }
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        $("#activate-btn"+this.clothe.id)[0].removeAttribute("data-kt-indicator");
      });
    },
    hasPermission($perm){
      var result = false;
      for(let e in this.permissions){
        if (this.permissions[e] === $perm) {
          result = true;
          break;
        }
      }
      return result;
    } 
  }, 
  
  template: `
		<div class="col-md-4 col-lg-12 col-xxl-4">
		
			<div class="card mb-0 mb-md-5 mb-lg-0 mb-xxl-8 overflow-hidden">
				<div class="card-body p-0 d-flex card-rounded bg-light-success">
					<div class="py-10 px-7">
						<h3 class="fs-2x">
							<a class="text-dark text-hover-primary fw-bolder" data-bs-toggle="modal" :data-bs-target="'#kt_modal_'+clothe.id">
							  {{clothe.id}}
							</a>
						</h3>
						
						<div class="d-flex flex-column mb-3 fw-bolder">
					    <span class="mb-3">Created at: {{date(clothe.created_at)}} </span>
					  </div>
					  
					  <div class="fs-1 d-flex d-flex-row">
					    <span :class="getStatusFlag" class="btn p-2 btn-sm me-3">
  					    {{clothe.status}}
  				    </span>
					    <button :disabled="disable('washed')"  v-if="hasPermission('app.clothes.wash')" :id="'activate-btn'+clothe.id" @click="activate('wash')" class="btn btn-block btn-sm btn-success">
					      <span class="indicator-label">
					        Activate Washed
					      </span>
					      <span class="indicator-progress">
                  Activating... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
					    </button>
					    <button :disabled="disable('ironed')" v-if="hasPermission('app.clothes.iron')" :id="'activate-btn'+clothe.id" @click="activate('iron')" class="btn btn-block btn-sm btn-success">
					      <span class="indicator-label">
					        Activate Ironed
					      </span>
					      <span class="indicator-progress">
                  Activating... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
					    </button>
					  </div>
					  
					</div>
				</div>
			</div>
		</div>
  `
});   

let app = new Vue({
  el: "#app", 
  data: {
    inputs: {
      search:"Bea", 
    }, 
    search:{
      limit:10,
      result:[],
    }, 
    clothes: [],
    user: {}
  },
  
  beforeMount(){
      this.getUser();
      this.searchDB(20,0);
    
  },
  
  computed:{
    
  },
  
  methods: {
    toTime($date){
      return (moment($date, 'YYYY-MM-DD HH:mm:ss')).format("hh:mm a");
    }, 
    
    getUser(){
      $.ajax({
        url: `${base_url}/app/user`, 
        method: "GET",
        success: (res)=>{
          if (res.status) {
            this.user = res.data;
          }
        },
        error: (err)=>{
          console.log(err);
        } 
      });
    }, 
    
    searchDB(limit, offset){
      $("#form-search-btn").attr("data-kt-indicator", "on");
      $.ajax({
        url: `${base_url}/search/clothes`, 
        method: "POST",
        data: {"limit":limit, "offset":offset, "q":this.inputs.search}, 
        success: (res)=>{
          //console.log(res);
          if (offset == 0) {
            this.clothes = [];
          }
          this.search.result = res;
          this.clothes.push(...res);
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        $("#form-search-btn").attr("data-kt-indicator", null);
      });
            
    }, 
    
  }
  // END OF DATA
});                                                                                                                                        
                                                                                                                                        