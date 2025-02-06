<<div class="reply">
    <h4><?= $data['Name']; ?></h4>
    <p><?= $data['date']; ?></p>
    <p><?= $data['comment']; ?></p>
    <button class="reply" onclick="reply(<?php echo $data['id']; ?>, '<?php echo $data['Name']; ?>');">Reply</button>
    <?php
    $reply_id = $data['id'];
    $replies = mysqli_query($conn, "SELECT * FROM commenttb WHERE reply_id = $reply_id");
    if(mysqli_num_rows($replies) > 0) {
        foreach($replies as $reply){
            require 'reply.php';
        }
    }
    ?>
</div>
