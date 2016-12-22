<?php
function rsrc_process_css($body)
{
    // Remove comments
    $body = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $body);

    // Remove tabs, spaces and newlines
    $body = str_replace(["\r\n", "\r", "\n", "\t", '  ', '    ', '    '], '', $body);

    // Handle spaces between element declarations
    $body = str_replace([' {', '{ ', ' { '],       '{', $body);
    $body = str_replace([' }', '} ', ' } ', ';}'], '}', $body);

    // Handle colons and semi-colons
    $body = str_replace(': ', ':', $body);
    $body = str_replace('; ', ';', $body);

    // Return the body
    return $body;
  }