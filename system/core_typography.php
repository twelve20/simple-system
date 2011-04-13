<?php
// core typography function can
// took it out to keep index file clean

function check_paragraph($string, $br = 1)
{ 
    $string = $string . "\n"; // just to make things a little easier, pad the end 
    $string = preg_replace('|<br />\s*<br />|', "\n\n", $string); 
    $string = preg_replace('!(<(?:table|ul|ol|li|pre|form|blockquote|h[1-6])[^>]*>)!', "\n$1", $string); // Space things out a little 
    $string = preg_replace('!(</(?:table|ul|ol|li|pre|form|blockquote|h[1-6])>)!', "$1\n", $string); // Space things out a little 
    $string = preg_replace("/(\r\n|\r)/", "\n", $string); // cross-platform newlines 
    $string = preg_replace("/\n\n+/", "\n\n", $string); // take care of duplicates 
    $string = preg_replace('/\n?(.+?)(?:\n\s*\n|\z)/s', "\t<p>$1</p>\n", $string); // make paragraphs, including one at the end 
    $string = preg_replace('|<p>\s*?</p>|', '', $string); // under certain strange conditions it could create a P of entirely whitespace 
    $string = preg_replace("|<p>(<li.+?)</p>|", "$1", $string); // problem with nested lists 
    $string = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $string); 
    $string = str_replace('</blockquote></p>', '</p></blockquote>', $string); 
    $string = preg_replace('!<p>\s*(</?(?:table|tr|td|th|div|ul|ol|li|pre|select|form|blockquote|p|h[1-6])[^>]*>)!', "$1", $string); 
    $string = preg_replace('!(</?(?:table|tr|td|th|div|ul|ol|li|pre|select|form|blockquote|p|h[1-6])[^>]*>)\s*</p>!', "$1", $string); 
    if ($br) $string = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $string); // optionally make line breaks 
    $string = preg_replace('!(</?(?:table|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|blockquote|p|h[1-6])[^>]*>)\s*<br />!', "$1", $string); 
    $string = preg_replace('!<br />(\s*</?(?:p|li|div|th|pre|td|ul|ol)>)!', '$1', $string); 
    $string = preg_replace('/&([^#])(?![a-z]{1,8};)/', '&$1', $string); 
    return $string;
}

?>