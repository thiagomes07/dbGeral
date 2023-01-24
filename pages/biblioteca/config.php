<?php

// Mysql:
define('MYSQL_DATA', 'id17899664_dbbancogeral');
define('MYSQL_USER', 'id17899664_user_2707');
define('MYSQL_PASS', '2G1=75d!i{o|un=%');

// Encriptação:
define('AES_KEY', 'an6sn3DEltIl1HbPLxrAP2PJ3gOutktr');
define('AES_IV', 'ibogN57QfRFwV8Dq');

function aes_encriptar($valor)
{
    return bin2hex(openssl_encrypt($valor, 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV));
}

function aes_desencriptar($hash)
{
    // Verifica se a hash é válida
    if(strlen($hash) % 2 != 0){
        return -1;
    }

    return openssl_decrypt(hex2bin($hash), 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV);
}