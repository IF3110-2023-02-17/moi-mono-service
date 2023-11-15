<head>
    <link rel="stylesheet" type="text/css" href="/styles/studio/dashboard-post.css">
    <link rel="stylesheet" type="text/css" href="/styles/post/card.css">
    <script type="text/javascript" src="/js/studio/dashboard-post.js" defer></script>
</head>

<div class="studio-post-container">
    <?php foreach ($posts as $index => $post) : ?>
        <div class="post-card">
            <a class="post-card-wrap" href="/post/<?= $post['post_id'] ?>">
                <div class="post-img-wrap">
                    <img class="post-img" src="<?= STORAGE_URL ?>/img/post/<?= $post["img_path"] ?>" alt="<?= $post["title"] ?>" />
                </div>
                <div class="post-detail-wrap">
                    <div class="post-detail-title">
                        <h4 class="title"><?= $post["title"] ?></p>
                    </div>
                    <div class="post-detail-body">
                        <?php if(strlen($post['body']) < 300) : ?>
                            <p class="body"><?= $post['body'] ?></p>
                        <?php else : ?>
                            <p class="body"><?= substr($post['body'], 0, 277) ?>...</p>
                        <?php endif; ?>
                    </div>
                    <div class="post-detail-date">
                        <p class="date"><?= $post['updated_at'] ?></p>
                    </div>
                </div>    
            </a>
        </div>
    <?php endforeach; ?>
</div>
<div class="pagination-group-post">
    <button class="prev-page-post page-button-post page-part-post" disabled>
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </svg>
    </button>
    <div class="page-text-post page-part-post">
        <span id="page-number"><?= $post_page ?></span> / <?= $post_count ?>
    </div>
    <button class="next-page-post page-button-post page-part-post" disabled>
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
        </svg>
    </button>
</div>