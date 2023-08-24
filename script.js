//SIDEBAR TOGGLE
console.log("Script started");
var sidebarOpen = false;
var sidebar = document.getElementById("sidebar");

function openSidebar() {
  const sidebar = document.getElementById("sidebar");
  sidebar.classList.add("sidebar-responsive");
}

function closeSidebar() {
  const sidebar = document.getElementById("sidebar");
  sidebar.classList.remove("sidebar-responsive");
}

// JOBS.HTML
$(document).ready(function() {
  // Fetch data from getjobs.php using AJAX
  $.ajax({
    url: 'getjobs.php',
    dataType: 'json',
    success: function(data) {
      // Data has been successfully fetched, populate the table with data
      var tableBody = $('#jobs-table tbody');
      
      // Clear existing rows, in case you are dynamically updating the table
      tableBody.empty();

      // Loop through the data and create rows for each entry
      data.forEach(function(entry) {
        var row = $('<tr>');
        row.append($('<td>').text(entry.id)); // Replace with actual column name
        row.append($('<td>').text(entry.jobTitle));
        row.append($('<td>').text(entry.department));
        row.append($('<td>').text(entry.headcountsToFill));
        row.append($('<td>').text(entry.status)); // Replace with actual column name
        tableBody.append(row);
      });
    },
    error: function() {
      console.error('Error fetching data from getjobs.php');
    }
  });

// BAR CHART

$(document).ready(function() {
  // Fetch data from getjobs.php using AJAX
  $.ajax({
    url: 'getjobs.php',
    dataType: 'json',
    success: function(data) {
      console.log("Fetched data:", data);
      // Data has been successfully fetched, update the chart configuration
      var jobTitles = data.map(entry => entry.jobTitle);

      var barChartOptions = {
        series: [{
          data: data.map(entry => parseInt(entry.headcountsToFill))
        }],
        chart: {
          type: 'bar',
          height: 350,
          toolbar: {
            show: false
          },
        },
        colors: [
          "#cc3c43",
          "#367952",
          "#f5b74f",
          "#246dec",
          "#486684",
          "#BF40BF"
        ],
        plotOptions: {
          bar: {
            distributed: true,
            borderRadius: 4,
            horizontal: false,
            columnWidth: '40%',
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: jobTitles,
        },
        yaxis: {
          title: {
            text: "Headcounts To Fill" // Update the y-axis title
          }
        },
      };
      console.log("Before chart initialization");
      var barChart = new ApexCharts(document.querySelector("#bar-chart"), barChartOptions);
      barChart.render();
      console.log("After chart initialization");
    },
    error: function() {
      console.error('Error fetching data from getjobs.php');
    }
  });

  //AREA CHART
       
  var areaChartOptions = {
    series: [{
    name: 'Hiring Needs',
    data: [2, 3, 1, 5, 2, 3]
  }, {
    name: 'Active Candidates',
    data: [1, 0, 0, 3, 2, 4]
  }],
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
        show: false,
    },
  },
  colors: ["#367952", "#f5b74f"],
  dataLabels: {
    enabled: false,
  },
  stroke: {
    curve: 'smooth'
  },
  labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4','Week 5','Week 6'],
  markers: {
    size: 0
  },
  yaxis: [
    {
      title: {
        text: 'Hiring Needs',
      },
    },
    {
      opposite: true,
      title: {
        text: 'Active Candidates',
      },
    },
  ],
  tooltip: {
    shared: true,
    intersect: false,
  }
  };

  var areaChart = new ApexCharts(document.querySelector("#area-chart"), areaChartOptions);
  areaChart.render();
});
