<?php
function showMessage(){
    if (isset($_SESSION['error'])) {
        echo '<div class="error_message">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }

    if (isset($_SESSION['success'])) {
        echo '<div class="success_message">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
}
?>