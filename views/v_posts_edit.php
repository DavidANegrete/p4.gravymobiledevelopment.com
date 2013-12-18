
    <div id = "page-wrapper">
        <?php foreach($post_db as $post): ?>
        <h1>Edit Post</h1>
        <p><?=$post['content']?></p>
        <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
            <?=Time::display($post['created'])?>
        </time>
        <br>
        <br>
        <form method='POST' action='/posts/p_edit/?$post['created']'>

        <label for='content'>New Post:</label><br>
        <textarea name='content' id='content'></textarea>

        <br><br>
        <input type='submit' value='Edit Post'>

        </form>
        <?php endforeach; ?>
    </div>
























