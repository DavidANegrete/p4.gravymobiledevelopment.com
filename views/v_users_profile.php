
    <div id = "page-wrapper">
        <?php if($user):?>
            <h1>What's yappining? <?=$user->first_name?> </h1>
            <h1 class="posts"><a href="/posts/index">posts</a></h1>
            <h1 class="add-post"><a href="/posts/add">add a post</a></h1>
            <h1 class="follow-unfollow"><a href="/posts/users">follow/unfollow</a></h1>
            <h1 class="bio"><a href="/bios/add">bio</a></h1>
<?php endif; ?>
    </div>

