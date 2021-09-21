<?php

$file = fopen('test.txt', 'w+'); // Create a file
echo 'File created'.'<br>';
fclose($file);

unlink('test.txt'); // Delete a file
echo 'File deleted';