<?php
    // Create or open an SQLite3 database
    $db = new SQLite3('hotelm.db');
    // Check if the database was created or opened successfully
    if ($db) {
    echo '<script>console.log("Database created/opened successfully!")</script>';
    } else {
    echo '<script>console.log("Failed to open/create the database.")</script>';
    }
    session_start();
    if(!isset($_SESSION['UserData']['Username'])){
        header("location:login.php");
        exit;
    }

    $records_per_page = 4;
    $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    if ($current_page < 1) $current_page = 1;
    $offset = ($current_page - 1) * $records_per_page;

    $total_query = "SELECT COUNT(*) as total FROM Booking";
    $total_result = $db->query($total_query);
    $total_row = $total_result->fetchArray(SQLITE3_ASSOC);
    $total_records = $total_row['total'];
    $total_pages = ceil($total_records / $records_per_page);

    $select_query = "SELECT * FROM Booking LIMIT $records_per_page OFFSET $offset";
    $result = $db->query($select_query);

    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<link rel="stylesheet" type="text/css" href="style.css" />';
    echo '<script src="script.js"></script>';
    echo '<title>Hotel Management</title>';
    echo '<body onload="loadNavbar()">';
    echo '<div id="navbar-container"></div>';
    echo '<div class="content-area">';
    echo '<h1 class="list-header">Bookings</h1>';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<td>ID</td>';
    echo '<td>Check In Date</td>';
    echo '<td>Check Out Date</td>';
    echo '<td>Cost (£)</td>';
    echo '<td>Hotel ID</td>';
    echo '<td>Room Number</td>';
    echo '<td>Guest ID</td>';
    echo '<td colspan="2"></td>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $bookingID = $row['bookingID'];
        echo '<tr><td>' . $row['bookingID'] . '</td>' . '<td>' . $row['bookingCheckInDate'] . '</td>' . '<td>' . $row['bookingCheckOutDate'] . '</td>' . '<td>' . $row['bookingCost'] . '</td>' . '<td>' . $row['hotelID'] . '</td>' . '<td>' . $row['roomNo'] . '</td> <td>' . $row['guestID'] . '</td> <td><a href="updatef-booking.php?bookingID='.$bookingID.'"><span class="material-symbols-rounded">edit</span></a></td> <td><a href="bookings-delete.php?bookingID='.$bookingID.'"><span class="material-symbols-rounded">delete</span></a></td> </tr>';
    }
    echo '</tbody>';
    echo '</table>';
    
    //pagination
    if($current_page > 1){
        $prev_page = $current_page - 1;
        echo "<a href='?page=$prev_page'><button class='paginator-direction' >←</button></a>";
    }
    for ($i = 1; $i <= $total_pages; $i++){
        if($i==$current_page){
            echo "<button class='paginator-page-selected' disabled>$i</button>";
        } else {
            echo "<a href='?page=$i'><button class='paginator-page'>$i</button></a>";
        }
    }
    if($current_page<$total_pages){
        $next_page = $current_page + 1;
        echo "<a href='?page=$next_page'><button class='paginator-direction'>→</button></a>";
    }

    echo '</div>';
    echo '</body>';

    // Close the database connection when done
    $db->close();
?>