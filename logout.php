<?php
// logout

setcookie('team', null, -1);
setcookie('hash', null, -1);
setcookie('region', null, -1);

echo "<script>window.location = './index.php';</script>";

?>