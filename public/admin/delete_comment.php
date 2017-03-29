<?php
require_once("../../includes/initialize.php");
if (!$session->is_logged_in()) { redirect_to('login.php'); }
if (empty($_GET['id'])) {
    $session->message("The comment ID wasnt provided.");
    redirect_to("photo_view.php");
} else {
    $comment = Comment::find_by_id($_GET['id']);
    if ($comment && $comment->delete()) {
        $session->message("Comment deleted");
        redirect_to("comments_view.php?id={$comment->photograph_id}");
    } else {
        $session->message("Comment can not be deleted.");
        redirect_to("comments_view.php?id={$comment->photograph_id}");
    }

}

?>
<?php if(isset($database)) { $database->close_connection(); } ?>
