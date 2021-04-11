<?php

/*Conexion PDO con BD*/
class Conexion{
    static public function conectar(){
        $link = new PDO("mysql:host=localhost;dbname=miscelanea",
                        "root",
                        "");
        $link->exec("set names utf8");

        return $link;
    }
}