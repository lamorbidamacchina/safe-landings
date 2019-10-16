<?php 
// Generating your encryption key
$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
echo "Your private key...<br />";
echo base64_encode($key);
echo "<br /><br />";
// Generating your blind index key
$key = random_bytes(SODIUM_CRYPTO_PWHASH_SALTBYTES);
echo "Your blind index key...<br />";
echo base64_encode($key);

echo "<br /><br />Place your key and blind index key in /includes/config.php, save and upload it.<br />You just need to run this script once.<br />Goodbye :)";
?>