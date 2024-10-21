<?php
  //connect to database
  include '../includes/config.php';
  include '../includes/User.php';

  //resume user session
  session_start();

  //set current page to update sidebar status
  $current_page = 'Admin Profile';

  //graph data from user if admin form was submitted 
  if($_SERVER["REQUEST_METHOD"]=="POST"){ 
    echo "<script>console.log('entered php post method');</script>";
    $Username = htmlspecialchars($_POST["username"]);
    $Password = htmlspecialchars($_POST["password"]);
    //Encrypt password for additional security
    $Hashedpassword = password_hash($Password, PASSWORD_DEFAULT);
    $Fname = htmlspecialchars($_POST["firstname"]);
    $Lname = htmlspecialchars($_POST["lastname"]);
    $Email = htmlspecialchars($_POST["email"]);
    $Country = htmlspecialchars($_POST["country"]);

    $result = User::insertUser($Username, $Fname, $Lname, $Email, $Hashedpassword, $Country, '1');

    if ($result) {
        echo "<script>console.log('Admin added successfully.');</script>";
    } else {
        echo "<script>console.log('Error adding admin.');</script>";
    }
  }

  //get all admins from database
  $admins = User::getAllAdmins();
?>

<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Now UI Dashboard by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/css/demo.css" rel="stylesheet" />
  <style>
    .is-invalid-label {
      color: red;
    }

    .error-message {
      color: red !important;
      font-size: 0.875em !important;
      margin-top: 5px !important;
    }
  </style>
</head>

<body class="user-profile">
  <div class="wrapper ">
    <?php include '../includes/admin_sidebar.php'; ?>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <?php include '../includes/admin_navbar.php'; ?>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="title">Admin Profile</h5>
            </div>
            <div class="card-body">
              <form method="POST" action="admin_user.php" id = "form">
                  <div class="row">
                      <div class="col-md-5 pr-1">
                          <div class="form-group">
                              <label for="company">Company (disabled)</label>
                              <input type="text" class="form-control" disabled="" placeholder="Company" value="SmartNotes Inc." name="company" id="company">
                          </div>
                      </div>
                      <div class="col-md-3 px-1">
                          <div class="form-group">
                              <label for="username">Username</label>
                              <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                              <div class="error-message" id="username-error"></div>
                          </div>
                      </div>
                      <div class="col-md-4 pl-1">
                          <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                              <div class="error-message" id="password-error"></div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6 pr-1">
                          <div class="form-group">
                              <label for="firstname">First Name</label>
                              <input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstname">
                              <div class="error-message" id="firstname-error"></div>
                          </div>
                      </div>
                      <div class="col-md-6 pl-1">
                          <div class="form-group">
                              <label for="lastname">Last Name</label>
                              <input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lastname">
                              <div class="error-message" id="lastname-error"></div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6 pr-1">
                          <div class="form-group">
                              <label for="country">Country</label>
                              <select class="form-control" id="country" name="country" id="country">
                                  <option value="">Select Country</option>
                                  <option value="United States">United States</option>
                                  <option value="Canada">Canada</option>
                                  <option value="United Kingdom">United Kingdom</option>
                                  <option value="Australia">Australia</option>
                                  <option value="Germany">Germany</option>
                                  <option value="France">France</option>
                                  <option value="Japan">Japan</option>
                                  <option value="China">China</option>
                                  <option value="India">India</option>
                                  <option value="Egypt">Egypt</option>
                                  <!-- Add more countries as needed -->
                              </select>
                              <div class="error-message" id="country-error"></div>
                          </div>
                      </div>
                      <div class="col-md-6 pl-1">
                          <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                              <div class="error-message" id="email-error"></div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <button type="submit" class="btn btn-primary btn-block" id="submit_button">Save Admin</button>
                              </div>
                              <div class="col-md-6">
                                  <button type="reset" class="btn btn-primary btn-block">Reset</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Admin Table</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Full Name
                      </th>
                      <th>
                        Username
                      </th>
                      <th>
                        Email
                      </th>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($admins as $admin) {
                          echo "<tr id='admin-row-{$admin->id}'>";
                          echo "<td>" . $admin->first_name . " " . $admin->last_name . "</td>";
                          echo "<td>" . $admin->email . "</td>";
                          echo "<td>" . $admin->email . "</td>";
                          echo '<td class="td-actions text-right">
                                  <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                                    <i class="now-ui-icons ui-2_settings-90"></i>
                                  </button>
                                  <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove" data-user-id="' . $admin->id . '" onclick="deleteUser(' . $admin->id . ', this)">
                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                  </button>
                                </td>';
                          echo "</tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
  <script src="../assets/js/now-ui-dashboard.js" type="text/javascript"></script>
  <script src="../assets/js/demo.js"></script>
  <script src="../assets/js/admin_form_validation.js"></script>
  <script>
    function deleteUser(userId, button) {
      if (confirm('Are you sure you want to delete this user?')) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_user.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            try {
              const response = JSON.parse(xhr.responseText);
              if (response.status === 'success') {
                document.getElementById('admin-row-' + userId).remove();
                console.log(response.message);
              } else {
                console.error(response.message);
              }
            } catch (e) {
              console.error("Invalid JSON response:", xhr.responseText);
              alert("An error occurred while processing the response.");
            }
          }
        };
        xhr.send('delete_user_id=' + userId);
      }
    }
  </script>
</body>
</html>