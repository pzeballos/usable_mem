<?php

// load config
require_once('config/config.php');

// load view
require_once('views/index.class.php');

// create a new page object
$index = new index('default');

// set the title
$index->title = "Demo Memory Usage";
// set the heading
$index->heading = "Free Memory Available";

// insert the D3 Graph into the body
$index->body = "<script>
                var margin = {top: 20, right: 30, bottom: 100, left: 80},
                    width = 960 - margin.left - margin.right,
                    height = 500 - margin.top - margin.bottom;

                var x = d3.scale.ordinal()
                    .rangeRoundBands([0, width], .1);

                var y = d3.scale.linear()
                    .range([height, 0]);

                var xAxis = d3.svg.axis()
                    .scale(x)
                    .orient(\"bottom\")

                var yAxis = d3.svg.axis()
                    .scale(y)
                    .orient(\"left\");

                var chart = d3.select(\".chart\")
                    .attr(\"width\", width + margin.left + margin.right)
                    .attr(\"height\", height + margin.top + margin.bottom)
                    .append(\"g\")
                    .attr(\"transform\", \"translate(\" + margin.left + \",\" + margin.top + \")\");

                // make data PHP output TSV
                d3.tsv(\"data.php\", type, function(error, data) {
                    x.domain(data.map(function(d) { return d.TimeStamp; }));
                    y.domain([0, d3.max(data, function(d) { return d.FreeMemory; })]);

                    chart.append(\"g\")
                        .attr(\"class\", \"x axis\")
                        .attr(\"transform\", \"translate(0,\" + height + \")\")
                        .call(xAxis)
                        .selectAll(\"text\")
                        .style(\"text-anchor\", \"end\")
                        .attr(\"dx\", \"-.8em\")
                        .attr(\"dy\", \".15em\")
                        .attr(\"transform\", function(d) {
                            return \"rotate(-65)\"
                        });

                    chart.append(\"text\")
                        .attr(\"class\", \"x label\")
                        .attr(\"text-anchor\", \"end\")
                        .attr(\"x\", width)
                        .attr(\"y\", height + 90)
                        .text(\"Snapshot Time\");

                    chart.append(\"g\")
                        .attr(\"class\", \"y axis\")
                        .call(yAxis);

                    chart.append(\"text\")
                        .attr(\"class\", \"y label\")
                        .attr(\"text-anchor\", \"end\")
                        .attr(\"y\", -65)
                        .attr(\"dy\", \".75em\")
                        .attr(\"transform\", \"rotate(-90)\")
                        .text(\"Free Memory (in kB)\");

                    chart.selectAll(\".bar\")
                        .data(data)
                        .enter().append(\"rect\")
                        .attr(\"class\", \"bar\")
                        .attr(\"x\", function(d) { return x(d.TimeStamp); })
                        .attr(\"y\", function(d) { return y(d.FreeMemory); })
                        .attr(\"height\", function(d) { return height - y(d.FreeMemory); })
                        .attr(\"width\", x.rangeBand());
                });

                function type(d) {
                    d.FreeMemory = +d.FreeMemory; // coerce to number
                    return d;
                }
            </script>";

// show the page
echo $index->showPage();