console.log("setup loaded")

let app = new Vue({
  el: "#app", 
  data: {
    progress: {
              installed: true, 
              isAdminCreated: false, 
              setupPermissions: true, 
              createPermissions: true, 
              createGroups: true, 
              migrated: true
            }, 
    installing: false, 
    errors: null, 
  },
  mounted(){
    //this.getProgress();
  }, 
  methods: {
    install($url, $btn="btn-install"){
      console.log("installing...");
      $("#"+$btn)[0].setAttribute("data-kt-indicator", "on"); 
      this.installing = true;
      $.ajax({
        url: `${base_url}setup/${$url}`, 
        method: "POST",
        success: (res)=>{
            console.log(res);
          if(res.status === "installed"){
            notify("success", "installation complete");
            this.progress = {
              installed: true, 
              isAdminCreated: false, 
              setupPermissions: true, 
              createPermissions: true, 
              createGroups: true, 
              migrated: true
            } 
          } 
          else if(!res.status){
            
          } 
        },
        error: (err)=>{
          console.log(err);
          if (!err.status) {
            
          }
        } 
      }).always(()=>{
        this.getProgress();
        this.installing = false;
        $("#"+$btn)[0].setAttribute("data-kt-indicator", null ); 
      });
    }, 
    submit(){
      this.errors = null;
      let form = $("#kt_signup_form").serializeArray();
      console.log("submitting...");
      $("#btn-submit")[0].setAttribute("data-kt-indicator", "on"); 
      $.ajax({
        url: `${base_url}setup/create-admin`, 
        method: "POST",
        data: form, 
        success: (res)=>{
          console.log(res);
          if(res.errors){
            this.errors = res.errors;
          }else if(res.success) {
           let str = res.success+". \n"+"Redirecting in 5 seconds.";
           notify("success", str);
           setTimeout(()=>{
             window.location.href = res.redirect;
           }, 5000);
           return 1;
          }
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        //this.getProgress();
        $("#btn-submit")[0].setAttribute("data-kt-indicator", null ); 
      });
    }, 
    getProgress(){
     // $("#btn-install")[0].setAttribute("data-kt-indicator", "on"); 
      this.installing = true;
      $.ajax({
        url: `${base_url}setup/progress`, 
        method: "GET",
        success: (res)=>{
          console.log(res);
          if (res.installed === true || res.installed === false) {
           this.progress = res;
          }
        },
        error: (err)=>{
          console.log(err);
          if (!err.status) {
            this.progress = {
              installed: false, 
              isAdminCreated: false, 
              setupPermissions: false, 
              createPermissions: false, 
              createGroups: false, 
              migrated: false
            };
          }
        } 
      }).always(()=>{
        this.installing = false;
      });
    }, 
  }
  // END OF DATA
});                                                                                                                                        
                                                                                                                                        