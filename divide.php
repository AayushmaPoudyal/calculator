<?php

$div_result = null;
$div_error  = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['operation']) && $_POST['operation'] === 'divide') {

    $n1 = $_POST['num1'] ?? '';
    $n2 = $_POST['num2'] ?? '';

    if (!is_numeric($n1) || !is_numeric($n2)) {
        $div_error = "Please enter valid numbers.";
    } elseif (floatval($n2) == 0) {
        $div_error = "Cannot divide by zero!";
    } else {
        $div_result = floatval($n1) / floatval($n2);
    }
}

if (!defined('CALCULATOR_INCLUDED')):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Division — PHP Calculator</title>
    <?php include 'css.php'; ?>
</head>
<body>
    <div class="page-header">
        <a href="index.php" class="back-btn">&#8592; All Operations</a>
        <h1><span class="op-icon divide">&divide;</span> Division Calculator</h1>
    </div>
    <div class="single-wrap">
<?php endif; ?>

<div class="calc-card divide">
    <div class="card-top">
        <div class="op-icon divide">&divide;</div>
        <div>
            <h2>Division</h2>
            <p class="formula">num1 &divide; num2</p>
        </div>
    </div>

    <form method="POST" action="<?= defined('CALCULATOR_INCLUDED') ? 'index.php' : 'divide.php' ?>">
        <input type="hidden" name="operation" value="divide">

        <label>Dividend</label>
        <input type="number" name="num1" step="any" placeholder="e.g. 100"
               value="<?= (($_POST['operation'] ?? '') === 'divide') ? htmlspecialchars($_POST['num1'] ?? '') : '' ?>"
               required>

        <div class="op-divider"><span class="op-pill divide">&divide;</span></div>

        <label>Divisor (cannot be 0)</label>
        <input type="number" name="num2" step="any" placeholder="e.g. 4"
               value="<?= (($_POST['operation'] ?? '') === 'divide') ? htmlspecialchars($_POST['num2'] ?? '') : '' ?>"
               required>

        <button type="submit" class="btn divide">= Calculate</button>
    </form>

    <?php if ($div_error): ?>
        <div class="msg error">&#9888; <?= htmlspecialchars($div_error) ?></div>
    <?php elseif ($div_result !== null): ?>
        <div class="msg result divide">
            <span class="expr">
                <?= htmlspecialchars($_POST['num1']) ?> &divide; <?= htmlspecialchars($_POST['num2']) ?> =
            </span>
            <span class="answer"><?= htmlspecialchars((string)$div_result) ?></span>
        </div>
    <?php endif; ?>
</div>

<?php if (!defined('CALCULATOR_INCLUDED')): ?>
    </div>
    <div class="footer">PHP Calculator &copy; <?= date('Y') ?></div>
</body>
</html>
<?php endif; ?>