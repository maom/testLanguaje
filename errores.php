<?php
$salida = shell_exec('tail -50 /var/log/httpd/languagefirst-err_log');
echo "<pre>$salida</pre>";
?>