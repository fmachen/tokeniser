<?php

require "Tokeniser.php";

$string = "foo <i>bar </i>buzz S.N.C.F..";

$parsed = Tokeniser::parse($string);

echo "<xmp>$string</xmp>";
echo "<hr>";
echo "<xmp>$parsed</xmp>";