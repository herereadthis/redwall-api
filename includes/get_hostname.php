<?php
if ($_SERVER["SERVER_NAME"] === "localhost") {
    $db_hostname = $db_external;
}
else {
    $db_hostname = $db_internal;
}
?>