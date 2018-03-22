<?php use App\Http\Controllers\DashboardController;?>

@extends('layouts.app')

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

    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Databases Admin</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Disconnect</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">'
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="layers"></span>
                  Databases
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file"></span>
                  FileGroups
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Future features</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Idk
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Idk2
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
          </div>

          <div class="row">
            <div style="width:80%" id="screenAlign">
              <canvas class="my-4" id="screenStorage"></canvas>
            </div>
            <div id="screenDataOthers">
              <ul class="list-group">
                <li class="list-group-item list-group-item-dark" id="maxSizeLI">Max Size: wait... KB."</li>
                <li class="list-group-item list-group-item-light" id="growthLI">Growth: wait... .</li>
                <li class="list-group-item list-group-item-dark" id="userPercentageLI">Usage %: wait... %.</li>
              </ul>
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
                    <td>1,001</td>
                    <td>Lorem</td>
                    <td>ipsum</td>
                    <td>dolor</td>
                    <td>sit</td>
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
                  <tr>
                    <td>1,005</td>
                    <td>Nulla</td>
                    <td>quis</td>
                    <td>sem</td>
                    <td>at</td>
                  </tr>
                  <tr>
                    <td>1,006</td>
                    <td>nibh</td>
                    <td>elementum</td>
                    <td>imperdiet</td>
                    <td>Duis</td>
                  </tr>
                  <tr>
                    <td>1,007</td>
                    <td>sagittis</td>
                    <td>ipsum</td>
                    <td>Praesent</td>
                    <td>mauris</td>
                  </tr>
                  <tr>
                    <td>1,008</td>
                    <td>Fusce</td>
                    <td>nec</td>
                    <td>tellus</td>
                    <td>sed</td>
                  </tr>
                  <tr>
                    <td>1,009</td>
                    <td>augue</td>
                    <td>semper</td>
                    <td>porta</td>
                    <td>Mauris</td>
                  </tr>
                  <tr>
                    <td>1,010</td>
                    <td>massa</td>
                    <td>Vestibulum</td>
                    <td>lacinia</td>
                    <td>arcu</td>
                  </tr>
                  <tr>
                    <td>1,011</td>
                    <td>eget</td>
                    <td>nulla</td>
                    <td>Class</td>
                    <td>aptent</td>
                  </tr>
                  <tr>
                    <td>1,012</td>
                    <td>taciti</td>
                    <td>sociosqu</td>
                    <td>ad</td>
                    <td>litora</td>
                  </tr>
                  <tr>
                    <td>1,013</td>
                    <td>torquent</td>
                    <td>per</td>
                    <td>conubia</td>
                    <td>nostra</td>
                  </tr>
                  <tr>
                    <td>1,014</td>
                    <td>per</td>
                    <td>inceptos</td>
                    <td>himenaeos</td>
                    <td>Curabitur</td>
                  </tr>
                  <tr>
                    <td>1,015</td>
                    <td>sodales</td>
                    <td>ligula</td>
                    <td>in</td>
                    <td>libero</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script>
        var maxSize = 400;
        var actualSize = 300;
        var growth = 100;
        var name = '';

    		var randomScalingFactor = function() {
          return Math.round(Math.random() * 100);
        };

        var updateScalingFactor = function(dbname, stat) {
          var queryJson = @json(DashboardController::screenMonitorDataReturn());
          for (i = 0; i < queryJson.length ;i++) {
            if (queryJson[i]['name'] === dbname)
              return Math.round((stat === 0) ? (queryJson[i]['usedSize']*8) : (stat === 1) ? (queryJson[i]['unusedSize']*8) : (stat === 2) ? (queryJson[i]['actualSize']*8) : (stat === 3) ? ((queryJson[i]['maxsize'] < 0) ? -1 : (queryJson[i]['maxsize']*8)) : queryJson[i]['growth']);
          }
        };

        var config = {
          type: 'pie',
          data: {
            datasets: [{
              data: [
                updateScalingFactor('master', 0),
                updateScalingFactor('master', 1),
              ],
              backgroundColor: [
                window.chartColors.red,
                window.chartColors.blue,
              ],
              label: 'Space Dataset'
            }],
            labels: [
              'Used',
              'Unused'
            ]
          },
          options: {
            responsive: true
          }
        };

        window.onload = function() {
          var ctx = document.getElementById('screenStorage').getContext('2d');
          window.myPie = new Chart(ctx, config);
        };

        var x = setInterval( function() {
          var cont = 0;
          config.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
              if (cont === 0){
                cont++;
                return updateScalingFactor('master', 0);
              } else 
                return updateScalingFactor('master', 1);
            });
          });
          window.myPie.update();
          
          actualSize = updateScalingFactor('master', 2);
          maxSize = updateScalingFactor('master', 3);
          growth = updateScalingFactor('master', 4);
          
          changeText('maxSizeLI', "Max Size: " + maxSize +" KB.");
          changeText('growthLI', "Growth: " + growth +".");
          changeText('userPercentageLI', "Usage %: " + (updateScalingFactor('master', 0) / actualSize)*100 +"%.");
          
        }, 2000);

        var changeText = function(itemId, text){ 
          document.getElementById(itemId).innerHTML = text;
        };
    </script>

    
    
@endsection