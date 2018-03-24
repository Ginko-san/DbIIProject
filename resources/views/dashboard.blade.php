<?php 
use App\Http\Controllers\DashboardController;?>

 
@extends('layouts.app')
@include('menu')
@section('content')
<style>
    body {
	    background: #f5f8fa;
    }
    .custom{
      width=400px;
      height=400px;
    }
    #screenAlign{
      float:left;
    }
    #screenDataOthers{
      float:right;
    }
</style>

    

    <div class="container-fluid">
      <div class="row">
      
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <!-- Aside Menu -->
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Database Info: {{ $currentDB }}</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
              </div>
            </div>
          </div>

          <div class="row">
            <div style="width:70%" id="screenAlign">
              <canvas class="my-4" id="screenStorage"></canvas>
            </div>
            <div>
              <!-- List showing data of the current database selected -->
              <div id="screenDataOthers row">
                <ul class="list-group">
                  <li class="list-group-item list-group-item-dark" id="maxSizeLI">Max Size: wait... KB."</li>
                  <li class="list-group-item list-group-item-light" id="actualSizeLI">Actual Size: wait... KB."</li>
                  <li class="list-group-item list-group-item-dark" id="growthLI">Growth: wait... .</li>
                  <li class="list-group-item list-group-item-light" id="userPercentageLI">Usage %: wait... %.</li>
                </ul>
              </div>

              <!-- Select tag to change the current db -->
              <br/>
              <div class="row">
                <form class="form-horizontal" role="form" action="{{ route('dashboard.changeDBName') }}" method="POST">
                  <div class="form-group">
                    <label for="databases"><span data-feather="layers"></span>  Databases List: </label>
                    <select class="form-control custom-select" id="databases" name="databases">
                      @foreach($databasesOnList as $db)
                        <option value="{{ $db->name }}">{{ $db->name }}</option> 
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input class="btn btn-dark btn-block" type="submit"  value="Change DB">
                    </div>
                  </div>
                </form>
              </div>

            </div>
          </div>

          <div class="row">
            <h2>Section title</h2>
            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Header</th>
                    <th>Header</th>
                    <th>Header</th>
                    <th>Header</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  @foreach ($databasesOnList as $db)
                    <td>{{ $db->name }}</td>
                  @endforeach
                  </tr>
                  <tr>
                    <td>1,002</td>
                    <td>amet</td>
                    <td>consectetur</td>
                    <td>adipiscing</td>
                    <td>elit</td>
                  </tr>
                  <tr>
                    <td>1,003</td>
                    <td>Integer</td>
                    <td>nec</td>
                    <td>odio</td>
                    <td>Praesent</td>
                  </tr>
                  <tr>
                    <td>1,003</td>
                    <td>libero</td>
                    <td>Sed</td>
                    <td>cursus</td>
                    <td>ante</td>
                  </tr>
                  <tr>
                    <td>1,004</td>
                    <td>dapibus</td>
                    <td>diam</td>
                    <td>Sed</td>
                    <td>nisi</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          
        </main>
      </div>
    </div>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script>
        var maxSize = 400;
        var actualSize = 300;
        var growth = 100;
        var name = '';

        window.onload = function() {
          var ctx = document.getElementById('screenStorage').getContext('2d');
          window.myPie = new Chart(ctx, config);
        };
        
        var changeText = function(itemId, text) { 
          document.getElementById(itemId).innerHTML = text;
        };
        
        var updateScalingFactorJsonArray = function() {
          return @json(DashboardController::screenMonitorDataReturn());
        };
        
        // First pie graphic display.
        var jsonArray = updateScalingFactorJsonArray();
        var config = {
          type: 'pie',
          data: {
            datasets: [{
              data: [
                Math.round(parseInt(jsonArray[0]['usedSize'])*8),
                Math.round(parseInt(jsonArray[0]['unusedSize'])*8),
              ],
              backgroundColor: [
                window.chartColors.red,
                window.chartColors.blue,
              ],
              label: 'Space Dataset'
            }],
            labels: [
              'Used',
              'Unused',
            ]
          },
          options: {
            segmentShowStroke : true,
            segmentStrokeColor : "#fff",
            segmentStrokeWidth : 2,
            percentageInnerCutout : 50,
            animationSteps : 100,
            animationEasing : "easeOutBounce",
            animateRotate : true,
            animateScale : false,
            responsive: true,
            maintainAspectRatio: true,
            showScale: true,
            animateScale: true
          }
        };
        
        // Seccion donde se produze la llamada asincronica y se actualiza
        // el grafico de pie.
        var asyncCall = setInterval( function() { asyncCallFunc(); }, 5000);

        function asyncCallFunc() {
          var queryRes = updateScalingFactorJsonArray();
          var used = Math.round(parseInt(queryRes[0]['usedSize'])*8);

          var cont = 0;
          config.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
              if (cont === 0){
                cont++;
                return used;
              } else 
                return Math.round(parseInt(queryRes[0]['unusedSize'])*8);
            });
          });
          window.myPie.update();
          
          actualSize = Math.round(parseInt(queryRes[0]['actualSize']) * 8);
          maxSize = (Math.round(parseInt(queryRes[0]['maxsize'])) < 0) ? -1 : (Math.round(parseInt(queryRes[0]['maxsize'])*8));
          growth = Math.round(parseInt(queryRes[0]['growth']));
          
          changeText('maxSizeLI', "Max Size: " + ((maxSize === -1) ? ' ∞' : maxSize) +" KB.");
          changeText('actualSizeLI', "Actual Size: " + actualSize +" KB.");
          changeText('growthLI', "Growth: " + growth +".");
          changeText('userPercentageLI', "Usage %: " + (used / actualSize)*100 +"%.");
          
        }        
    </script>
@endsection