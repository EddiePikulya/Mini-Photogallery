<?php
require_once("../includes/initialize.php");
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 3;
$total_count = Photograph::count_all();

$pagination = new Pagination($page, $per_page, $total_count);
$sql = "SELECT * FROM photographs 
        LIMIT {$per_page} 
        OFFSET {$pagination->offset()}";
$photos = Photograph::find_by_sql($sql);
include_layout_template("header.php");
?>
<h2>Out Photos</h2>
<div style="display: flex">
    <?php foreach ($photos as $photo) {?>
        <div style="margin-left: 20px">
            <a href="photo.php?id=<?php echo $photo->id;?>">
                <img width="200" src="<?php echo $photo->image_path();?>">
            </a>
            <p><?php echo $photo->caption; ?></p>
        </div>
        <br><br>
    <?php } ?>
</div>
<div id="pagination">
    <?php
    if($pagination->total_pages() > 1) {
        if($pagination->has_previous_page()) {
            echo " <a href=\"index.php?page=";
            echo $pagination->previous_page();
            echo "\">Previous &laquo;</a> ";
        }
        for($i=1;$i<=$pagination->total_pages();$i++) {
            if($i == $page) {
                echo " <span class=\"selected\">{$i}</span> ";
            } else {
                echo " <a href=\"index.php?page={$i}\">{$i}</a> ";
            }
        }

        if($pagination->has_next_page()) {
            echo " <a href=\"index.php?page=";
            echo $pagination->next_page();
            echo "\">Next &raquo;</a> ";
        }
    }

    ?>
</div>


<?php include_layout_template("footer.php"); ?>