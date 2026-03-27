<?php
// ============================================================
//  multiplication.php — Multiplication
//  Works standalone OR included by index.php
// ============================================================

$mul_result = null;
$mul_error  = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['operation']) && $_POST['operation'] === 'multiply') {

    $n1 = $_POST['num1'] ?? '';
    $n2 = $_POST['num2'] ?? '';

    if (!is_numeric($n1) || !is_numeric($n2)) {
        $mul_error = "Please enter valid numbers.";
    } else {
        $mul_result = floatval($n1) * floatval($n2);
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
    <title>Multiplication — PHP Calculator</title>
    <?php include 'style.php'; ?>
</head>
<body>
    <div class="page-header">
        <a href="index.php" class="back-btn">&#8592; All Operations</a>
        <h1><span class="op-icon multiply">&times;</span> Multiplication Calculator</h1>
    </div>
    <div class="single-wrap">
<?php endif; ?>

<!-- ══ MULTIPLY CARD (shared between standalone & index) ══ -->
<div class="calc-card multiply">
    <div class="card-top">
        <div class="op-icon multiply">&times;</div>
        <div>
            <h2>Multiplication</h2>
            <p class="formula">num1 &times; num2</p>
        </div>
    </div>

    <form method="POST" action="<?= defined('CALCULATOR_INCLUDED') ? 'index.php' : 'multiplication.php' ?>">
        <input type="hidden" name="operation" value="multiply">

        <label>First Number</label>
        <input type="number" name="num1" step="any" placeholder="e.g. 12"
               value="<?= (($_POST['operation'] ?? '') === 'multiply') ? htmlspecialchars($_POST['num1'] ?? '') : '' ?>"
               required>

        <div class="op-divider"><span class="op-pill multiply">&times;</span></div>

        <label>Second Number</label>
        <input type="number" name="num2" step="any" placeholder="e.g. 8"
               value="<?= (($_POST['operation'] ?? '') === 'multiply') ? htmlspecialchars($_POST['num2'] ?? '') : '' ?>"
               required>

        <button type="submit" class="btn multiply">= Calculate</button>
    </form>

    <?php if ($mul_error): ?>
        <div class="msg error">&#9888; <?= htmlspecialchars($mul_error) ?></div>
    <?php elseif ($mul_result !== null): ?>
        <div class="msg result multiply">
            <span class="expr">
                <?= htmlspecialchars($_POST['num1']) ?> &times; <?= htmlspecialchars($_POST['num2']) ?> =
            </span>
            <span class="answer"><?= htmlspecialchars((string)$mul_result) ?></span>
        </div>
    <?php endif; ?>
</div>

<?php if (!defined('CALCULATOR_INCLUDED')): ?>
    </div><!-- /.single-wrap -->
    <div class="footer">PHP Calculator &copy; <?= date('Y') ?></div>
</body>
</html>
<?php endif; ?> 
