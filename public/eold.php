<?php
// ----------------------------
// Code Generator with Exact Mapping
// ----------------------------

$startBlock =isset($_GET['block']) ? (int)$_GET['block'] : 80822800;
$totalBlocks = 10;
$step = 20;



// Generate mapping dynamically for remaining blocks
$blocksArray = [];
for ($i = 0; $i < $totalBlocks; $i++) {
    $block = $startBlock - ($i * $step);
    $blocksArray[] = $block;
    if(!isset($mapping[$block])){
        $mapping[$block] = ''; // fallback placeholder
    }
}

// Fantasy Gems code logic with mapping
function fantasyGemsCode($blockHeight, $mapping) {
    if(isset($mapping[$blockHeight]) && $mapping[$blockHeight] !== ''){
        return strtolower($mapping[$blockHeight]);
    }
    $hash = hash('sha256', strval($blockHeight));
    $hash = hash('sha256', "data".$hash);
    $last4 = substr($hash, -4);
    return $hash;//strtolower(substr($last4,0,2) . strrev(substr($last4,2,2)));
}

// Big / Small calculation
function resultBS($code){
    $value = hexdec(substr($code, -1));
    return $value >= 8 ? "B" : "S";
}

// Handle form input
$inputBlock = "";
$inputCode = "";
$inputBS = "";

if(isset($_POST['block']) && is_numeric($_POST['block'])){
    $inputBlock = $_POST['block'];
    $inputCode = fantasyGemsCode($inputBlock, $mapping);
    $inputBS = resultBS($inputCode);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Hash Generator</title>
<meta http-equiv="refresh" content="60">
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
<div class="max-w-6xl mx-auto">
<h1 class="text-3xl font-bold mb-6 text-center text-blue-600">Hash Generator</h1>
<!-- Block input form -->
<div class="bg-white shadow-xl rounded-2xl p-6 mb-6">
<form method="post" class="flex flex-col gap-4">
<input type="text"
       name="block"
       placeholder="Enter block height"
       value="<?= htmlspecialchars($inputBlock) ?>"
       class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
       required>
<button type="submit"
        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition">
Generate Code
</button>
</form>

<?php if($inputCode): ?>
<div class="mt-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
<p><span class="font-semibold">Block Height:</span> <?= $inputBlock ?></p>
<p><span class="font-semibold">Hash Value:</span> <?= $inputCode ?></p>
<p><span class="font-semibold">Result:</span> <span class="<?= $inputBS === 'B' ? 'text-blue-600' : 'text-red-600' ?> font-bold"><?= $inputBS ?></span></p>
</div>
<?php endif; ?>
</div>
</div>
</body>
</html>