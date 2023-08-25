// SIDEBAR TOGGLE
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

$(document).ready(function() {
  // Fetch data from getjobs.php using AJAX
  $.ajax({
    url: 'jobs/getjobs.php',
    dataType: 'json',
    success: function(data) {
      console.log("Received data:", data);
      // Data has been successfully fetched, populate the table with data
      var tableBody = $('#jobs-table tbody');

      // Clearing existing rows
      tableBody.empty();

      // Looping and creating row per entry
      data.forEach(function(entry) {
        var row = $('<tr>');
        row.append($('<td>').text(entry.id)); 
        row.append($('<td>').text(entry.jobTitle));
        row.append($('<td>').text(entry.department));
        row.append($('<td>').text(entry.headcountsToFill));
        row.append($('<td>').text(entry.status)); 
        tableBody.append(row);
      });

      // Create the bar chart
      var jobTitles = [];
      var headcountsToFill = [];
      var activeCandidates = [];

      // Extract data for the area chart
      data.forEach(function(entry) {
        jobTitles.push(entry.jobTitle);
        headcountsToFill.push(parseInt(entry.headcountsToFill));
        activeCandidates.push(parseInt(entry.activeCandidates)); 
      });

      var ctx = document.getElementById("bar-chart").getContext("2d");
      var barChart = new Chart(ctx, {
        type: "bar",
        data: {
          labels: jobTitles,
          datasets: [{
            label: "Headcounts To Fill",
            data: headcountsToFill,
            backgroundColor: "rgba(54, 162, 235, 0.5)", 
            borderColor: "rgba(54, 162, 235, 1)",
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });

      // Create the area chart
      var areaChartData = {
        labels: ["Total"],
        datasets: [
          {
            label: "Total Headcounts To Fill",
            data: [totalHeadcounts],
            backgroundColor: "rgba(54, 162, 235, 0.5)", 
            borderColor: "rgba(54, 162, 235, 1)",
            borderWidth: 1,
            fill: true
          },
          {
            label: "Total Active Candidates",
            data: [totalActiveCandidates],
            backgroundColor: "rgba(255, 99, 132, 0.5)", 
            borderColor: "rgba(255, 99, 132, 1)",
            borderWidth: 1,
            fill: true
          }
        ]
      };

      var ctx = document.getElementById("area-chart").getContext("2d");
      new Chart(ctx, {
        type: "line",
        data: areaChartData,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });

    },
    error: function() {
      console.error('Error fetching data from getjobs.php');
    }
  });

});
