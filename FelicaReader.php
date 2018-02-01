<?php

$result = `sudo felica_dump`;

preg_match('/006A:0000.*/', $result, $match);

$ID_ASCii = substr($match[0], 14, 16);

$ID = hex2bin($ID_ASCii);
?>