<?php
namespace App\Models;
//class Manager
class Manager
{
    protected $salt = 'security&salt#it';

    protected function dbConnect()
    {

        $bdd = new \PDO('mysql:host=sql.chaffy.net;dbname=w1vy57_manon5', 'w1vy57_manon5', '#MchP#88&Mgm#');
        return $bdd;
        }
    }
