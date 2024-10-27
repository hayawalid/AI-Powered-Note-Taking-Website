<?php
session_start();
include_once "User.php"; // Adjust the path as necessary

function isPageAllowed($currentPage, $allowedPages) {
    foreach ($allowedPages as $page) {
        if ($page->link_address === $currentPage) {
            return true;
        }
    }
    return false;
}

$currentPage = basename($_SERVER['PHP_SELF']); // Get the current page name

if (!empty($_SESSION['UserID'])) {
    $UserObject = new User($_SESSION["UserID"]);

    // Validate if the current page is allowed for this user
    if (isPageAllowed($currentPage, $UserObject->userType_obj->pages_array)) {
        // Page is allowed, proceed
    } else {
        // Unauthorized access
        http_response_code(500);
        echo "<h1>500 - Unauthorized Access</h1>";
        exit;
    }
} else {
    // No session, fetch default pages for visitor
    $con = mysqli_connect("localhost", "root", "", "smartnotes_db");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "
        SELECT pages.friendly_name, pages.link_address 
        FROM pages 
        INNER JOIN usertype_pages ON pages.id = usertype_pages.page_id 
        WHERE usertype_pages.usertype_id = 3";
    $result = mysqli_query($con, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['link_address'] === $currentPage) {
                // Page is allowed, proceed
                exit;
            }
        }
        // If no match found, unauthorized
        http_response_code(500);
        header("Location: 401.php");
        exit;
    } else {
        echo "Error fetching pages: " . mysqli_error($con);
    }
    
    mysqli_close($con);
}
?>
