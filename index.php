<?php

require "Tokeniser.php";

$parsed = Tokeniser::parse("foo bar");

var_dump($parsed);