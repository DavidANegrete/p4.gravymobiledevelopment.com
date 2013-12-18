<?php foreach($posts as $post): ?>
<div id = "page-wrapper">

        <h1><?=$post['first_name']?> <?=$post['last_name']?> posted:</h1>

        <p><?=$post['content']?></p>

        <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
            <?=Time::display($post['created'])?>
        </time>
        <br>
        <a href='/posts/edit/?user=<?=$post['post_user_id']?>&post=<?=$post['post_id']?> '>Edit</a>

  </div>

<?php endforeach; ?>
