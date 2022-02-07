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
      image_url: base_url+'/assets/media/stock/900x600/3.jpg'
    }, 
    error: {
      username: null, 
      email: null, 
    }, 
    staff: null,  
    bgImage: null
  },
  mounted(){
    this.bgImage = `background-image:url('${this.form.photo}')`; 
    this.getStaff();
    this.setup();
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
    
    setup(){
      $("#info").submit((e)=>{
        e.preventDefault();
        this.save("info","btn-personal-info");
      });
      $("#bank").submit((e)=>{
        e.preventDefault();
        this.save("bank","btn-bank-info");
      });
      $("#contact").submit((e)=>{
        e.preventDefault();
        this.save("contact","btn-contact-address");
      });
    }, 
    
    save($source, btn){
      console.log('Saving... '+$source);
      var form = new FormData($('#'+$source)[0]);
      console.log(form);
      $("#"+btn).attr("data-kt-indicator", "on");
      $.ajax({
        processData: false,
        contentType: false,
        url: base_url+`/staffs/${this.staff.id}/update`, 
        method: "POST",
        data: form, 
        success: (res)=>{
          console.log(res);
          if (res.status) {
            notify("success", "Saved");
            this.form = res.data;
          }else {
            let str = "";
            for(let error in res.errors)
              str += res.errors[error] +"\n";
            notify("error", str);
          } 
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        $("#"+btn).attr("data-kt-indicator", null);
      });
    }, 
    getStaff(){
      $.ajax({
        url: base_url+"/staffs/0",
        data: {current_user:true}, 
        method: "GET",
        success: (res)=>{
          console.log(res);
          this.form = res;
          this.staff = res;
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        //nothing yet
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
            console.log(res);
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