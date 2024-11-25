<?php
session_start();	
include_once "../includes/User.php";
//set current page to update sidebar status
$current_page = 'My Account';

if (isset($_SESSION["UserID"])) {
  $UserObject = new User($_SESSION["UserID"]);
  // Proceed with the rest of your code
} else {
  echo "User is not logged in.";
  header("Location: login.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Username = htmlspecialchars($_POST["username"]);
  $Password = htmlspecialchars($_POST["password"]);
  // Encrypt password for additional security
  $Hashedpassword = password_hash($Password, PASSWORD_DEFAULT);
  $Fname = htmlspecialchars($_POST["firstname"]);
  $Lname = htmlspecialchars($_POST["lastname"]);
  $Email = htmlspecialchars($_POST["email"]);
  $Country = htmlspecialchars($_POST["country"]);
  $UserType = new UserType(1);

  $UserObject->first_name = $Fname;
  $UserObject->last_name = $Lname;
  $UserObject->username = $Username;
  $UserObject->email = $Email;
  $UserObject->password = $Hashedpassword;
  $UserObject->country = $Country;
  $UserObject->user_type = $UserType->id;
  $result = $UserObject->updateUser();
  echo "alert('User updated successfully');";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="../assets/css/user_style.css" rel="stylesheet">
    <link href="../assets/css/user_profile.css" rel="stylesheet">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
      label {
        font-size: 14px !important;
      }

      h6{
        font-weight: 500;
        text-transform: none;
      }

      .btn-primary{
        background-color: #E66A6A !important;
        color: white;
      }

      .btn-primary:hover{
        background-color: #88aef4 !important;
      }

      .btn-outline-primary{
        color: #E66A6A !important;
        border-color: #E66A6A !important
      }

      .btn-outline-primary:hover{
        color: #88aef4 !important;
        border-color: #88aef4 !important
      }
    </style>
</head>
<body>
<?php include '../includes/sidebar.php'; ?>
<div class="main-panel">
  <main class="content">
      <div class="bordered-content">
        <div style=>
            <div class="row gutters-sm">
              <div class="col-md-6 mb-0">
                <div class="card white-card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                      <i class="now-ui-icons business_badge" style="font-size: 60px; margin-bottom: 0px;"></i>
                      <div>
                        <h4 style= "font-weight: 600;"><?php echo $UserObject->username?></h4>
                        <p class="text-secondary mb-1"><?php echo $UserObject->first_name." ".$UserObject->last_name.", ".$UserObject->country?></p>
                        <p class="text-muted font-size-sm"><?php echo $UserObject->email?></p>
                        <button id="logout-btn" class="btn btn-primary">Log out</button>
                        <button id="deactivate-btn" class="btn btn-outline-primary">Deactivate Account</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-0">
                <div class="card" style="height: 300px">
                  <div class="card-body">
                  <div class="card-header" style= "background-color: white;">
                    <h5 class="d-flex align-items-center" style="margin: 0px; color: black; font-weight: 400;">Survey Answers</h5>
                    <hr>
                  </div>
                  <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap white-card">
                          <h6 class="mb-0 d-flex align-items-center">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="pink" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-2 icon-inline">
                                <path d="M12 18.5A2.493 2.493 0 0 1 7.51 20H7.5a2.468 2.468 0 0 1-2.4-3.154 2.98 2.98 0 0 1-.85-5.274 2.468 2.468 0 0 1 .92-3.182 2.477 2.477 0 0 1 1.876-3.344 2.5 2.5 0 0 1 3.41-1.856A2.5 2.5 0 0 1 12 5.5m0 13v-13m0 13a2.493 2.493 0 0 0 4.49 1.5h.01a2.468 2.468 0 0 0 2.403-3.154 2.98 2.98 0 0 0 .847-5.274 2.468 2.468 0 0 0-.921-3.182 2.477 2.477 0 0 0-1.875-3.344A2.5 2.5 0 0 0 14.5 3 2.5 2.5 0 0 0 12 5.5m-8 5a2.5 2.5 0 0 1 3.48-2.3m-.28 8.551a3 3 0 0 1-2.953-5.185M20 10.5a2.5 2.5 0 0 0-3.481-2.3m.28 8.551a3 3 0 0 0 2.954-5.185"></path>
                              </svg>
                              Usage
                          </h6>
                          <select class="form-control text-secondary ml-3" style="width: 150px;">
                              <option value="work">Work</option>
                              <option value="personal">Personal</option>
                              <option value="school">School</option>
                          </select>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap white-card">
                          <h6 class="mb-0 d-flex align-items-center">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="gold" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline">
                                  <path d="m7.171 12.906-2.153 6.411 2.672-.89 1.568 2.34 1.825-5.183m5.73-2.678 2.154 6.411-2.673-.89-1.568 2.34-1.825-5.183M9.165 4.3c.58.068 1.153-.17 1.515-.628a1.681 1.681 0 0 1 2.64 0 1.68 1.68 0 0 0 1.515.628 1.681 1.681 0 0 1 1.866 1.866c-.068.58.17 1.154.628 1.516a1.681 1.681 0 0 1 0 2.639 1.682 1.682 0 0 0-.628 1.515 1.681 1.681 0 0 1-1.866 1.866 1.681 1.681 0 0 0-1.516.628 1.681 1.681 0 0 1-2.639 0 1.681 1.681 0 0 0-1.515-.628 1.681 1.681 0 0 1-1.867-1.866 1.681 1.681 0 0 0-.627-1.515 1.681 1.681 0 0 1 0-2.64c.458-.361.696-.935.627-1.515A1.681 1.681 0 0 1 9.165 4.3ZM14 9a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"></path>
                              </svg>
                              Goal
                          </h6>
                          <select class="form-control text-secondary ml-3" style="width: 220px;">
                              <option value="store">Store and organize data</option>
                              <option value="capture">Capture ideas quickly</option>
                              <option value="manage">Manage projects or tasks</option>
                          </select>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap white-card">
                          <h6 class="mb-0 d-flex align-items-center">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info">
                                <path d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"></path>
                              </svg>
                              Source
                          </h6>
                          <select class="form-control text-secondary ml-3" style="width: 230px;">
                              <option value="online">Online/App store search</option>
                              <option value="recommended">It was recommended</option>
                              <option value="ad">An ad</option>
                          </select>
                      </li>
                  </ul>
                </div>
              </div>
              </div>
              <div class="col-md-12 mb-0">
                <div class="card white-card">
                    <div class="card-body">
                      <form action="" method="POST" id="form">
                        <input type="hidden" name="user_id" id="user_id">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="mb-0">Username</label>
                                </div>
                                
                                  <div class="col-sm-4 text-secondary">
                                      <input type="text" class="form-control" value="<?php echo $UserObject->username ?>" name="username">
                                      <div class="error-message" id="username-error"></div>
                                  </div>
                                  <div class="col-sm-1">
                                        <label class="mb-0">Password</label>
                                    </div>
                                    <div class="col-sm-4 text-secondary">
                                        <input type="password" class="form-control" name="password">
                                        <div class="error-message" id="password-error"></div>
                                    </div>
                                
                            </div>                            
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="mb-0">Full Name</label>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input name="firstname" type="text" class="form-control" value="<?php echo $UserObject->first_name ?>">
                                            <div class="error-message" id="firstname-error"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <input name="lastname" type="text" class="form-control" value="<?php echo $UserObject->last_name ?>">
                                            <div class="error-message" id="lastname-error"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="mb-0">Email</label>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="email" type="email" class="form-control" value="<?php echo $UserObject->email ?>">
                                    <div class="error-message" id="email-error"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="mb-0">Country</label>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <select class="form-control" id="country" name="country">
                                  <option value="">Select Country</option>
                                  <?php 
                                  $countries = ["United States", "Canada", "United Kingdom", "Australia", "Germany", "France", "Japan", "China", "India", "Egypt"];
                                  foreach ($countries as $country) {
                                      $selected = ($UserObject->country === $country) ? 'selected' : '';
                                      echo "<option value='$country' $selected>$country</option>";
                                  }
                                  ?>
                                </select>
                                  <div class="error-message" id="country-error"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                <button type="button" class="btn btn-primary" onclick="saveChanges('<?php echo htmlspecialchars($UserObject->username, ENT_QUOTES, 'UTF-8'); ?>', 
                                        '<?php echo htmlspecialchars($UserObject->email, ENT_QUOTES, 'UTF-8'); ?>')">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>
          </div>
    </div>
  </main>
  </div>
    <script src="../assets/js/user_profile.js"></script>
    <script src="../assets/js/admin_form_validation.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Chart JS -->
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
</body>
</html>