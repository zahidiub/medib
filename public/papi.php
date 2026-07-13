<?php
$resultData = null;

if(isset($_POST['block'])){

$block = intval($_POST['block']);

$url = "https://api.trongrid.io/wallet/getblockbynum";

$data = json_encode([
    "num" => $block
]);

$options = [
'http'=>[
'method'=>"POST",
'header'=>"Content-Type: application/json",
'content'=>$data
]
];

$context = stream_context_create($options);
$response = file_get_contents($url,false,$context);
$json = json_decode($response,true);

if(isset($json['blockID']))
{

$hash = $json['blockID'];

$hash4 = substr($hash,-4);

$last = substr($hash4,-1);

$number = hexdec($last) % 10;

$type = ($number >=5) ? "B" : "S";

$resultData = [
"block"=>$block,
"hash"=>$hash4,
"number"=>$number,
"type"=>$type
];
// Decide background color
$bgColor = match($lastDigit) {
    0 => "bg-blue-500",
    1,2,3 => "bg-green-500",
    4,5,6 => "bg-yellow-500",
    7,8,9 => "bg-red-500",
    default => "bg-gray-500"
};
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Prediction Tool</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
<div class="max-w-2xl mx-auto mt-16">
<h1 class="text-3xl font-bold text-center mb-8">

</h1>
<div class="bg-gray-800 p-6 rounded-lg">
<form method="POST">
<input type="number" name="block"  value="80888768" class="w-full p-3 rounded text-black mb-4" required>
<button
class="w-full bg-green-500 p-3 rounded font-bold">Predict</button>
</form>
</div>
<?php if($resultData){ ?>
<div class="bg-gray-800 mt-6 p-6 rounded">
<h2 class="text-xl mb-4 font-bold">Prediction Result</h2>
<table class="w-full text-center">
<tr class="border-b border-gray-600">
<th>Block Height</th>
<th>Hash Value</th>
<th>Result</th>
</tr>
<tr class="text-lg">
<td><?php echo $resultData['block']; ?></td>
<td><?php echo $resultData['hash']; ?></td>
<td class="<?php echo ($resultData['type']=="Big") ? 'text-green-400':'text-blue-400'; ?>">
<span class="text-lg <?php echo $bgColor; ?> text-white"><?php echo $resultData['number']; ?></span>  <?php echo $resultData['type']; ?>
</td>
</tr>
</table>
</div>
<?php } ?>
</div>
</body>
</html>