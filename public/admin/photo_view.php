<?php
require_once("../../includes/initialize.php");
if (!$session->is_logged_in()) { redirect_to('login.php'); }
?>
<?php
$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$per_page = 3;
$total_count = Photograph::count_all();
$pagination = new Pagination($page, $per_page, $total_count);
$sql = "SELECT * FROM photographs 
        LIMIT {$per_page} 
        OFFSET {$pagination->offset()}";


$photos_array = Photograph::find_by_sql($sql);
?>
<?php include_layout_template("admin_header.php");?>
<h2>Photos view</h2>
<?php echo output_message($message); ?>
<table border="1">
    <tr>
        <th>Photo</th>
        <th>Filename</th>
        <th>Type</th>
        <th>Size</th>
        <th>Caption</th>
        <th>Manage comments</th>
        <th>&nbsp;</th>
    </tr>
    <?php
    foreach($photos_array as $photo) { ?>
        <tr>
            <td><img width="200" height="150" src="../<?php echo $photo->image_path(); ?>"></td>
            <td><?php echo $photo->filename; ?></td>
            <td><?php echo $photo->type; ?></td>
            <td><?php echo $photo->size_as_text(); ?></td>
            <td><?php echo $photo->caption; ?></td>
            <td><a href="comments_view.php?id=<?php echo $photo->id; ?>"><?php echo count($photo->comments()); ?> comments</a></td>
            <td><a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a> </td>
        </tr>
    <?php }
    ?>
</table>
<div id="pagination">
    <?php
    if($pagination->total_pages() > 1) {
        if($pagination->has_previous_page()) {
            echo " <a href=\"photo_view.php?page=";
            echo $pagination->previous_page();
            echo "\">&laquo; Previous</a> ";
        }
        for($i=1;$i<=$pagination->total_pages();$i++) {
            if ($i == $page) {
                echo " <span class=\"selected\">{$i}</span> ";
            } else {
                echo " <a href=\"photo_view.php?page={$i}\">{$i}</a> ";
            }
        }
        if($pagination->has_next_page()) {
            echo " <a href=\"photo_view.php?page=";
            echo $pagination->next_page();
            echo "\">&raquo; Next</a> ";
        }
    }
    ?>
</div>
<br>
<br>
<a href="photo_upload.php">Upload a new photo.</a>
<?php include_layout_template("admin_footer.php");?>