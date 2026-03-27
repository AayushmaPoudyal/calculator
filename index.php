<?php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
    <?php include 'css.php'; ?>
</head>
<body>

    <div class="index-title">
        <div class="logo">&#x1F9EE;</div>
        <h1>PHP Calculator</h1>
        <p>Four operations &mdash; each in its own file, bound together here</p>
    </div>

    <div class="index-wrap">
        <?php include 'add.php'; ?>
        <?php include 'subtract.php'; ?>
        <?php include 'multiplication.php'; ?>
        <?php include 'divide.php'; ?>
    </div>

    <div class="footer">PHP Calculator &copy; <?= date('Y') ?> &mdash; index.php &rarr; add.php + subtract.php + multiplication.php + divide.php</div>

</body>
</html>