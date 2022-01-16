<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">

  <title>Small Hurry</title>

  <!-- vendor css -->
  <link href="{{asset('lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{asset('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('lib/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/notiflix.css')}}" rel="stylesheet" type="text/css">

  <!-- DashForge CSS -->
  <link rel="stylesheet" href="{{asset('assets/css/dashforge.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/dashforge.dashboard.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bs4.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bs4-custom.css') }}" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tag-editor/1.0.20/jquery.tag-editor.css">
  <style>
    .container_create {
      width: 100%;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
    }

    .change{
        color:red;
    }
    .container_fields {
      width: 90%;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
    }

    .fields {
      width: 30%;
      /* display: flex; */
      /* flex-direction: row; */
      /* justify-content: space-between; */
      align-items: center;
    }

    .container_button {
      width: 10%;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
  @yield('css')
  @yield('styles')
</head>

<body>
  <style>
    * {
      font-family: 'Rubik', sans-serif;
    }

    .moove {
      color: #73ab22;
    }

    .activePage {
      color: #73ab22;
    }
  </style>

  {{---LEFT SIDEBAR---}}
  <aside class="aside aside-fixed">
      @if(!Auth::user())
     @php return redirect('index'); @endphp
      @endif
    @include('dashboard.partials.left-sidebar')
  </aside>

  <div class="content ht-100v pd-0">
    <div class="content-header">
      {{-- <div class="content-search">
          <i data-feather="search"></i>
          <input type="search" class="form-control" placeholder="Search...">
        </div> --}}
      <nav class="nav">
        {{-- <a href="" class="nav-link"><i data-feather="help-circle"></i></a>
          <a href="" class="nav-link"><i data-feather="grid"></i></a>
          <a href="" class="nav-link"><i data-feather="align-left"></i></a> --}}
      </nav>
    </div>

    @yield('content')

  </div>
  <script src="{{asset('lib/jquery/jquery.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" integrity="sha512-7x3zila4t2qNycrtZ31HO0NnJr8kg2VI67YLoRSyi9hGhRN66FHYWr7Axa9Y1J9tGYHVBPqIjSE1ogHrJTz51g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js.map"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/caret/1.3.4/jquery.caret.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tag-editor/1.0.20/jquery.tag-editor.js"></script>
  <script src="{{asset('lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
  <script src="{{asset('lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/js/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{asset('lib/jquery.flot/jquery.flot.js')}}"></script>
  <script src="{{asset('lib/jquery.flot/jquery.flot.stack.js')}}"></script>
  <script src="{{asset('lib/jquery.flot/jquery.flot.resize.js')}}"></script>
  <script src="{{asset('lib/chart.js/Chart.bundle.min.js')}}"></script>
  <script src="{{asset('lib/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{asset('lib/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <script src="{{asset('assets/js/axios.min.js')}}"></script>
  <script src="{{asset('assets/js/dashforge.js')}}"></script>
  <script src="{{asset('assets/js/dashforge.aside.js')}}"></script>
  <script src="{{asset('assets/js/dashforge.sampledata.js')}}"></script>
  <script src="{{ asset('assets/js/253d5420-ccbe-4671-89f8-956cd70c42bc.js') }}"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
  {{-- <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace()
    </script> --}}
  <script src="{{asset('assets/js/notiflix.js')}}"></script>
  <!-- append theme customizer -->
  <script src="{{asset('lib/js-cookie/js.cookie.js')}}"></script>
  <script src="{{asset('assets/js/dashforge.settings.js')}}"></script>
  @yield('script')

  <script>
    $(function() {
      'use strict'

      var plot = $.plot('#flotChart', [{
        data: df3,
        color: '#69b2f8'
      }, {
        data: df1,
        color: '#d1e6fa'
      }, {
        data: df2,
        color: '#d1e6fa',
        lines: {
          fill: false,
          lineWidth: 1.5
        }
      }], {
        series: {
          stack: 0,
          shadowSize: 0,
          lines: {
            show: true,
            lineWidth: 0,
            fill: 1
          }
        },
        grid: {
          borderWidth: 0,
          aboveData: true
        },
        yaxis: {
          show: false,
          min: 0,
          max: 350
        },
        xaxis: {
          show: true,
          ticks: [
            [0, ''],
            [8, 'Jan'],
            [20, 'Feb'],
            [32, 'Mar'],
            [44, 'Apr'],
            [56, 'May'],
            [68, 'Jun'],
            [80, 'Jul'],
            [92, 'Aug'],
            [104, 'Sep'],
            [116, 'Oct'],
            [128, 'Nov'],
            [140, 'Dec']
          ],
          color: 'rgba(255,255,255,.2)'
        }
      });


      $.plot('#flotChart2', [{
        data: [
          [0, 55],
          [1, 38],
          [2, 20],
          [3, 70],
          [4, 50],
          [5, 15],
          [6, 30],
          [7, 50],
          [8, 40],
          [9, 55],
          [10, 60],
          [11, 40],
          [12, 32],
          [13, 17],
          [14, 28],
          [15, 36],
          [16, 53],
          [17, 66],
          [18, 58],
          [19, 46]
        ],
        color: '#69b2f8'
      }, {
        data: [
          [0, 80],
          [1, 80],
          [2, 80],
          [3, 80],
          [4, 80],
          [5, 80],
          [6, 80],
          [7, 80],
          [8, 80],
          [9, 80],
          [10, 80],
          [11, 80],
          [12, 80],
          [13, 80],
          [14, 80],
          [15, 80],
          [16, 80],
          [17, 80],
          [18, 80],
          [19, 80]
        ],
        color: '#f0f1f5'
      }], {
        series: {
          stack: 0,
          bars: {
            show: true,
            lineWidth: 0,
            barWidth: .5,
            fill: 1
          }
        },
        grid: {
          borderWidth: 0,
          borderColor: '#edeff6'
        },
        yaxis: {
          show: false,
          max: 80
        },
        xaxis: {
          ticks: [
            [0, 'Jan'],
            [4, 'Feb'],
            [8, 'Mar'],
            [12, 'Apr'],
            [16, 'May'],
            [19, 'Jun']
          ],
          color: '#fff',
        }
      });

      $.plot('#flotChart3', [{
        data: df4,
        color: '#9db2c6'
      }], {
        series: {
          shadowSize: 0,
          lines: {
            show: true,
            lineWidth: 2,
            fill: true,
            fillColor: {
              colors: [{
                opacity: 0
              }, {
                opacity: .5
              }]
            }
          }
        },
        grid: {
          borderWidth: 0,
          labelMargin: 0
        },
        yaxis: {
          show: false,
          min: 0,
          max: 60
        },
        xaxis: {
          show: false
        }
      });

      $.plot('#flotChart4', [{
        data: df5,
        color: '#9db2c6'
      }], {
        series: {
          shadowSize: 0,
          lines: {
            show: true,
            lineWidth: 2,
            fill: true,
            fillColor: {
              colors: [{
                opacity: 0
              }, {
                opacity: .5
              }]
            }
          }
        },
        grid: {
          borderWidth: 0,
          labelMargin: 0
        },
        yaxis: {
          show: false,
          min: 0,
          max: 80
        },
        xaxis: {
          show: false
        }
      });

      $.plot('#flotChart5', [{
        data: df6,
        color: '#9db2c6'
      }], {
        series: {
          shadowSize: 0,
          lines: {
            show: true,
            lineWidth: 2,
            fill: true,
            fillColor: {
              colors: [{
                opacity: 0
              }, {
                opacity: .5
              }]
            }
          }
        },
        grid: {
          borderWidth: 0,
          labelMargin: 0
        },
        yaxis: {
          show: false,
          min: 0,
          max: 80
        },
        xaxis: {
          show: false
        }
      });

      $.plot('#flotChart6', [{
        data: df4,
        color: '#9db2c6'
      }], {
        series: {
          shadowSize: 0,
          lines: {
            show: true,
            lineWidth: 2,
            fill: true,
            fillColor: {
              colors: [{
                opacity: 0
              }, {
                opacity: .5
              }]
            }
          }
        },
        grid: {
          borderWidth: 0,
          labelMargin: 0
        },
        yaxis: {
          show: false,
          min: 0,
          max: 60
        },
        xaxis: {
          show: false
        }
      });

      $('#vmap').vectorMap({
        map: 'usa_en',
        showTooltip: true,
        backgroundColor: '#fff',
        color: '#d1e6fa',
        colors: {
          fl: '#69b2f8',
          ca: '#69b2f8',
          tx: '#69b2f8',
          wy: '#69b2f8',
          ny: '#69b2f8'
        },
        selectedColor: '#00cccc',
        enableZoom: false,
        borderWidth: 1,
        borderColor: '#fff',
        hoverOpacity: .85
      });


      var ctxLabel = ['6am', '10am', '1pm', '4pm', '7pm', '10pm'];
      var ctxData1 = [20, 60, 50, 45, 50, 60];
      var ctxData2 = [10, 40, 30, 40, 55, 25];

      // Bar chart
      var ctx1 = document.getElementById('chartBar1').getContext('2d');
      new Chart(ctx1, {
        type: 'horizontalBar',
        data: {
          labels: ctxLabel,
          datasets: [{
            data: ctxData1,
            backgroundColor: '#69b2f8'
          }, {
            data: ctxData2,
            backgroundColor: '#d1e6fa'
          }]
        },
        options: {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
            display: false,
            labels: {
              display: false
            }
          },
          scales: {
            yAxes: [{
              gridLines: {
                display: false
              },
              ticks: {
                display: false,
                beginAtZero: true,
                fontSize: 10,
                fontColor: '#182b49'
              }
            }],
            xAxes: [{
              gridLines: {
                display: true,
                color: '#eceef4'
              },
              barPercentage: 0.6,
              ticks: {
                beginAtZero: true,
                fontSize: 10,
                fontColor: '#8392a5',
                max: 80
              }
            }]
          }
        }
      });

    })
  </script>

</body>

</html>
