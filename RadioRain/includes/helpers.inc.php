<?php

function html($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function htmlout($text) {
    echo html($text);
}

function markdown2html($text) {
    $text = html($text);

    //enfasi forte

    $text = preg_replace('/__(.+?)__/s', '<strong>$1</strong>', $text);
    $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);

    //enfasi


    $text = preg_replace('/_([^_]+)_/', '<em>$1</em>', $text);
    $text = preg_replace('/\*([^\*]+)\*/', '<em>$1</em>', $text);

    //Converte la scrittura Windows (\r\n) in quella Unix(\n)
    $text = str_replace("\r\n", "\n", $text);
    //Converte la scrittura Macintosh (\r) in quella Unix (\n)
    $text = str_replace("\r", "\n", $text);

    //Paragrafi
    $text = '<p>' . str_replace("\n\n", '<p></p>', $text) . '</p>';
    //interruzione di riga
    $text = str_replace("\n", '<br>', $text);

    //[testo collegato](URL del collegamento)
    $text = preg_replace('/\[([^\]]+)]\(([-a-z0-9._~:\/?#@!$&\'()*+,;=%]+)\)/i', '<a href="$2"> $1</a>', $text);

    return $text;
}



function markdownout($text) {
    echo markdown2html($text);
}
?>

