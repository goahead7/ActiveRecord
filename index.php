<?php

$dsn = 'mysql:dbname=db;host=localhost';
$user = 'sophia';
$password = '1111';

$dbh = new PDO($dsn, $user, $password);

class bag
{
    private $id;
    private $manufacturer;
    private $model;

    public function __construct($id, $manufacturer, $model)
    {
        $this->id = $id;
        $this->manufacturer = $manufacturer;
        $this->model = $model;

    }

    public function getByID($id, $dbh) : bag
    {
        $get = $dbh->prepare("SELECT * FROM Bag WHERE id = $id");
        $get -> execute();
        $data = $get->fetch(\PDO::FETCH_ASSOC);
        return new bag ($data['id'], $data['manufacturer'], $data['model']);
    }

    public function getByModel($model,$dbh) : array
    {
        $get = $dbh->prepare("SELECT * FROM Bag WHERE model = $model");
        $get -> execute();
        $data = $get->fetchAll();
        return $data;
    }

    public function save($dbh) {

        $save = $dbh->prepare("INSERT INTO Bag (id, manufacturer, model) VALUE (?, ?, ?)");
        $save->execute(array($this->id, $this->manufacturer, $this->model));
    }

    public function remove($dbh) {

        $del = $dbh->prepare("DELETE FROM Bag where id = ?, manufacturer = ?, model = ?");
        $del->execute(array($this->id, $this->manufacturer, $this->model));

    }

    public function all($dbh) : array
    {
        $data = $dbh->prepare("SELECT * FROM Bag");
        $data->execute();
        $res = $data->fetchAll();
        return $res;
    }

}