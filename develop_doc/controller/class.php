<?php

if (!empty($_GET['d'])) {
    $files = my_scandir(SYSTEM_CLASS_DIR . '/' . $_GET['d']);
} else {
    $files = my_scandir(SYSTEM_CLASS_DIR);
}
