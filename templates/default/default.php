<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>[TITLE]</title>

    <!-- Bootstrap -->
    <link href="templates/[TEMPLATE]/css/bootstrap.min.css" rel="stylesheet">
    <link href="templates/[TEMPLATE]/css/chart.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="page-header">
                <h1>[HEADING]</h1>
            </div>
            <div class="col-md-8 column">
                <svg class="chart"></svg>
            </div>
            <script src="templates/[TEMPLATE]/js/d3.js"></script>
            <script>
                var margin = {top: 20, right: 30, bottom: 100, left: 80},
                    width = 960 - margin.left - margin.right,
                    height = 500 - margin.top - margin.bottom;

                var x = d3.scale.ordinal()
                    .rangeRoundBands([0, width], .1);

                var y = d3.scale.linear()
                    .range([height, 0]);

                var xAxis = d3.svg.axis()
                    .scale(x)
                    .orient("bottom")

                var yAxis = d3.svg.axis()
                    .scale(y)
                    .orient("left");

                var chart = d3.select(".chart")
                    .attr("width", width + margin.left + margin.right)
                    .attr("height", height + margin.top + margin.bottom)
                    .append("g")
                    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                d3.tsv("data.php", type, function(error, data) {
                    x.domain(data.map(function(d) { return d.TimeStamp; }));
                    y.domain([0, d3.max(data, function(d) { return d.FreeMemory; })]);

                    chart.append("g")
                        .attr("class", "x axis")
                        .attr("transform", "translate(0," + height + ")")
                        .call(xAxis)
                        .selectAll("text")
                        .style("text-anchor", "end")
                        .attr("dx", "-.8em")
                        .attr("dy", ".15em")
                        .attr("transform", function(d) {
                            return "rotate(-65)"
                        });

                    chart.append("text")
                        .attr("class", "x label")
                        .attr("text-anchor", "end")
                        .attr("x", width)
                        .attr("y", height + 90)
                        .text("Snapshot Time");

                    chart.append("g")
                        .attr("class", "y axis")
                        .call(yAxis);

                    chart.append("text")
                        .attr("class", "y label")
                        .attr("text-anchor", "end")
                        .attr("y", -65)
                        .attr("dy", ".75em")
                        .attr("transform", "rotate(-90)")
                        .text("Free Memory (in kB)");

                    chart.selectAll(".bar")
                        .data(data)
                        .enter().append("rect")
                        .attr("class", "bar")
                        .attr("x", function(d) { return x(d.TimeStamp); })
                        .attr("y", function(d) { return y(d.FreeMemory); })
                        .attr("height", function(d) { return height - y(d.FreeMemory); })
                        .attr("width", x.rangeBand());
                });

                function type(d) {
                    d.FreeMemory = +d.FreeMemory; // coerce to number
                    return d;
                }
            </script>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="templates/[TEMPLATE]/js/bootstrap.min.js"></script>
</body>
</html>




