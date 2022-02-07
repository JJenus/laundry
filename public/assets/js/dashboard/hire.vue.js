var App = new Vue({
  el: "#app", 
  data: {
    form: {
      fullname: null, 
      username: null, 
      email: null, 
      gender: null, 
      role: "receptionist", 
      password: null, 
      phone: null, 
      address: null, 
      city: null, 
      bank: null, accountname:null, 
      accountnumber: null, 
      photo: base_url+'/assets/media/stock/900x600/3.jpg'
    }, 
    error: {
      username: null, 
      email: null, 
    }, 
    errors: null, 
    bgImage: null
  },
  mounted(){
    console.log("hello");
    this.bgImage = `background-image:url('${this.form.photo}')`; 
    this.getId();
  }, 
  methods: {
    readURL() {
      input = $("#kt_form_photo_1")[0];
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = (e)=> {
            this.bgImage = `background-image:url('${e.target.result}')`;           
            this.form.photo = e.target.result;
          };
          reader.readAsDataURL(input.files[0]);
        }
    }, 
    
    hire(){
      var form = new FormData($('#kt_stepper_form')[0]);
      $("#btn-kt-hire").attr("data-kt-indicator", "on");
      $.ajax({
        processData: false,
        contentType: false,
        url: base_url+"/register", 
        method: "POST",
        data: form, 
        success: (res)=>{
          //console.log(res);
          this.error = null;
          if(res.errors){
            res.errors = [];
            for(let i in res.errors)
              this.errors.push(res.errors[i]);
          } else{
            notify("success", "User successfully registered");
            setTimeout(function() {
              $('#kt_stepper_form')[0].reset();
            }, 1000);
          } 
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        $("#btn-kt-hire").attr("data-kt-indicator", null);
      });
    }, 
    
    getId(){
      $("#btn-load-more").attr("data-kt-indicator", "on");
      $.ajax({
        url: base_url+"/app/hire/generateId", 
        method: "GET",
        data: {}, 
        success: (res)=>{
          //console.log(res);
          this.form.username = res.id;
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        $("#btn-load-more").attr("data-kt-indicator", null);
      });
    },
    
    checkAvailability(login){
      login == "email"? this.error.email = null : this.error.username = null;
      if (this.form.username.length > 3) {
        
        $("#btn-load-more").attr("data-kt-indicator", "on");
        $.ajax({
          url: base_url+"/app/hire/checkAvailability", 
          method: "GET",
          data: {id: ((login=="email") ? this.form.email: this.form.username), field: login}, 
          success: (res)=>{
            //console.log(res);
            if (!res.id) {
              
              if(login == "email") 
                this.error.email = res.message ;
              else 
                this.error.username = res.message;                  
            }
          },
          error: (err)=>{
            console.log(err);
          } 
        }).always(()=>{
          $("#btn-load-more").attr("data-kt-indicator", null);
        });
      }else{
        login !== "email" ? this.error.username = "username must be more than 3 letters" : "";
      } 
      
    } 
  }
});