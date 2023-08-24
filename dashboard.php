<?php
session_start();

// Redirects user who is not authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <!--ApexCharts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.40.0/apexcharts.min.js"></script>
    <title>IBI Applicant Tracking System</title>

    <!--Custom Font-->
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap"
      rel="stylesheet"
    />

    <!--Custom Icons-->
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet"
    />

    <!--Custom CSS-->
    <link rel="stylesheet" href="main.css" />
  </head>
  <body>
    <div class="grid-container">
      <!--Header-->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined" type="button"> menu </span>
        </div>
        <div class="header-left">
          <span class="material-icons-outlined"> search </span>
          <input
            type="text"
            placeholder="Search Candidates"
            onclick="event.stopPropagation();"
          />
        </div>
        <div class="header-right">
        <a href="">
          <span class="material-icons-outlined"> notifications </span>
        </a>
        <a href="sendemail/index.php">
          <span class="material-icons-outlined"> email </span>
        </a>
        <a href="">
          <span class="material-icons-outlined"> account_circle </span>
          </a>
        </div>
      </header>

      <!--Sidebar-->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <img src="Images/IBI-Logo2.png" alt="IBI Logo" />
            <b>Recruitment</b>
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">
            close
          </span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a class="sidebar-link" href="dashboard.php">
              <span class="material-icons-outlined"> dashboard </span>
              <b>Dashboard</b>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a class="sidebar-link" href="jobs.php">
              <span class="material-icons-outlined"> work_outline </span>
              <b>Jobs</b>
            </a>
          </li>
          <li class="sidebar-list-item">
            <span class="material-icons-outlined"> people_alt </span
            ><b>Candidates</b>
          </li>
          <li class="sidebar-list-item">
            <a class="sidebar-link" href="checklist.html">
              <span class="material-icons-outlined"> checklist </span>
              <b>Checklist</b>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a class="sidebar-link" href="fullCalendar/index.php">
            <span class="material-icons-outlined"> event </span><b>Calendar</b> 
          </a>
          </li>
          <li class="sidebar-list-item">
            <span class="material-icons-outlined"> settings </span
            ><b>Settings</b>
          </li>
        </ul>
      </aside>

      <!--Main-->
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold"><b>DASHBOARD</b></p>
        </div>

        <div class="main-cards">
          <div class="card">
            <div class="card-inner">
              <p class="text-primary">
                <b>ACTIVE CANDIDATES</b>
              </p>
              <span class="material-icons-outlined text-blue">
                people_alt
              </span>
            </div>
            <span class="text-primary font-weight-bold"><b>47</b></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">
                <b>ACTIVE JOBS</b>
              </p>
              <span class="material-icons-outlined text-orange">
                work_outline
              </span>
            </div>
            <span class="text-primary font-weight-bold"><b>47</b></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">
                <b>RECRUITMENT AVERAGE TAT (days)</b>
              </p>
              <span class="material-icons-outlined text-green"> timer </span>
            </div>
            <span class="text-primary font-weight-bold"><b>18</b></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">
                <b>INTERVIEWS TODAY</b>
              </p>
              <span class="material-icons-outlined text-red">
                meeting_room
              </span>
            </div>
            <span class="text-primary font-weight-bold"><b>6</b></span>
          </div>
        </div>

        <div class="charts">
          <div class="charts-card">
            <p class="chart-title">Jobs to Fill per Position</p>
            <div id="bar-chart"></div>
          </div>

          <div class="charts-card">
            <p class="chart-title">
              Number of Hiring Needs vs Active Candidates
            </p>
            <div id="area-chart"></div>
          </div>
        </div>
      </main>
    </div>
    <!--Scripts-->

    <!--Custom JS-->
    <script src="script.js"></script>
  </body>
</html>
