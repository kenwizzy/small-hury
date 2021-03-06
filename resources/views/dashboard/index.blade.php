@extends('layouts.dashboard')
@section('content')


<div class="content-body">
  <div class="container pd-x-0">
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
      <div>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Welcome to Dashboard</h4>
      </div>

    </div>
  
    <div class="row row-xs">
      <div class="col-sm-6 col-lg-3">
        <div class="card card-body">
          <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total Customers</h6>
          <div class="d-flex d-lg-block d-xl-flex align-items-end">
            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">{{$customers->count()}}</h3>

          </div>
          <div class="chart-three">
            <div id="flotChart3" class="flot-chart ht-30"></div>
          </div><!-- chart-three -->
        </div>
      </div><!-- col -->
      <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
        <div class="card card-body">
          <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total Orders</h6>
          <div class="d-flex d-lg-block d-xl-flex align-items-end">
            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">{{$orders->count()}}</h3>

          </div>
          <div class="chart-three">
            <div id="flotChart4" class="flot-chart ht-30"></div>
          </div><!-- chart-three -->
        </div>
      </div><!-- col -->
      <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
        <div class="card card-body">
          <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total Products</h6>
          <div class="d-flex d-lg-block d-xl-flex align-items-end">
            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">{{$products->count()}}</h3>

          </div>
          <div class="chart-three">
            <div id="flotChart5" class="flot-chart ht-30"></div>
          </div><!-- chart-three -->
        </div>
      </div><!-- col -->
      <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
        <div class="card card-body">
          <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Completed Orders</h6>
          <div class="d-flex d-lg-block d-xl-flex align-items-end">
            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">{{$orderstatus->count()}}</h3>

          </div>

          <div class="chart-three">
            <div id="flotChart6" class="flot-chart ht-30"></div>
          </div><!-- chart-three -->
        </div>
      </div><!-- col -->
      {{---bEGIN OF COMMENT---}}
      {{--<div class="col-lg-8 col-xl-7 mg-t-10">
        <div class="card">
          <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
            <h6 class="mg-b-0">Recurring Revenue Growth</h6>
            <ul class="list-inline d-flex mg-t-20 mg-sm-t-10 mg-md-t-0 mg-b-0">
              <li class="list-inline-item d-flex align-items-center">
                <span class="d-block wd-10 ht-10 bg-df-1 rounded mg-r-5"></span>
                <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Growth Actual</span>
              </li>
              <li class="list-inline-item d-flex align-items-center mg-l-5">
                <span class="d-block wd-10 ht-10 bg-df-2 rounded mg-r-5"></span>
                <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Actual</span>
              </li>
              <li class="list-inline-item d-flex align-items-center mg-l-5">
                <span class="d-block wd-10 ht-10 bg-df-3 rounded mg-r-5"></span>
                <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Plan</span>
              </li>
            </ul>
          </div><!-- card-header -->
          <div class="card-body pos-relative pd-0">
            <div class="pos-absolute t-20 l-20 wd-xl-100p z-index-10">
              <div class="row">
                <div class="col-sm-5">
                  <h3 class="tx-normal tx-rubik tx-spacing--2 mg-b-5">$620,076</h3>
                  <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-10">MRR Growth</h6>
                  <p class="mg-b-0 tx-12 tx-color-03">Measure How Fast You???re Growing Monthly Recurring Revenue. <a href="">Learn More</a></p>
                </div><!-- col -->
                <div class="col-sm-5 mg-t-20 mg-sm-t-0">
                  <h3 class="tx-normal tx-rubik tx-spacing--2 mg-b-5">$1,200</h3>
                  <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-10">Avg. MRR/Customer</h6>
                  <p class="mg-b-0 tx-12 tx-color-03">The revenue generated per account on a monthly or yearly basis. <a href="">Learn More</a></p>
                </div><!-- col -->
              </div><!-- row -->
            </div>

            <div class="chart-one">
              <div id="flotChart" class="flot-chart"></div>
            </div><!-- chart-one -->
          </div><!-- card-body -->
        </div><!-- card -->
      </div>
      <div class="col-lg-4 col-xl-5 mg-t-10">
        <div class="card">
          <div class="card-header pd-t-20 pd-b-0 bd-b-0">
            <h6 class="mg-b-5">Account Retention</h6>
            <p class="tx-12 tx-color-03 mg-b-0">Number of customers who have active subscription with you.</p>
          </div><!-- card-header -->
          <div class="card-body pd-20">
            <div class="chart-two mg-b-20">
              <div id="flotChart2" class="flot-chart"></div>
            </div><!-- chart-two -->
            <div class="row">
              <div class="col-sm">
                <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">$1,680<small>.50</small></h4>
                <p class="tx-11 tx-uppercase tx-spacing-1 tx-semibold mg-b-10 tx-primary">Expansions</p>
                <div class="tx-12 tx-color-03">Customers who have upgraded the level of your products.</div>
              </div><!-- col -->
              <div class="col-sm mg-t-20 mg-sm-t-0">
                <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">$1,520<small>.00</small></h4>
                <p class="tx-11 tx-uppercase tx-spacing-1 tx-semibold mg-b-10 tx-pink">Cancellations</p>
                <div class="tx-12 tx-color-03">Customers who have ended their subscription.</div>
              </div><!-- col -->
            </div><!-- row -->
          </div><!-- card-body -->
        </div><!-- card -->
      </div>--}}
      <div class="col-md-6 col-xl-4 mg-t-10 order-md-1 order-xl-0">
        <div class="card ht-lg-100p">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="mg-b-0">Store Order Statistics</h6>
            <div class="tx-13 d-flex align-items-center">

            </div>
          </div><!-- card-header -->
          <div class="card-body pd-0">

            <div class="table-responsive">
              <table class="table table-borderless table-dashboard table-dashboard-one">
                <thead>
                  <tr>
                    <th class="wd-40">Location</th>
                    <th class="wd-25 text-right">Orders</th>
                    <th class="wd-35 text-right">Earnings</th>
                  </tr>
                </thead>
                <tbody>
                
                @foreach($charts as $chart)
                  <tr>
                    <td class="tx-medium">{{$chart->name.' Store'??''}}</td>
                    <td class="text-right">{{$chart->orders_count??''}}</td>
                    <td class="text-right">&#8358;{{number_format($chart->amt??'')}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div><!-- table-responsive -->
          </div><!-- card-body -->
        </div><!-- card -->
      </div><!-- col -->
      <div class="col-lg-12 col-xl-8 mg-t-10">
        <div class="card mg-b-10">



        <canvas id="myChart"></canvas>



          {{--<div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
            <div>
              <h6 class="mg-b-5">Your Most Recent Earnings</h6>
              <p class="tx-13 tx-color-03 mg-b-0">Your sales and referral earnings over the last 30 days</p>
            </div>
            <div class="d-flex mg-t-20 mg-sm-t-0">
              <div class="btn-group flex-fill">
                <button class="btn btn-white btn-xs active">Range</button>
                <button class="btn btn-white btn-xs">Period</button>
              </div>
            </div>
          </div><!-- card-header -->
          <div class="card-body pd-y-30">
            <div class="d-sm-flex">
              <div class="media">
                <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                  <i data-feather="bar-chart-2"></i>
                </div>
                <div class="media-body">
                  <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Gross Earnings</h6>
                  <h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">$1,958,104</h4>
                </div>
              </div>
              <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-pink tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-5">
                  <i data-feather="bar-chart-2"></i>
                </div>
                <div class="media-body">
                  <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">Tax Withheld</h6>
                  <h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">$234,769<small>.50</small></h4>
                </div>
              </div>
              <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                  <i data-feather="bar-chart-2"></i>
                </div>
                <div class="media-body">
                  <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">Net Earnings</h6>
                  <h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">$1,608,469<small>.50</small></h4>
                </div>
              </div>
            </div>
          </div><!-- card-body -->
          <div class="table-responsive">
            <table class="table table-dashboard mg-b-0">
              <thead>
                <tr>
                  <th>Date</th>
                  <th class="text-right">Sales Count</th>
                  <th class="text-right">Gross Earnings</th>
                  <th class="text-right">Tax Withheld</th>
                  <th class="text-right">Net Earnings</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tx-color-03 tx-normal">03/05/2018</td>
                  <td class="tx-medium text-right">1,050</td>
                  <td class="text-right tx-teal">+ $32,580.00</td>
                  <td class="text-right tx-pink">- $3,023.10</td>
                  <td class="tx-medium text-right">$28,670.90 <span class="mg-l-5 tx-10 tx-normal tx-success"><i class="icon ion-md-arrow-up"></i> 4.5%</span></td>
                </tr>
                <tr>
                  <td class="tx-color-03 tx-normal">03/04/2018</td>
                  <td class="tx-medium text-right">980</td>
                  <td class="text-right tx-teal">+ $30,065.10</td>
                  <td class="text-right tx-pink">- $2,780.00</td>
                  <td class="tx-medium text-right">$26,930.40 <span class="mg-l-5 tx-10 tx-normal tx-danger"><i class="icon ion-md-arrow-down"></i> 0.8%</span></td>
                </tr>
                <tr>
                  <td class="tx-color-03 tx-normal">03/04/2018</td>
                  <td class="tx-medium text-right">980</td>
                  <td class="text-right tx-teal">+ $30,065.10</td>
                  <td class="text-right tx-pink">- $2,780.00</td>
                  <td class="tx-medium text-right">$26,930.40 <span class="mg-l-5 tx-10 tx-normal tx-danger"><i class="icon ion-md-arrow-down"></i> 0.8%</span></td>
                </tr>
                <tr>
                  <td class="tx-color-03 tx-normal">03/04/2018</td>
                  <td class="tx-medium text-right">980</td>
                  <td class="text-right tx-teal">+ $30,065.10</td>
                  <td class="text-right tx-pink">- $2,780.00</td>
                  <td class="tx-medium text-right">$26,930.40 <span class="mg-l-5 tx-10 tx-normal tx-danger"><i class="icon ion-md-arrow-down"></i> 0.8%</span></td>
                </tr>
                <tr>
                  <td class="tx-color-03 tx-normal">03/04/2018</td>
                  <td class="tx-medium text-right">980</td>
                  <td class="text-right tx-teal">+ $30,065.10</td>
                  <td class="text-right tx-pink">- $2,780.00</td>
                  <td class="tx-medium text-right">$26,930.40 <span class="mg-l-5 tx-10 tx-normal tx-danger"><i class="icon ion-md-arrow-down"></i> 0.8%</span></td>
                </tr>
              </tbody>
            </table>
          </div>--}}
        </div>


      </div><!-- col -->
      <div class="col-md-6 col-xl-6 mg-t-10">
        <div class="card ht-100p">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="mg-b-0">Orders</h6>
            <div class="d-flex tx-18">
              <a href="" class="link-03 lh-0"><i class="icon ion-md-refresh"></i></a>
              <a href="" class="link-03 lh-0 mg-l-10"><i class="icon ion-md-more"></i></a>
            </div>
          </div>
          <ul class="list-group list-group-flush tx-13">
            @foreach($orders as $ord)
            <li class="list-group-item d-flex pd-sm-x-20">
              <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle {{$ord->starus->name=='Cancelled' ||$ord->starus->name=='Declined'?'bg-danger':'bg-teal'}}"><i class="icon {{$ord->starus->name=='Cancelled' ||$ord->starus->name=='Declined'?'ion-md-close':'ion-md-checkmark'}}"></i></span></div>
              <div class="pd-sm-l-10">
                <p class="tx-medium mg-b-0">Payment from {{$ord->id}}</p>
                <small class="tx-12 tx-color-03 mg-b-0">{{$ord->created_at}}</small>
              </div>
              <div class="mg-l-auto text-right">
                <p class="tx-medium mg-b-0">&#8358;{{number_format($ord->total_paid)}}</p>
                <small class="tx-12 {{$ord->starus->name=='Cancelled' ||$ord->starus->name=='Declined'?'tx-danger':'tx-success'}} mg-b-0">{{$ord->starus->name}}</small>
              </div>
            </li>
            
           @endforeach 
          </ul>
          <div class="card-footer text-center tx-13">
            <a href="{{route('dashboard.orders')}}" class="link-03">View All Transactions <i class="icon ion-md-arrow-down mg-l-5"></i></a>
          </div><!-- card-footer -->
        </div><!-- card -->
      </div>
      <div class="col-md-6 col-xl-6 mg-t-10">
        <div class="card ht-100p">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="mg-b-0">New Customers</h6>
          </div>
          <ul class="list-group list-group-flush tx-13">
        @foreach($customers as $cus)
            <li class="list-group-item d-flex pd-sm-x-20">
              <div class="avatar"><span class="avatar-initial rounded-circle bg-gray-600">{{substr($cus->first_name,0,1)}}</span></div>
              <div class="pd-l-10">
                <p class="tx-medium mg-b-0">{{ucfirst($cus->first_name)}} {{ucfirst($cus->last_name)}}</p>
                <small class="tx-12 tx-color-03 mg-b-0">Registered Date {{$cus->created_at}}</small>
              </div>
              <div class="mg-l-auto d-flex align-self-center">
                <nav class="nav nav-icon-only">

                  <a href="" class="nav-link d-none d-sm-block"><i data-feather="user"></i></a>
                  <a href="" class="nav-link d-sm-none"><i data-feather="more-vertical"></i></a>
                </nav>
              </div>
            </li>
        @endforeach    
            
          </ul>
          <div class="card-footer text-center tx-13">
            <a href="{{route('dashboard.users')}}" class="link-03">View More Customers <i class="icon ion-md-arrow-down mg-l-5"></i></a>
          </div><!-- card-footer -->
        </div><!-- card -->
      </div>
      {{--<div class="col-md-6 col-xl-4 mg-t-10">
        <div class="card ht-lg-100p">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="mg-b-0">Real-Time Sales</h6>
            <ul class="list-inline d-flex mg-b-0">
              <li class="list-inline-item d-flex align-items-center">
                <span class="d-block wd-10 ht-10 bg-df-2 rounded mg-r-5"></span>
                <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Today</span>
              </li>
              <li class="list-inline-item d-flex align-items-center mg-l-10">
                <span class="d-block wd-10 ht-10 bg-df-3 rounded mg-r-5"></span>
                <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Yesterday</span>
              </li>
            </ul>
          </div><!-- card-header -->
          <div class="card-body pd-b-0">
            <div class="row mg-b-20">
              <div class="col">
                <h5 class="tx-normal tx-rubik tx-spacing--1 mg-b-10">$150,200 <small class="tx-11 tx-success letter-spacing--2"><i class="icon ion-md-arrow-up"></i> 0.20%</small></h5>
                <p class="tx-10 tx-uppercase tx-spacing-1 tx-medium tx-color-03">Total Sales</p>
              </div>
              <div class="col">
                <h5 class="tx-normal tx-rubik tx-spacing--1 mg-b-10">$21,880 <small class="tx-11 tx-danger letter-spacing--2"><i class="icon ion-md-arrow-down"></i> 1.04%</small></h5>
                <p class="tx-10 tx-uppercase tx-spacing-1 tx-medium tx-color-03">Avg. Sales Per Day</p>
              </div>
            </div><!-- row -->
            <div class="chart-five">
              <div><canvas id="chartBar1"></canvas></div>
            </div>
          </div><!-- card-body -->
        </div>
      </div>--}}
    </div><!-- row -->
  </div><!-- container -->
</div>


@endsection
@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December'],
      datasets: [{
          label: 'Revenues',
          data: [{{$jan}}, {{$feb}}, {{$mar}}, {{$apr}}, {{$may}}, {{$jun}}, {{$jul}}, {{$aug}}, {{$sep}}, {{$oct}}, {{$nov}}, {{$dec}}],
          backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1,
      }]
  },
  options: {
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero: true
              }
          }]
      }
  }
});
</script>

@endsection