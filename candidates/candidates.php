<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates List</title>

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
    $query = $conn->query("SELECT * FROM candidate_pool"); // Update table name if needed
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
            <img src="/testPHP/Images/IBI-Logo2.png" alt="IBI Logo" />
            <b>Recruitment</b>
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">
            close
          </span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a class="sidebar-link" href="/testPHP/dashboard.php">
              <span class="material-icons-outlined"> dashboard </span>
              <b>Dashboard</b>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a class="sidebar-link" href="/testPHP/jobs/jobs.php">
              <span class="material-icons-outlined"> work_outline </span>
              <b>Jobs</b>
            </a>
          </li>
          <li class="sidebar-list-item">
          <a class="sidebar-link" href="/testPHP/candidates/candidates.php">
            <span class="material-icons-outlined"> people_alt </span
            ><b>Candidates</b>
          </li>
          <li class="sidebar-list-item">
            <a class="sidebar-link" href="/testPHP/checklist/checklist.html">
              <span class="material-icons-outlined"> checklist </span>
              <b>Checklist</b>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a class="sidebar-link" href="/testPHP/fullCalendar/index.php">
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
            <p class="font-weight-bold"><b>CANDIDATE POOL</b></p>
        </div>
        <table id="candidate-table" class="display">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Position Applied</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $row): ?>
        <tr>
            <td><?php echo $row['fullName']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['positionApplied']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
            <button class="btn btn-danger delete-position" data-id="<?php echo $row['fullName']; ?>">Delete</button>
        </td>
        </tr>
    <?php endforeach; ?>
            </tbody>
        </table>
        <div class="modal fade" id="addCandidateModal" tabindex="-1" aria-labelledby="addCandidateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCandidateModalLabel">Add Candidate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add Candidate Form -->
                <form id="addCandidateForm">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="positionApplied" class="form-label">Position Applied</label>
                        <input type="text" class="form-control" id="positionApplied" name="positionApplied" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>    
    </main>
</div>

<!-- Your existing scripts -->
<script src="../testPHP/script.js"></script>
<script>
    $(document).ready(function() {
        $('#candidate-table').DataTable();
        $('.delete-position').on('click', function() {
            var fullName = $(this).data('id');
            if (confirm('Are you sure you want to delete ' + fullName + '?')) {
                location.reload();
            }
        });

        // Show Add Candidate Modal
        $('#addCandidateButton').on('click', function() {
            $('#addCandidateModal').modal('show');
        });

        // Submit Add Candidate Form
        $('#addCandidateForm').on('submit', function(event) {
            event.preventDefault();

            // Get form data
            var formData = $(this).serialize();

            location.reload();

            // Close modal
            $('#addCandidateModal').modal('hide');
        });
    });
</script>

<!-- Load Bootstrap JavaScript after jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Load DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

</body>
</html>
