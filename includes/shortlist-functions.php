<?php
function shortlist_start_session() {
    if(!session_id()) {
        session_start();
    }
}
add_action('init', 'shortlist_start_session', 1);

function list_count() {
    if(isset($_SESSION['shortlist'])) {
        echo count($_SESSION['shortlist']);
    } else {
        echo '0';
    }  
}


function debug_shortlist() {
    echo '<br><pre class="entry-content">';
    if(!empty($_SESSION['shortlist'])) {
        print_r($_SESSION['shortlist']);
    } else {
        echo 'Session is empty.';
    }  
    echo '</pre>';
}



//start the session, if not already running
if(!session_id()) {
    session_start();
}
         
// define a fallback value for an shortlist session
if(!isset($_SESSION['shortlist'])) {
    $_SESSION['shortlist'] = array();
}


// define variable defaults
$action = null;
$id = 0;
 
// assign action and id parameters if set
if ( isset( $_GET['action'] ) && !empty( $_GET['action'] ) ) {
    //the action from the URL
    $action = $_GET['action'];
}
if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) ) {
    //the item id from the URL
    $id = $_GET['id'];
}


switch($action) {  
 
    case "add":
        // check if item is already in array, if not, add
        if(($key = array_search($id, $_SESSION['shortlist'])) === false) {
            array_push( $_SESSION['shortlist'], $id );
        }
    break;
     
    case "remove":
        // search for item by value and remove if found
        if(($key = array_search($id, $_SESSION['shortlist'])) !== false) {
            unset($_SESSION['shortlist'][$key]);
        }
    break;
     
    case "empty":
        //remove all
        unset($_SESSION['shortlist']);
    break;
 
}

?>