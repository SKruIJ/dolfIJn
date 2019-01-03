<?php

/****************************************
dolfIJn
SKruIJ 2016-03-02
/actions/error_messages_creator.php
build of error and messages string from login and registration object
****************************************/

// ü check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

//  #messages and #errors are pushed here and to the $dlf_message and $dlf_error arrays

// show potential #errors / #messages (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
			array_push($dlf_error, $error);
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            array_push($dlf_message, $message);
        }
    }
}

// show potential #errors / #messages (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            array_push($dlf_error, $error);
            //$dlf_error_out = $dlf_error_out . $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            array_push($dlf_message, $message);
            //$dlf_message_out = $dlf_message_out . $message;
        }
    }
}

?>
