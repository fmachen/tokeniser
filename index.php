<?php

require "Tokeniser.php";

$string = "Toto Tata. Foo <i>bar </i>buzz S.N.C.F.. 01-23-45-67-89.";

$parsed = Tokeniser::parse($string);

echo "<xmp>$string</xmp>";
echo "<hr>";
echo "<xmp>$parsed</xmp>";