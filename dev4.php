<?php
// ============================================================
//  subtract.php — Subtraction
//  Works standalone OR included by index.php
// ============================================================

$sub_result = null;
$sub_error  = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['operation']) && $_POST['operation'] === 'subtract') {

    $n1 = $_POST['num1'] ?? '';
    $n2 = $_POST['num2'] ?? '';

    if (!is_numeric($n1) || !is_numeric($n2)) {
        $sub_error = "Please enter valid numbers.";
    } else {
        $sub_result = floatval($n1) - floatval($n2);
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
    <title>Subtraction — PHP Calculator</title>
    <?php include 'style.php'; ?>
</head>
<body>
    <div class="page-header">
        <a href="index.php" class="back-btn">&#8592; All Operations</a>
        <h1><span class="op-icon subtract">&#8722;</span> Subtraction Calculator</h1>
    </div>
    <div class="single-wrap">
<?php endif; ?>

<!-- ══ SUBTRACT CARD (shared between standalone & index) ══ -->
<div class="calc-card subtract">
    <div class="card-top">
        <div class="op-icon subtract">&#8722;</div>
        <div>
            <h2>Subtraction</h2>
            <p class="formula">num1 &minus; num2</p>
        </div>
    </div>

    <form method="POST" action="<?= defined('CALCULATOR_INCLUDED') ? 'index.php' : 'subtract.php' ?>">
        <input type="hidden" name="operation" value="subtract">

        <label>First Number</label>
        <input type="number" name="num1" step="any" placeholder="e.g. 50"
               value="<?= (($_POST['operation'] ?? '') === 'subtract') ? htmlspecialchars($_POST['num1'] ?? '') : '' ?>"
               required>

        <div class="op-divider"><span class="op-pill subtract">&#8722;</span></div>

        <label>Second Number</label>
        <input type="number" name="num2" step="any" placeholder="e.g. 15"
               value="<?= (($_POST['operation'] ?? '') === 'subtract') ? htmlspecialchars($_POST['num2'] ?? '') : '' ?>"
               required>

        <button type="submit" class="btn subtract">= Calculate</button>
    </form>

    <?php if ($sub_error): ?>
        <div class="msg error">&#9888; <?= htmlspecialchars($sub_error) ?></div>
    <?php elseif ($sub_result !== null): ?>
        <div class="msg result subtract">
            <span class="expr">
                <?= htmlspecialchars($_POST['num1']) ?> &minus; <?= htmlspecialchars($_POST['num2']) ?> =
            </span>
            <span class="answer"><?= htmlspecialchars((string)$sub_result) ?></span>
        </div>
    <?php endif; ?>
</div>

<?php if (!defined('CALCULATOR_INCLUDED')): ?>
    </div><!-- /.single-wrap -->
    <div class="footer">PHP Calculator &copy; <?= date('Y') ?></div>
</body>
</html>
<?php endif; ?> 
