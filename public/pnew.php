<?php

function wingoFromHash($hash){
    $last = substr($hash, -1);
    $number = hexdec($last) % 10;
    $size = ($number >= 5) ? "B" : "S";
    if($number == 0 || $number == 5){
        $color = "Violet";
    } elseif($number % 2 == 0){
        $color = "Red";
    } else {
        $color = "Green";
    }
    return [
        'number'=>$number,
        'size'=>$size,
        'color'=>$color
    ];
}

// --- USER INPUT BLOCK HEIGHT ---
$userBlock = isset($_POST['block']) ? intval($_POST['block']) : 80893466;

// Calculate user block hash
$userResult = null;
$userHash = null;
$userLast4 = null;

if($userBlock){
    $prevHash = hash('sha256', strval($userBlock-1));
    $userHash = hash('sha256', $prevHash.strval($userBlock));
    $userLast4 = substr($userHash,-4);
    $userResult = wingoFromHash($userHash);
}

// --- Generate 10 blocks with +20 difference in descending order ---
$blocks = [];
$increment = 20;

for($i = 9; $i >= 0; $i--){
    $blockNum = $userBlock + ($i * $increment); // +20 difference
    $prevHash = hash('sha256', strval($blockNum-1));
    $hash = hash('sha256', $prevHash.strval($blockNum));
    $result = wingoFromHash($hash);
    $blocks[] = [
        'height'=>$blockNum,
        'hash'=>$hash,
        'last4'=>substr($hash,-4),
        'number'=>$result['number'],
        'size'=>$result['size'],
        'color'=>$result['color']
    ];
}

?>

<!DOCTYPE html>
<html>
<head>
<title>TRX Wingo Predictor</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col items-center">

<h1 class="text-3xl font-bold mt-10 mb-6">TRX Wingo Predictor</h1>

<div class="w-full max-w-4xl p-6 bg-gray-800 rounded-xl shadow-lg mb-6">
<form method="POST" class="flex gap-3">
<input type="number" name="block" value="<?php echo $userBlock; ?>" class="flex-1 p-3 rounded bg-gray-700 outline-none" required>
<button class="bg-blue-600 px-6 py-3 rounded hover:bg-blue-700">Check Block</button>
</form>
</div>

<?php if($userResult): ?>
<div class="w-full max-w-4xl p-6 bg-gray-800 rounded-xl shadow-lg mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
<div>
<p class="mb-2"><b>Block Height:</b> <?php echo $userBlock; ?></p>
<p class="mb-2"><b>Number:</b> <?php echo $userResult['number']; ?></p>
<p class="mb-2"><b>Result:</b> <?php echo $userResult['size']; ?></p>
<p class="text-lg font-bold">
Color:
<span class="<?php
echo $userResult['color']=="Red"?"text-red-500":($userResult['color']=="Green"?"text-green-500":"text-purple-500");
?>">
<?php echo $userResult['color']; ?>
</span>
</p>
</div>
<div>
<p class="mb-2"><b>Hash Value:</b></p>
<div class="text-center font-bold text-xl px-4 py-2 rounded
<?php
echo $userResult['color']=="Red"?"bg-red-600":($userResult['color']=="Green"?"bg-green-600":"bg-purple-600");
?>">
<?php echo $userLast4; ?>
</div>
</div>
</div>
<?php endif; ?>

<div class="w-full max-w-4xl p-6 bg-gray-800 rounded-xl shadow-lg mb-10">
<h2 class="text-xl font-bold mb-4">Latest 10 Blocks</h2>
<table class="w-full text-center border border-gray-700">
<thead class="bg-gray-700">
<tr>
<th class="p-2">Block Height</th>
<th>Hash Value</th>
<th>Number</th>
<th>Result</th>
<th>Color</th>
</tr>
</thead>
<tbody>
<?php foreach($blocks as $b): ?>
<tr class="border-t border-gray-700">
<td class="p-2"><?php echo $b['height']; ?></td>
<td>
<div class="mx-auto font-bold px-3 py-1 rounded
<?php
echo $b['color']=="Red"?"bg-red-600":($b['color']=="Green"?"bg-green-600":"bg-purple-600");
?>">
<?php echo $b['last4']; ?>
</div>
</td>
<td><?php echo $b['number']; ?></td>
<td class="<?php
echo $b['color']=="Red"?"text-red-500":($b['color']=="Green"?"text-green-500":"text-purple-500");
?>"><?php echo $b['size']; ?></td>
<td class="<?php
echo $b['color']=="Red"?"text-red-500":($b['color']=="Green"?"text-green-500":"text-purple-500");
?>"><?php echo $b['color']; ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

</body>
</html>