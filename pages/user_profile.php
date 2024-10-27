<?php
session_start();	
include_once "../includes/User.php";

if (isset($_SESSION["id"])) {
  $UserObject = new User($_SESSION["id"]);
  // Proceed with the rest of your code
} else {
  echo "User is not logged in.";
  // header("Location: login.php");
  // exit();
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
</head>
<body>
<?php include '../includes/user_sidebar.php'; ?>
<div class="main-container">
    <div class = "main--content">
      <div class="main-body">
            <div class="row gutters-sm">
              <div class="col-md-4 mb-3">
                <div class="card blue-card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                      <i class="fa-regular fa-address-card" style="font-size: 50px; color: #95c3fc;"></i>
                      <div class="mt-3">
                        <h4 style= "font-weight: 600;">John Doe</h4>
                        <p class="text-secondary mb-1">Full Stack Developer</p>
                        <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                        <button class="btn btn-primary">Log out</button>
                        <button class="btn btn-outline-primary">Deactivate Account</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row gutters-sm">
                  <button class="card mt-3"  style= "width: 186px; margin-left: 10px;">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        <div class="mt-0">
                          <div class="row">
                            <i class="fa-solid fa-phone" style="font-size: 30px; color: #95c3fc; margin-right: 20px"></i>
                            <p style="font-size: 20px; font-weight: 600;">Contact Us</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </button>
                  <button class="card mt-3" style= "width: 186px; margin-left: 10px;">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        <div class="mt-0">
                          <div class= "row">
                            <i class="fa-solid fa-circle-question" style="font-size: 30px; color: #dbf79b; margin-right: 20px"></i>
                            <p style="font-size: 20px; font-weight: 600;">FAQ</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </button>
                </div>
                <div class="card mt-3">
                  <div class="card-header" style= "background-color: black;">
                    <h6 class="d-flex align-items-center" style="margin: 0px; color: #d5fed4;">Survey Answers</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap green-card">
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
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap green-card">
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
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap green-card">
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
              <div class="col-md-8">
                <div class="card mb-3 purple-card">
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="<?php echo $UserObject->username ?>" name="username">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Password</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input name="firstname" type="text" class="form-control" value="<?php echo $UserObject->first_name ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <input name="lastname" type="text" class="form-control" value="<?php echo $UserObject->last_name ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="email" type="email" class="form-control" value="<?php echo $UserObject->email ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Country</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  <select class="form-control" id="country" name="country" value="<?php echo $UserObject->country ?>">
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
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary"
                                    onclick="editUser(
                                        <?php echo htmlspecialchars($userObj->id, ENT_QUOTES, 'UTF-8'); ?>, 
                                        '<?php echo htmlspecialchars($userObj->first_name, ENT_QUOTES, 'UTF-8'); ?>', 
                                        '<?php echo htmlspecialchars($userObj->last_name, ENT_QUOTES, 'UTF-8'); ?>', 
                                        '<?php echo htmlspecialchars($userObj->username, ENT_QUOTES, 'UTF-8'); ?>', 
                                        '<?php echo htmlspecialchars($userObj->email, ENT_QUOTES, 'UTF-8'); ?>', 
                                        '<?php echo htmlspecialchars($userObj->country, ENT_QUOTES, 'UTF-8'); ?>'
                                    )">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row gutters-sm">
                  <div class="col-sm-6 mb-3">
                    <div class="card h-100 pink-card">
                      <div class="card-body">
                        <h6 class="d-flex align-items-center mb-3">Support and Feedback</h6>
                        <small>Web Design</small>
                        <div class="progress mb-3" style="height: 5px">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small>Website Markup</small>
                        <div class="progress mb-3" style="height: 5px">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small>One Page</small>
                        <div class="progress mb-3" style="height: 5px">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 mb-3">
                    <div class="card h-100 yellow-card">
                        <div class="card-body text-center  yellow-card-justify">
                            <h6 class="d-flex align-items-center justify-content-center mb-3">
                                Notes
                                <i class="material-icons text-info ml-2">notes icon</i>
                            </h6>
                            <div class="circle-container">
                                <div class="circle">
                                    <span class="note-count">42</span> <!-- Example count -->
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block mt-3" onclick="window.location.href='/notes'">View Notes</button>
                        </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>