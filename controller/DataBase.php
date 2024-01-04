<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/model/DataBase.php');
class DataBaseController
{
    public function connect()
    {
        $dbModel = new DataBaseModel();
        return $dbModel->connect();
    }
    public function disconnect($connection)
    {
        $dbModel = new DataBaseModel();
        $dbModel->disconnect($connection);

    }

    public function request($db, $query)
    {
        $dbModel = new DataBaseModel();
        return $dbModel->request($db, $query);
    }
}