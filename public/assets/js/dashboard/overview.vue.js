
Vue.component("staff-card", {
  props: ["staff"],
  data(){
    return {
      reports: []
    };
  }, 
  mounted(){
    this.getReport();
  }, 
  computed:{
    role(){
      for(let i in this.staff.roles){
        return this.staff.roles[i];
      }
    }
  }, 
  methods:{
    remove($type, $key){
      if ($type === 'role') {
        delete this.staff.roles[$key];
        this.staff.roles = {...this.staff.roles};
      }
    }, 
    
    permission($str){
      //let arr = $str.split(".");
      return $str;//arr[arr.length-1];
    }, 
    
    getReport(){
      $.ajax({
        url: base_url+`/staffs/${this.staff.id}/report`, 
        method: "GET",
        success: (res)=>{
          this.reports = res;
        },
        error: (err)=>{
          console.log(err);
        } 
      });
    }
   
  }, 
  template: `
    <tr>
			<td class="p-0">
				<div class="symbol symbol-55px me-5">
					<span class="symbol-label bg-light-danger align-items-end">
						<img alt="Logo" src="${base_url}/assets/media/svg/avatars/018-girl-9.svg" class="mh-40px" />
					</span>
				</div>
			</td>
			<td class="px-3">
				<a href="#" class="text-gray-800 fw-bolder text-hover-primary fs-6">{{staff.name}}</a>
				<span class="text-muted fw-bold d-block mt-1">{{role}}</span>
			</td>
			<td class="p-0">
			  <div class="d-flex justify-content-start flex-wrap p-0">
				  <span v-for="(report, index) in reports" :key="index" class="badge mb-2 me-1 badge-light-dark">
				    {{index}} 
				    <span class="badge text-hover-danger ms-3 badge-light-danger">
				      {{report}} 
				    </span>
				  </span>
				</div>
			</td>
		</tr> 
  `
});

let VueApp = new Vue({
  el: "#app", 
  data: {
    selectedRange: "loading...", 
    revenue: 0,
    expenditure: 0,
    netProfit: 0,
    issues: {
      issues: 0,
      resolved: 0,
      unresolved: 0,
   },
    accounts: {
      revenue: 0,
      possible_returns: 0,
      expenses: 0,
      profit: 0,
   },
    staffs: [], 
    topStaffs: {
      "receptionist": [], 
      "drycleaners": [], 
    }, 
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
      labels: ['Revenue', 'Net Profit'], 
      data: [0,0], 
      colors: [], 
    }, 
  }, 
  computed:{
    profit(){
      return this.revenue - this.expenditure;
    }, 
    issueResolvedRate(){
      if (this.issues.issues < 1) 
        return 0;
      return ((this.issues.issues.resolved/this.issues.issues)*100);
    },                                                              
    accountsProfitRate(){
      if (this.accounts.profit < 1||this.accounts.loss<1) 
        return 0;
      return (( (this.accounts.loss||this.accounts.profit) /this.accounts.revenue)*100);
    }                                                                
  }, 
  mounted(){
    console.log("set up correctly");
    this. loadChatData();
    this.loadStats("all", "today");
    this.loadIssues("all");
    this.loadRevenue("all");
    this.revenueShareWidget();
    this.getTop("receptionist");
    this.getTop("drycleaners");
    this.getStaffs();
  }, 
  methods: {
    usable(reports){
      return reports.clothes || reports.washed || reports.ironed|| reports.confirmed || reports.dispensed;
    },  
    progressColor(rate){
      if(rate<=10)
        return "bg-danger";
      if(rate<=20)
        return "bg-warning";
      if(rate<=40)
        return "bg-success";
      
      return "bg-primary";
    }, 
    getTop(category){
      $.ajax({
        url: base_url+`/staffs`,
        data: {top: category}, 
        method: "GET",
        success: (res)=>{
          this.topStaffs[category] = res;
          console.log(this.topStaffs);
        },
        error: (err)=>{
          console.log(err);
        } 
      });
    }, 
    getStaffs(){
      $.ajax({
        url: base_url+"/staffs/", 
        method: "GET",
        success: (res)=>{
          this.staffs = res;
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        //nothing yet
      });
    },
    percentage(val, arr){
      let rate = (val/arr.reduce((pre,sum)=>{
        return pre+sum;
      },0))*100;
      return Math.round(rate, 2)+'%';
    },
    chatWidget(labels, data1, data2, initByDefault=true) {
        var element = document.querySelector("#kt_stats_widget_2_chart_1");
        var height = parseInt(KTUtil.css(element, 'height'));

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Revenue',
                data: data1
            }, {
                name: 'Expenditure',
                data: data2
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'bar',
                height: height,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['40%'],
                    endingShape: 'rounded'
                },
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: labels,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: KTUtil.getCssVariableValue('--bs-gray-700'),
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: KTUtil.getCssVariableValue('--bs-gray-700'),
                        fontSize: '12px'
                    }
                }
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return "$" + val + " thousands"
                    }
                }
            },
            colors: [KTUtil.getCssVariableValue('--bs-primary'), KTUtil.getCssVariableValue('--bs-light-primary')],
            grid: {
                borderColor: KTUtil.getCssVariableValue('--bs-gray-200'),
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(element, options);
           chart.render();
            
    }, 
    loadChatData(){
      $.ajax({
        url: base_url+"/customers/lastmonths", 
        method: "GET",
        success: (res)=>{
          console.log(res);
          let label = res.map(e=>e.month);
          let revenue = res.map(e=>e.total_cost);
          this.revenue = revenue.reduce((l,c) =>{return l+c} , 0);
          let expenses = res.map(e=>e.expenses);
          this.expenditure = expenses.reduce((l,c) =>{return l+c}, 0);
          this. chatWidget(label, revenue, expenses);
          this.widget.data = [this.revenue, Math.abs((this.revenue - this.expenditure))];
          this.revenueShareWidget();
        },
        error: (err)=>{
          console.log(err);
        } 
      })
    }, 
    loadStats(stat, date_range){
      $.ajax({
        url: base_url+"/clothes/stats/"+stat, 
        method: "GET",
        data: {date:date_range}, 
        success: (res)=>{
          if(stat === "all"){
            this.stats = res;
          }else{
            this.stats[stat] = res[stat];
          }
          this.selectedRange = date_range;
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        
      });
    },
    loadIssues(date_range){
      $.ajax({
        url: base_url+"/issues/stats", 
        method: "GET",
        data: {date:date_range}, 
        success: (res)=>{
          this.issues = res;
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        
      });
    },
    loadRevenue(date_range){
      $.ajax({
        url: base_url+"/accounts/stats", 
        method: "GET",
        data: {date:date_range}, 
        success: (res)=>{
          this.accounts = res;
          console.log(res );
        },
        error: (err)=>{
          console.log(err);
        } 
      }).always(()=>{
        
      });
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
        let color2 = "" 
        if(this.expenditure>this.revenue) {
          color2 = KTUtil.getCssVariableValue('--bs-danger');
          this.widget.labels = ['Revenue', 'Net Loss']; 
        } else {
          color2 = KTUtil.getCssVariableValue('--bs-primary');  
          this.widget.labels = ['Revenue', 'Net Profit']; 
        } 
        this.widget.colors = [
            KTUtil.getCssVariableValue('--bs-success'), 
            color2, 
          ]
        
        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: this.widget.data,
                    backgroundColor: this.widget.colors
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
  }, 
});

function onChange(stat,value){
  if(stat === "issues"){
   VueApp.loadIssues(value);
  }
  else if(stat === "revenue"){
   VueApp.loadRevenue(value);
  }
  else VueApp.loadStats(stat, value);
}