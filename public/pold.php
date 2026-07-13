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
// print_r($json);

if(isset($json['blockID']))
{

$finalHash = fantasyGemsCode($block);

$hash = $json['blockID'];

$hash4 = substr($hash,-4);

$last = substr($hash4,-1);

$number = hexdec($last) % 10;

$type = ($number >=5) ? "Big" : "Small";

$resultData = [
"block"=>$block,
"hash"=>$hash,
"hash_new"=>$finalHash,
"number"=>$number,
"type"=>$type
];

}
}

function fantasyGemsCode($blockHeight) {


    $block_number = $block;

    $salt = "TRX_WINGO_SERVER";

    $prefix = str_pad(dechex($blockHeight), 16, "0", STR_PAD_LEFT);

    //$data = $salt.$block_number.$salt;
    //$data = $salt.$block_number;
    $data = $blockHeight.$salt;
    // $data = $salt.":".$block_number;
    // $data = $block_number.":".$salt;
    // $data = $prefix.":".$block_number.":".$salt;
    // $data = $prefix.$block_number.$salt;

    $hash4 = hash('sha256', $data,true);
    $hash4 = hash('sha256', $hash4);

   return $finalHash = $prefix.substr($hash4, 16);
    
    // $hash = hash('sha256', strval($blockHeight));
    // $hash = hash('sha256', "data".$hash);
    // $last4 = substr($hash, -4);
    // return $hash;//strtolower(substr($last4,0,2) . strrev(substr($last4,2,2)));
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
<input type="number" name="block" value="80881557" placeholder="80881557" class="w-full p-3 rounded text-black mb-4" required>
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
<th>Hash Drived</th>
<th>Number</th>
<th>Result</th>
</tr>
<tr class="text-lg">
<td><?php echo $resultData['block']; ?></td>
<td><?php echo $resultData['hash']; ?></td>
<td><?php echo $resultData['number']; ?></td>
<td class="<?php echo ($resultData['type']=="Big") ? 'text-green-400':'text-blue-400'; ?>">
<?php echo $resultData['type']; ?>
</td>
</tr>
<tr class="text-lg">
<td></td>
<td><br><?php echo $resultData['hash_new']; ?></td>
<td></td>
<td class="<?php echo ($resultData['type']=="Big") ? 'text-green-400':'text-blue-400'; ?>">

</td>
</tr>
</table>
</div>
<?php } ?>
</div>
</body>
</html>