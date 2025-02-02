<!-- resources/views/dashboard.blade.php -->
@extends('layouts.admin.app')

@section('title', 'Dashboard')

@push('css')

@endpush

@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="section-body">
        <!-- <p>Welcome to your Dashboard</p> -->
        <!-- Add your dashboard content here -->
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Orders</h4>
              </div>
              <div id="totalOrder" class="card-body">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-check-square"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Succeded</h4>
              </div>
              <div id="totalCompleted" class="card-body">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="fas fa-window-close"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Failed</h4>
              </div>
              <div id="totalCanceled" class="card-body">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Pending Payment</h4>
              </div>
              <div id="totalPayment" class="card-body">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-info">
              <i class="fas fa-sync-alt"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>On Processed</h4>
              </div>
              <div id="totalProcess" class="card-body">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-secondary">
              <i class="fas fa-truck"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Delivered</h4>
              </div>
              <div id="totalDelivered" class="card-body">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Sales</h4>
            </div>
            <div class="card-body">
              <canvas id="myChart" height="100"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js" integrity="sha512-a+mx2C3JS6qqBZMZhSI5LpWv8/4UK21XihyLKaFoSbiKQs/3yRdtqCwGuWZGwHKc5amlNN8Y7JlqnWQ6N/MYgA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function() {
      fetchTotalOrder();

      function getDataChart(callback) {
          $.ajax({
              url: `{{ route('getDataChart') }}`, // Adjust this URL to match your route
              method: 'GET',
              success: function(response) {
                  console.log(response);
                  callback(response); // Pass the response to the callback
              },
              error: function(xhr, status, error) {
                  console.error("Error fetching data:", error);
                  callback([]); // Pass an empty array in case of error
              }
          });
      }

      // Create the chart after fetching data
      getDataChart(function(data) {
          var ctx = document.getElementById('myChart').getContext('2d'); // Make sure to replace 'myChart' with your actual canvas ID
          var myChart = new Chart(ctx, {
              type: 'line',
              data: {
                  labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                  datasets: [{
                      label: 'Sales',
                      data: data, // Use the data received from the AJAX call
                      borderWidth: 1,
                      backgroundColor: 'rgba(63,82,227,.8)',
                      pointBorderWidth: 0,
                      pointStyle: 'circle',
                      pointRadius: 5,
                      pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                      fill: 'start',
                      tension: 0.4,
                      pointHoverRadius: 6
                  }]
              },
              options: {
                  legend: {
                      display: false
                  },
                  tooltips: {
                      callbacks: {
                          label: function(tooltipItem, data) {
                              // Format the tooltip value with thousand separators
                              var value = tooltipItem.yLabel; // Get the value from the tooltip item
                              return 'Rp. '+value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                          }
                      }
                  },
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero: false,
                              callback: function(value) {
                                  // Format the number with thousand separators
                                  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                              }
                              // stepSize: 150 // stepSize is not available in 2.x
                          }
                      }],
                      xAxes: [{
                          ticks: {
                              display: true
                          },
                          gridLines: {
                              display: false
                          }
                      }]
                  }
              }
          });
      });
    });

    function fetchTotalOrder() {
      var urL = `{{ route('fetchTotalOrder') }}`;

      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

      $.ajax({
          url: urL,
          contentType: 'application/json',
          dataType: 'json', // Define your backend route
          method: 'GET',
          success: function(response) {
              // Update the total closing element with fetched data
              $('#totalOrder').text(response.total);
              $('#totalCompleted').text(response.completed);
              $('#totalCanceled').text(response.canceled);
              $('#totalPayment').text(response.new);
              $('#totalProcess').text(response.process);
              $('#totalDelivered').text(response.delivered);
          },
          error: function(xhr) {
              console.error('Error fetching total closing:', xhr);
              $('#totalOrder').text('0');
              $('#totalProcess').text('0');
              $('#totalCanceled').text('0');
              $('#totalPayment').text('0');
              $('#totalProcess').text('0');
              $('#totalDelivered').text('0');
          }
      });
    }
  </script>
@endpush
