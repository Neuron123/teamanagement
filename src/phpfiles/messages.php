<?php
session_start();

function set_message($message, $type = 'info') {
    $_SESSION['messages'][] = array(
        'message' => $message,
        'type' => $type
    );
}

function get_messages() {
    $messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
    unset($_SESSION['messages']);
    return $messages;
}
?>
