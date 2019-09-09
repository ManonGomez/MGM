<?php
namespace App\Models;

use App\ConfigApp;

//class Manager
class Manager
{
    protected $salt = 'security&salt#it';

    protected function dbConnect()
    {
        $configApp = new ConfigApp();
        $confDatabse = $configApp->get('database');
        $bdd = new \PDO('mysql:host=' . $confDatabse['host'] . ';dbname=' . $confDatabse['dbName'], $confDatabse['user'], $confDatabse['password']);
        return $bdd;
    }
}