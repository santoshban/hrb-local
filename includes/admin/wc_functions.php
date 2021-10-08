<?php

// Copyright Year
function copyright_year(){
    $html = '';
        $html .= date('Y');
    return $html;
}
add_shortcode('year', 'copyright_year');