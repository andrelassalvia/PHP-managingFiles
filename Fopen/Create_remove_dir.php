<?php

// The folder exist? If don't, let's create it.

$name = 'images';

if(!is_dir($name)){ // if there is no dir $name
    mkdir($name); // create it
    echo 'Diretorio $name criado com sucesso';
} else{
    rmdir($name); // remove it
    echo 'Diretorio ja existe!';
}
