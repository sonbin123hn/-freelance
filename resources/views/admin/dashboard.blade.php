@extends('admin.layouts.master')

@section('page-breadcrum')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('container-fluid')
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Email campaign chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Sales Ratio</h4>
                                <div id="plotly_left"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-5">Total income for today</h5>
                                <h3 class="font-light"></h3>
                                <div class="m-t-20 text-center">
                                    <div id="earnings"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0">Thành viên đăng kí</h4>
                                <h2 class="font-light"> <span class="font-16 text-success font-medium">member</span></h2>
                                <div class="m-t-30">
                                    <div class="row text-center">
                                        <div class="col-6 border-right">
                                            <h4 class="m-b-0"></h4>
                                            <span class="font-14 text-muted">Thành viên mới</span>
                                            <h2>{{$newMember}}</h2>
                                        </div>
                                        <div class="col-6">
                                            <h4 class="m-b-0"></h4>
                                            <span class="font-14 text-muted">Tổng số thành viên</span>
                                            <h2>{{$allMember}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Email campaign chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Ravenue - page-view-bounce rate -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
                <!-- Ravenue - page-view-bounce rate -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    
                    <!-- column -->
                    
                </div>
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            </div>
@endsection
@section('footer')
<footer class="footer text-center">
    All Rights Reserved by Nice admin. Designed and Developed by
    <a href="">STK</a>.
</footer>
@endsection
@section('scriptt')
<script type="text/javascript">
var intervalTime = 2000;
var numSamples = 90;

var minThroughput = 0;
var maxThroughput = 1000;

var minDb = -200;
// Plotly
function randThroughput() {
  return Math.round(Math.random()*maxThroughput) + 1;
}

function randDb() {
    return Math.round(Math.random() * minDb);
}
</script>



<script type="text/javascript">
var inputXarray = [], inputYarray = [];
var outputXarray = [], outputYarray = [];

var time = new Date(Date.now() - numSamples * intervalTime);
for(var i = 0; i < numSamples; i++) {
    var t = new Date(time.getTime() + i * intervalTime)
  inputXarray[i] = outputXarray[i] = t
  inputYarray[i] = outputYarray[i] = minThroughput
}
// Push initial live values
var newDate = new Date()
inputXarray.push(newDate)
inputYarray.push(randThroughput())
outputXarray.push(newDate)
outputYarray.push(randThroughput())

var data = [{
  x: inputXarray,
  y: inputYarray,
  mode: 'lines',
  name: 'Input',
  //line: {color: '#80CAF6'}
},{
  x: outputXarray,
  y: outputYarray,
  mode: 'lines',
  name: 'Output',
  //line: {color: '#8000F6'}
}]

var layout = {
  title: "Plotly", 
  xaxis: {
      fixedrange: true
  },
  yaxis: {
    title: 'Throughput (Mbps)',
    titlefont: {color: '#1f77b4'},
    tickfont: {color: '#1f77b4'},
    fixedrange: true,
    range: [0/*, maxThroughput*/]
  },
  showlegend: true,
  legend: {
      "orientation": "h",
//    x: 0,
//    xanchor: 'left',
    y: -0.12
  }
};

Plotly.newPlot('plotly_left', data, layout, {displayModeBar: false});

var cnt = 0;

var interval = setInterval(function() {
  var time= new Date();

  var updateInput = {
    x:  [[time]],
    y: [[randThroughput()]]
  }
  var updateOutput = {
    x:  [[time]],
    y: [[randThroughput()]]
  }

  var olderTime = time.setMilliseconds(time.getMilliseconds() - numSamples*intervalTime);
  var futureTime = time.setMilliseconds(time.getMilliseconds() + numSamples*intervalTime);

  var minuteView = {
        xaxis: {
          type: 'date',
          fixedrange: true,
          range: [olderTime,futureTime]
        }
      };

  Plotly.relayout('plotly_left', minuteView);
  Plotly.extendTraces('plotly_left', updateInput, [0])
  Plotly.extendTraces('plotly_left', updateOutput, [1])
}, intervalTime);


// RSSI and MSE
var rssi1XArray = [], rssi1YArray = [];
var mse1XArray = [], mse1YArray = [];
var rssi2XArray = [], rssi2YArray = [];
var mse2XArray = [], mse2YArray = [];
var rssi3XArray = [], rssi3YArray = [];
var mse3XArray = [], mse3YArray = [];

var time = new Date(Date.now() - numSamples * intervalTime);
for(var i = 0; i < numSamples; i++) {
    var t = new Date(time.getTime() + i * intervalTime)
  rssi1XArray[i] = mse1XArray[i] = t
  rssi1YArray[i] = mse1YArray[i] = minDb
  rssi2XArray[i] = mse2XArray[i] = t
  rssi2YArray[i] = mse2YArray[i] = minDb
  rssi3XArray[i] = mse3XArray[i] = t
  rssi3YArray[i] = mse3YArray[i] = minDb
}
// Push initial live values
var newDate = new Date()
rssi1XArray.push(newDate)
rssi1YArray.push(randDb())
mse1XArray.push(newDate)
mse1YArray.push(randDb())
rssi2XArray.push(newDate)
rssi2YArray.push(randDb())
mse2XArray.push(newDate)
mse2YArray.push(randDb())
rssi3XArray.push(newDate)
rssi3YArray.push(randDb())
mse3XArray.push(newDate)
mse3YArray.push(randDb())


var data = [{
  x: rssi1XArray,
  y: rssi1YArray,
  mode: 'lines',
  name: 'RSSI ODU1',
  //line: {color: '#8000F6'}
},{
  x: mse1XArray,
  y: mse1YArray,
  mode: 'lines',
  name: 'MSE ODU1',
  yaxis: 'y2',
  //line: {color: '#8000F6'}
},{
  x: rssi2XArray,
  y: rssi2YArray,
  mode: 'lines',
  name: 'RSSI ODU2',
  //line: {color: '#8000F6'}
},{
  x: mse2XArray,
  y: mse2YArray,
  mode: 'lines',
  name: 'MSE ODU2',
  yaxis: 'y2',
  //line: {color: '#8000F6'}
},{
  x: rssi2XArray,
  y: rssi2YArray,
  mode: 'lines',
  name: 'RSSI ODU3',
  //line: {color: '#8000F6'}
},{
  x: mse2XArray,
  y: mse2YArray,
  mode: 'lines',
  name: 'MSE ODU3',
  yaxis: 'y2',
  //line: {color: '#8000F6'}
}]

var layout = {
  title: "Plotly", 
  xaxis: {
    fixedrange: true
  },
  yaxis: {
    title: 'RSSI (dBm)',
    titlefont: {color: '#1f77b4'},
    tickfont: {color: '#1f77b4'},
    fixedrange: true,
    //range: [minDb]
  },
  yaxis2: {
    title: 'MSE (dB)',
    titlefont: {color: '#ff6666'},
    tickfont: {color: '#ff6666'},
    fixedrange: true,
    anchor: 'free',
    overlaying: 'y',
    side: 'right',
    position: 1,
    //range: [minDb]
  },
  showlegend: true,
  legend: {
      "orientation": "h",
//    x: 0,
//    xanchor: 'left',
    y: -0.12
  }
};

</script>
@endsection
