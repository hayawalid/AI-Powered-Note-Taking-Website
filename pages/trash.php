<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trash</title>
    <link rel="stylesheet" href="../assets/css/user_style.css">
    <link rel="stylesheet" href="../assets/css/backend-plugin.min.css?v=1.0.0">
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include '../includes/user_sidebar.php'; ?>
    <!-- Wrapper Start -->
    <div class="wrapper"></div>
    <div class="content-page">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-block card-stretch card-height note-table">
                        <div class="card-body custom-notes-space">
                            <div class="table-responsive">
                                <table id="tree-table-9" class="table tree mb-0 tbl-server-info">
                                    <thead class="bg-white text-uppercase">
                                        <tr class="ligth">
                                            <th>Title</th>
                                            <th>deleted</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $obj = folder::readTrash();
                                        if ($obj) {
                                            foreach ($obj as $folder) {
                                                ?>
                                                <tr data-id="<?php echo $folder['folder_id']; ?>" data-parent="0" data-level="1">
                                                    <td data-column="name"><?php echo $folder['name']; ?></td>
                                                    <td><?php echo $folder['deleted_at']; ?></td>
                                                    <td>
                                                        <div>
                                                            <a href="#" class="badge badge-success mr-3 edit-note" data-toggle="modal" data-target="#edit-note">
                                                                <i class="fa-solid fa-rotate"></i>
                                                            </a>
                                                            <a href="#" class="badge badge-danger" data-extra-toggle="delete" data-closest-elem="tr">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>

        <!-- Wrapper End-->

    </div>

    <!-- Page end  -->

    <!-- <div class="containers">
        <h2>Recently Deleted<small></small></h2>
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">Job Id</div>
                <div class="col col-2">Customer Name</div>
                <div class="col col-3">Amount Due</div>
                <div class="col col-4">Payment Status</div>
            </li>
            <li class="table-row">
                <div class="col col-1" data-label="Job Id">42235</div>
                <div class="col col-2" data-label="Customer Name">John Doe</div>
                <div class="col col-3" data-label="Amount">$350</div>
                <div class="col col-4" data-label="Payment Status">Pending</div>
            </li>
            <li class="table-row">
                <div class="col col-1" data-label="Job Id">42442</div>
                <div class="col col-2" data-label="Customer Name">Jennifer Smith</div>
                <div class="col col-3" data-label="Amount">$220</div>
                <div class="col col-4" data-label="Payment Status">Pending</div>
            </li>
            <li class="table-row">
                <div class="col col-1" data-label="Job Id">42257</div>
                <div class="col col-2" data-label="Customer Name">John Smith</div>
                <div class="col col-3" data-label="Amount">$341</div>
                <div class="col col-4" data-label="Payment Status">Pending</div>
            </li>
            <li class="table-row">
                <div class="col col-1" data-label="Job Id">42311</div>
                <div class="col col-2" data-label="Customer Name">John Carpenter</div>
                <div class="col col-3" data-label="Amount">$115</div>
                <div class="col col-4" data-label="Payment Status">Pending</div>
            </li>
        </ul>
    </div> -->
    <script src="../assets/js/sidebar.js"></script>

</body>

</html>