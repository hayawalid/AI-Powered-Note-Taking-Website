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
                                            <!-- <th>Created By</th> -->
                                            <th>Updated</th>
                                            <!-- <th>Shared With</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-id="1" data-parent="0" data-level="1">
                                            <td data-column="name">First Notebook</td>
                                            <td>Dec 4</td>
                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i class="fa-solid fa-rotate"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="fa-solid fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="2" data-parent="1" data-level="1">
                                            <td data-column="name">Birthday Celebration</td>
                                            <td>Dec 4</td>
                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="3" data-parent="1" data-level="1">
                                            <td data-column="name">Lecture Notes</td>
                                            <td>Dec 5</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="4" data-parent="1" data-level="1">
                                            <td data-column="name">Meal Planner</td>
                                            <td>Dec 6</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="5" data-parent="0" data-level="1">
                                            <td data-column="name">Project Plan</td>
                                            <td>Dec 4</td>
                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="6" data-parent="5" data-level="1">
                                            <td data-column="name">Birthday</td>
                                            <td>Bud Wiser</td>
                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="7" data-parent="5" data-level="1">
                                            <td data-column="name">Essay Outline</td>
                                            <td>Dec 4</td>
                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="8" data-parent="5" data-level="1">
                                            <td data-column="name">Lecture Notes</td>
                                            <td>Dec 5</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="9" data-parent="0" data-level="1">
                                            <td data-column="name">Meeting Notes</td>
                                            <td>Dec 5</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="10" data-parent="9" data-level="2">
                                            <td data-column="name">Reminder</td>
                                            <td>Dec 5</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="11" data-parent="9" data-level="2">
                                            <td data-column="name">to-do</td>
                                            <td>Dec 5</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="12" data-parent="9" data-level="2">
                                            <td data-column="name">Daily Reflection</td>
                                            <td>Dec 5</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="13" data-parent="0" data-level="1">
                                            <td data-column="name">Event Notes</td>
                                            <td>Dec 8</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="14" data-parent="13" data-level="2">
                                            <td data-column="name">Meal Planner</td>
                                            <td>Dec 6</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="15" data-parent="13" data-level="2">
                                            <td data-column="name">to-do</td>
                                            <td>Dec 5</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="16" data-parent="13" data-level="2">
                                            <td data-column="name">Daily Reflection</td>
                                            <td>Dec 5</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="17" data-parent="0" data-level="1">
                                            <td data-column="name">Classic Notes</td>
                                            <td>Dec 10</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="18" data-parent="17" data-level="2">
                                            <td data-column="name">Note Planner</td>
                                            <td>Dec 6</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="19" data-parent="17" data-level="2">
                                            <td data-column="name">Event Note</td>
                                            <td>Dec 5</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="20" data-parent="17" data-level="2">
                                            <td data-column="name">Daily Meting</td>
                                            <td>Dec 6</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="21" data-parent="0" data-level="1">
                                            <td data-column="name">New Classic</td>
                                            <td>Dec 19</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="22" data-parent="21" data-level="2">
                                            <td data-column="name">Event note</td>
                                            <td>Dec 20</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="23" data-parent="0" data-level="1">
                                            <td data-column="name">Second Note</td>
                                            <td>Dec 5</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="24" data-parent="23" data-level="2">
                                            <td data-column="name">Daily Meting</td>
                                            <td>Dec 6</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="25" data-parent="0" data-level="1">
                                            <td data-column="name">New Meting</td>
                                            <td>Dec 6</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="26" data-parent="25" data-level="2">
                                            <td data-column="name">Meting Updates</td>
                                            <td>Dec 6</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="27" data-parent="25" data-level="2">
                                            <td data-column="name">Date List</td>
                                            <td>Dec 9</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="28" data-parent="0" data-level="1">
                                            <td data-column="name">Fresser List</td>
                                            <td>Dec 10</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="29" data-parent="28" data-level="2">
                                            <td data-column="name">Updated List</td>
                                            <td>Dec 10</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="30" data-parent="28" data-level="2">
                                            <td data-column="name">New Date</td>
                                            <td>Dec 10</td>
                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="31" data-parent="28" data-level="2">
                                            <td data-column="name">Fress List</td>
                                            <td>Dec 10</td>
                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="32" data-parent="0" data-level="1">
                                            <td data-column="name">New Details</td>
                                            <td>Dec 10</td>
                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="33" data-parent="32" data-level="2">
                                            <td data-column="name">New work</td>
                                            <td>Dec 10</td>
                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="34" data-parent="0" data-level="1">
                                            <td data-column="name">Updated List</td>
                                            <td>Dec 10</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="35" data-parent="34" data-level="2">
                                            <td data-column="name">Updated doc</td>
                                            <td>Dec 10</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="36" data-parent="0" data-level="1">
                                            <td data-column="name">New Updates</td>
                                            <td>Dec 10</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="37" data-parent="36" data-level="2">
                                            <td data-column="name">New Updates</td>
                                            <td>Dec 10</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="38" data-parent="0" data-level="1">
                                            <td data-column="name">Work Notes</td>
                                            <td>Dec 21</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-id="39" data-parent="38" data-level="2">
                                            <td data-column="name">Work Notes</td>
                                            <td>Dec 22</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="badge badge-success mr-3 edit-note"
                                                        data-toggle="modal" data-target="#edit-note"><i
                                                            class="las la-pen mr-0"></i></a>
                                                    <a href="#" class="badge badge-danger" data-extra-toggle="delete"
                                                        data-closest-elem="tr"><i class="las la-trash-alt mr-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
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