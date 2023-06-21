<?php
session_Start();
session_unset();
session_destroy();
echo "<script> location.href='index.php';</script>"

?>