<?php

class Tokeniser {
	// basic
	const RE_ITEM = "#(\w+|[^\w\s]+)#";
	const RE_MARKUP = "#(<[^>]*>[^>]*>)#";
	const RE_SENTENCE_NAIVE = "#([.!?])#";
	const RE_SENTENCE = "#(\S.+?[.!?])(?=\s+|$)#";

	// regex use for treatment
	const RE_ITEM_AND_MARKUP = "#[\s^]*(<[^>]*>[^>]*>|\w+|[^\w\s]+)#";
	const RE_SENTENCE_PUNC = "#[\s^]+([.!?])\s+#";

	// regex use for correction
	const RE_ATTRIBUTE_PUNC = "#(\s+<.*?\.)\n(.*?\n)#";
	const RE_ACRONYMS = "#\s+(\w\s*\.\s*)+\w\s*\.?\s+#";
	const RE_NUMBERS = "#\s+\d+(\s*[,/.-]?\s*\d+)+(\s+|$)#";

    // @todo improve parser
	const LS_ABBR = ['al','art','ann','app','appt','apt','apr','av','ave','auj','bât','bd','blvd','cf','chap','Cie','dir','Doc','Dr','éd','eg','env','ex','&','fasc','fém','fig','fr','hab','ie','inf','Ing','loc','cit','masc','M','Me','Mgr','Mlle','Mlles','MM','Mme','Mmes','Mr','MM','min','ms','no','réf','p','pb','pl','pp','rv','sec','sect','sing','spec','suiv','sup','suppl','t','tél','v','vb','vol','vs'];
	//const RE_ABBR = "#(^|\s+)(\w|" . implode("|", self::LS_ABBR) . "\s+\.\s+#";

    public static function parse($string) {
        $string = preg_replace(self::RE_ITEM_AND_MARKUP, "$1\n", $string);
        $string = preg_replace(self::RE_SENTENCE_PUNC, "\n$1\n\n", $string);
        $string = preg_replace_callback(self::RE_ACRONYMS, function($match) {
            $string = preg_replace("#\s+#", "", $match[0]);
            return "\n$string\n";
        }, $string);
        $string = preg_replace_callback(self::RE_NUMBERS, function($match) {
            $string = preg_replace("#\s+#", "\n", $match[0]);
            return $string;
        }, $string);
        return $string;
    }
}