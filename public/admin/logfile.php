<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to('login.php'); }
?>
<?php
if ($_GET['clear'] == true) {
    $logger->log_clean();
    redirect_to("logfile.php");
}
?>
<?php include_layout_template("admin_header.php");?>
<h2>Logged users</h2>
<?php
if (!isset($_GET['clear'])) {
    $logger->log_read();
}

?>
<a href="logfile.php?clear=true">Clear file log</a>
<?php include_layout_template("admin_footer.php");?>
