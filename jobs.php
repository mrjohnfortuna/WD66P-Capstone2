<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Jobs</title>

    <!-- Load jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Load Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Load DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!-- Custom Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    
    <!-- Custom Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="main.css">
</head>
<body>

    <!-- Fetch and populate data -->
    <?php
    include('dbcon.php');
    $query = $conn->query("SELECT * FROM `jobs to fill`"); // Update table name if needed
    $data = [];
    while ($row = $query->fetch_assoc()) {
        $data[] = $row;
    }
    ?>
    
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
            <a class="sidebar-link" href="jobs.html">
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
            <p class="font-weight-bold"><b>ACTIVE JOBS</b></p>
        </div>
        <table id="jobs-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Job Title</th>
                    <th>Department</th>
                    <th>Headcounts To Fill</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $row): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['jobTitle']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td><?php echo $row['headcountsToFill']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
            <button class="btn btn-danger delete-position" data-id="<?php echo $row['id']; ?>">Delete</button>
        </td>
        </tr>
    <?php endforeach; ?>
            </tbody>
        </table>
        <button id="addPositionButton" class="btn btn-primary">Add Position</button>
        <!-- Add Position Modal -->
<div class="modal fade" id="addPositionModal" tabindex="-1" role="dialog" aria-labelledby="addPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPositionModalLabel">Add Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add input fields for job details -->
                <form id="addPositionForm">
                    <div class="form-group">
                        <label for="jobTitle">Job Title</label>
                        <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" class="form-control" id="department" name="department" required>
                    </div>
                    <div class="form-group">
                        <label for="headcountsToFill">Headcounts To Fill</label>
                        <input type="number" class="form-control" id="headcountsToFill" name="headcountsToFill" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    <button type="button" id="savePositionButton" class="btn btn-primary">Save Position</button>
</div>
        </div>
    </div>
</div>

        
    </main>
</div>

<!-- Your existing scripts -->
<script src="script.js"></script>

<!-- Load Bootstrap JavaScript after jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Load DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<!-- Initialize DataTables and other scripts -->
<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('#jobs-table').DataTable();

        // Show the add position modal
        $('#addPositionButton').click(function() {
            $('#addPositionModal').modal('show');
        });

        // Handle save position button click
        $('#savePositionButton').click(function() {
            // Get input values
            var jobTitle = $('#jobTitle').val();
            var department = $('#department').val();
            var headcountsToFill = $('#headcountsToFill').val();
            var status = $('#status').val();

            // Send data to the server using AJAX
            $.ajax({
                url: 'add_position.php', // Replace with your server-side script
                method: 'POST',
                data: {
                    jobTitle: jobTitle,
                    department: department,
                    headcountsToFill: headcountsToFill,
                    status: status
                },
                success: function(response) {
                    // Refresh the table to show the updated data
                    $('#jobs-table').DataTable().ajax.reload();
                    // Close the modal
                    $('#addPositionModal').modal('hide');
                }
            });
        });
    });

    // Handle delete position button click
$(document).on('click', '.delete-position', function() {
    var positionId = $(this).data('id');

    if (confirm('Are you sure you want to delete this position?')) {
        $.ajax({
            url: 'delete_position.php',
            method: 'POST',
            data: {
                id: positionId
            },
            success: function(response) {
                if (response.success) {
                    alert('Position deleted successfully');
                    $('#jobs-table').DataTable().ajax.reload();
                } else {
                    alert('Position could not be deleted. Please try again.');
                }
            }
        });
    }
});

</script>

</body>
</html>
