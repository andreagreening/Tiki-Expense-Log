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
                          @if(Request::get('category_id') && $team->categories()->where('id', Request::get('category_id'))->first() &&  $team->categories()->where('pid', null)->first())
                            @foreach($categories as $category)
                              ['{{ $category->title }}', {{ $category->parentCategoryTotal(request()) }}],
                              @if($category->subcategories())
                                @foreach($category->subcategories as $subcategory)
                                ['{{ $subcategory->title }}', {{ $subcategory->subCategoryTotal(request()) }}],
                                @endforeach
                              @endif
                            @endforeach
                          @else
                            @foreach($categories as $category)
                              ['{{ $category->title }}', {{ $category->grandTotal(request()) }}],
                            @endforeach

                          @endif
                        ]);

                        var options = {
                          // title: 'My Daily Activities',
                          pieHole: 0.4,
                          legend:{position: 'right'},
                          chartArea:{left:15},
                          colors: [
                          '#ff5a5a',
                          '#dff48e',
                          '#5dd495',
                          '#4cbfe1',
                          '#3c59c1',
                          '#ffa7a7',
                          '#e6acfb',
                          '#ffde8f',
                          '#838cff',
                          '#0084b6',
                          '#ff6200',
                          '#ffc000',
                          '#a0ff00',
                          '#00eaff',
                          '#420074'],
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                        chart.draw(data, options);
                      }
                    </script>
