<x-adminLayout>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active"><a href="/report">Report</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-16">
      <div class="row">
      @foreach($purchases as $purchase)
      @endforeach

  <!-- Total items sold -->
  <div class="col-4">

              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total items sold</h5>

                  <div class="d-flex align-items-center"> 
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                    <!-- <?php
                        // $data = "123:string";
                        // $whatiwant = substr($data, strpos($data, ":")+1);
                        // echo $whatiwant;
                    ?> -->
      
      
                    <h6>{{ $sum }}</h6>
                  
                      <!-- variable in later -->

                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            

            <!-- Revenue Card -->
            <div class="col-4 ">
              <div class="card info-card revenue-card">
              
                <div class="card-body">
                  <h5 class="card-title">Revenue </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                    
                    <h6>RM {{ !empty($purchase) ? $purchase->sum('total_price') : 0}}</h6>
              
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- Customers Card -->
            <div class="col-4">

              <div class="card info-card customers-card">


                <div class="card-body">
                  <h5 class="card-title">Customers</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <h6>{{ !empty($purchase) ? $purchase->count('total_price') : 0}}</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                  

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $total_number_of_purchase = 0;
                    ?>
                    @foreach($purchases as $purchase)
                      <tr>
                        <th scope="row"><a href="#">{{$total_number_of_purchase+1}}</a></th>
                        <td>{{$purchase->first_name}} {{$purchase->last_name}}</td>
                        <td><a href="#" class="text-primary">{{$purchase->email}}</a></td>
                        <td>{{$purchase->phone}}</td>
                        <td>RM{{$purchase->total_price}}</td>
                        <td>{{$purchase->created_at}}</td>
                      </tr>
                      
                      <?php
                      $total_number_of_purchase++;
                      ?>
                    @endforeach
      
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->
            
            <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        
                        series: [{
                          name: 'Total Items Sold',
                          data: [
                            @foreach($purchases as $purchase)
                               {{ $sum }} ,
                            @endforeach
                            ],
                        }, {
                          name: 'Sales',
                          data: [
                            @foreach($purchases as $purchase)
                              {{ $purchase->sum('total_price') }},
                            @endforeach
                          ],
                        }, {
                          name: 'Customers',
                          data: [
                            @foreach($purchases as $purchase)
                              {{ $purchase->count('id') }},
                            @endforeach
                          ],
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: [
                          @foreach($purchases as $purchase)
                            "{{ $purchase->created_at->toIso8601String() }}",
                          @endforeach
                          ],
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->

</x-adminLayout>