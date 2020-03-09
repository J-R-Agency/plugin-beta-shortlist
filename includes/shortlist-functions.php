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


?>