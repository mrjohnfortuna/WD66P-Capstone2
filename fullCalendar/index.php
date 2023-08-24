<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CALENDAR OF ACTIVITIES</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css">
    
    <!-- jQuery 2.2.4 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    
    <!-- jQuery UI -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    
    <!-- FullCalendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    
    <!-- Your custom JavaScript -->
    <script src="../script.js"></script>
    
    <!-- Custom Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <!-- Custom Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="main.css">
    <?php
include('dbcon.php');
$query = $conn->query("SELECT * FROM events ORDER BY id");
?>
  <script>
    $(document).ready(function() {
     var calendar = $('#calendar').fullCalendar({
      editable:true,
      header:{
       left:'prev,next today',
       center:'title',
       right:'month,agendaWeek,agendaDay'
      },
      events: [<?php while ($row = $query ->fetch_object()) { ?>{ id : '<?php echo $row->id; ?>', title : '<?php echo $row->title; ?>', start : '<?php echo $row->start_event; ?>', end : '<?php echo $row->end_event; ?>', }, <?php } ?>],
      selectable:true,
      selectHelper:true,
      select: function(start, end, allDay)
      {
      var title = prompt("Enter Event Title");
      if(title)
      {
        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        $.ajax({
        url:"insert.php",
        type:"POST",
        data:{title:title, start:start, end:end},
        success:function(data)
        {
          calendar.fullCalendar('refetchEvents');
          alert("Added Successfully");
          //window.location.replace("calendar.php");
        }
        })
      }
      },
 
      editable:true,
      eventResize:function(event)
      {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function(){
        calendar.fullCalendar('refetchEvents');
        alert('Event Update');
        }
      })
      },
 
      eventDrop:function(event)
      {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function()
        {
        calendar.fullCalendar('refetchEvents');
        alert("Event Updated");
        }
      });
      },
 
      eventClick:function(event)
      {
      if(confirm("Are you sure you want to remove it?"))
      {
        var id = event.id;
        $.ajax({
        url:"delete.php",
        type:"POST",
        data:{id:id},
        success:function()
        {
          calendar.fullCalendar('refetchEvents');
          alert("Event Removed");
        }
        })
      }
      },
 
    });
  });
</script>
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
            placeholder="Search"
            onclick="event.stopPropagation();"
          />
        </div>
        <div class="header-right">
          <a href="">
            <span class="material-icons-outlined"> notifications </span>
          </a>
          <a href="../sendemail/index.php">
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
            <img src="../Images/IBI-Logo2.png" alt="IBI Logo" />
            <b>Recruitment</b>
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">
            close
          </span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a class="sidebar-link" href="../dashboard.php">
              <span class="material-icons-outlined"> dashboard </span>
              <b>Dashboard</b>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a class="sidebar-link" href="../jobs.php">
              <span class="material-icons-outlined"> work_outline </span>
              <b>Jobs</b>
            </a>
          </li>
          <li class="sidebar-list-item">
            <span class="material-icons-outlined"> people_alt </span
            ><b>Candidates</b>
          </li>
          <li class="sidebar-list-item">
            <a class="sidebar-link" href="../checklist.html">
              <span class="material-icons-outlined"> checklist </span>
              <b>Checklist</b>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a class="sidebar-link" href="fullCalendar/index.php">
            <span class="material-icons-outlined"> event </span><b>Calendar</b> 
          </a>
          </li>
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
          <p class="font-weight-bold"><b>CALENDAR OF ACTIVITIES</b></p>
        </div>
        <div class="container">
            <div id="calendar"></div>
        </div>
    </main>
    </div>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
</html>
