<?php
// ============================================================
//  add.php — Addition
//  Works standalone OR included by index.php
// ============================================================

$add_result = null;
$add_error  = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['operation']) && $_POST['operation'] === 'add') {

    $n1 = $_POST['num1'] ?? '';
    $n2 = $_POST['num2'] ?? '';

    if (!is_numeric($n1) || !is_numeric($n2)) {
        $add_error = "Please enter valid numbers.";
    } else {
        $add_result = floatval($n1) + floatval($n2);
    }
}

// ── Standalone page wrapper ──────────────────────────────────
if (!defined('CALCULATOR_INCLUDED')):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Addition — PHP Calculator</title>
    <?php include 'style.php'; ?>
</head>
<body>
    <div class="page-header">
        <a href="index.php" class="back-btn">&#8592; All Operations</a>
        <h1><span class="op-icon add">+</span> Addition Calculator</h1>
    </div>
    <div class="single-wrap">
<?php endif; ?>

<!-- ══ ADD CARD (shared between standalone & index) ══ -->
<div class="calc-card add">
    <div class="card-top">
        <div class="op-icon add">+</div>
        <div>
            <h2>Addition</h2>
            <p class="formula">num1 + num2</p>
        </div>
    </div>

    <form method="POST" action="<?= defined('CALCULATOR_INCLUDED') ? 'index.php' : 'add.php' ?>">
        <input type="hidden" name="operation" value="add">

        <label>First Number</label>
        <input type="number" name="num1" step="any" placeholder="e.g. 25"
               value="<?= (($_POST['operation'] ?? '') === 'add') ? htmlspecialchars($_POST['num1'] ?? '') : '' ?>"
               required>

        <div class="op-divider"><span class="op-pill add">+</span></div>

        <label>Second Number</label>
        <input type="number" name="num2" step="any" placeholder="e.g. 10"
               value="<?= (($_POST['operation'] ?? '') === 'add') ? htmlspecialchars($_POST['num2'] ?? '') : '' ?>"
               required>

        <button type="submit" class="btn add">= Calculate</button>
    </form>

    <?php if ($add_error): ?>
        <div class="msg error">&#9888; <?= htmlspecialchars($add_error) ?></div>
    <?php elseif ($add_result !== null): ?>
        <div class="msg result add">
            <span class="expr">
                <?= htmlspecialchars($_POST['num1']) ?> + <?= htmlspecialchars($_POST['num2']) ?> =
            </span>
            <span class="answer"><?= htmlspecialchars((string)$add_result) ?></span>
        </div>
    <?php endif; ?>
</div>

<?php if (!defined('CALCULATOR_INCLUDED')): ?>
    </div><!-- /.single-wrap -->
    <div class="footer">PHP Calculator &copy; <?= date('Y') ?></div>
</body>
</html>
<?php endif; ?> 
