<head>
    <link rel="stylesheet" type="text/css" href="/styles/studio/card.css">
</head>

<div class="studio-card" id=<?= $studio->studio_id?> >
    <a class="studio-detail" href="/studio/dashboard/<?= $studio->studio_id ?>">
        <div class="studio-name-wrap">
            <h2 class="studio-name"><?= $studio->name ?></h2>
        </div>
        <div class="studio-description-wrap">
            <p class="studio-description">
                <?= $studio->description ?>
            </p>
        </div>
    </a>
    <div class="studio-panel">
        <?php if($studio->accept): ?>
            <button id="studio-btn" class="btn unsubs-btn" onclick="unsubscribe(<?= $studio->studio_id ?>)" data="<?= $studio->studio_id ?>">Unsubscribe</button>
        <?php elseif($studio->reject): ?>
            <button id="studio-btn" class="btn reject-btn" onclick="resubscribe(<?= $studio->studio_id ?>)" data="<?= $studio->studio_id ?>">Reject</button>
        <?php elseif($studio->pending): ?>
            <button id="studio-btn" class="btn pending-btn" data="<?= $studio->studio_id?>" disabled>Pending</button>
        <?php else: ?>
            <button id="studio-btn" class="btn subs-btn" onclick="subscribe(<?= $studio->studio_id ?>)" data="<?= $studio->studio_id ?>">Subscribe</button>
        <?php endif; ?>
    </div>
</div>