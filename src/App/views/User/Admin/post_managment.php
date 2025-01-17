<?php include $this->resolve("partials/_header.php"); ?>

<div>
    <h1>post management </h1>
    <?php foreach ($courseRequests as $requst) : ?>
        <h1> <?= e($requst["title"]) ?> </h1>
    <?php endforeach; ?>
</div>