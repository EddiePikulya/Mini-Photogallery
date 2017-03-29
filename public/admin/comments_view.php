<?php
require_once("../../includes/initialize.php");
if (!$session->is_logged_in()) { redirect_to('login.php'); }
if (isset($_GET['id'])) {
    $comments = Comment::find_comments_on($_GET['id']);
} else {
    redirect_to('photo_view.php');
}
include_layout_template("admin_header.php");
?>
<a href="photo_view.php">&laquo; Back</a><br><br>
<h2>Comments view</h2>
<?php echo output_message($message); ?>
<div id="comments">
    <?php foreach ($comments as $comment) {?>
        <div class="comment" style="margin-bottom: 2em;">
            <div class="author">
                <?php echo htmlentities($comment->author); ?>:
            </div>
            <div class="body">
                <?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
            </div>
            <div class="meta-info" style="font-size: 0.8em;">
                <?php echo datetime_to_text($comment->created); ?>
            </div>
            <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete comment</a>
        </div>
    <?php }; ?>
    <?php if(empty($comments)) { echo "No Comments."; } ?>
</div>
<?php include_layout_template("admin_footer.php");?>