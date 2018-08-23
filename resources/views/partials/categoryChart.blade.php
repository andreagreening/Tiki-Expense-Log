{{-- Category Chart:: intended to show the parent category totals, allowing you to click on the category title and view a page which displays another chart detailing  --}}
            <div class="panel panel-default side-border-primary" id="byCategoryChart">
                <div class="panel-body">
                  {{-- <div id="categoryChart" style="height: 250px;"></div> --}}
                  <div id="donutchart"></div>
                </div>
            </div> {{-- end of panel--}}

 


           
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                      google.charts.load("current", {packages:["corechart"]});
                      google.charts.setOnLoadCallback(drawChart);
                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Category', 'Total Spent'],
                          @foreach($categories as $category)
                            ['{{ $category->title }}', {{ $category->grandTotal(request()) }}],
                          @endforeach
                        ]);

                        var options = {
                          // title: 'My Daily Activities',
                          pieHole: 0.4,
                          legend:{position: 'bottom'},
                          colors: [
                          '#1e875d',
                          '#239a6a',
                          '#27ad77',
                          '#2cc185',
                          '#4b354d',
                          '#563d58',
                          '#614563',
                          '#6c4d6f',
                          '#ff8800',
                          '#ff9319',
                          '#ff9f32'],


                        };

                        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                        chart.draw(data, options);
                      }
                    </script>

                    

{{-- <script>
              new Morris.Donut({
              // ID of the element in which to draw the chart.
              element: 'categoryChart',
              // Chart data records -- each entry in this array corresponds to a point on
              // the chart.
              data: [
                { year: '2008', value: 20 },
                { year: '2009', value: 10 },
                { year: '2010', value: 5 },
                { year: '2011', value: 5 },
                { year: '2012', value: 20 }
              ],
              // The name of the data record attribute that contains x-values.
              xkey: '',
              // A list of names of data record attributes that contain y-values.
              ykeys: ['value'],
              // Labels for the ykeys -- will be displayed when you hover over the
              // chart.
              labels: ['Value']

              colors: [
              //   '#1e875d',
              //   '#239a6a',
              //   '#27ad77',
              //   '#2cc185',
              //   '#4b354d',
              //   '#563d58',
              //   '#614563',
              //   '#6c4d6f',
              //   '#ff8800',
              //   '#ff9319',
              //   '#ff9f32'
              // ]
              
            });
            </script> 
            --}}