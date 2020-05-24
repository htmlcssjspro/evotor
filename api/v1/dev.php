<?php

function pr($exp, ?string $name = '')
{
    echo '<br><pre>';
    if ($name) {
        echo "<strong>### $name: ###</strong><br>";
    }
    print_r($exp);
    echo '</pre><br>';
}
