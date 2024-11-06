<?php
session_start();
session_unset();
session_destroy();
header("Location: /EUPHORIA/project_campus_management/campus_recruitment_management_system/index.php");
exit();
?>

