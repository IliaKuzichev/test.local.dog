<?php

try{
    $pdo = new PDO("mysql:host=test.local;", "root", "");
    // Установите режим ошибки PDO в исключение
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("Ошибка подключения. " . $e->getMessage());
}

// Создание базы данных с именем demo
try{
    $sql = "CREATE DATABASE demo";
    $pdo->exec($sql);
    echo "База данных успешно создана";
} catch(PDOException $e){
    die("Ошибка создания базы данных $sql. " . $e->getMessage());
}

// закрываем соединение
unset($pdo);

/* Попытка подключения к серверу MySQL. Предполагая, что вы используете MySQL сервер с настройкой по умолчанию (пользователь root без пароля) */
try{
    $pdo = new PDO("mysql:host=test.local;dbname=demo", "root", "");
    // Установите режим ошибки PDO в исключение
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Нет подключения. " . $e->getMessage());
}

// Попытка выполнить запрос на создание таблицы
try{
    $sql = "CREATE TABLE persons(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        first_name VARCHAR(30) NOT NULL,
        last_name VARCHAR(30) NOT NULL,
        email VARCHAR(70) NOT NULL UNIQUE
    )";
    $pdo->exec($sql);
    echo "Таблица успешно создана.";
} catch(PDOException $e){
    die("ERROR: Не удалось выполнить $sql. " . $e->getMessage());
}

// Закрыть соединение
unset($pdo);

/* Попытка подключения к серверу MySQL. Предполагая, что вы используете MySQL сервер с настройкой по умолчанию (пользователь root без пароля)  */
try{
    $pdo = new PDO("mysql:host=test.local;dbname=demo", "root", "");
    // Установите режим ошибки PDO в исключение
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Ошибка подключения. " . $e->getMessage());
}

// Попытка выполнения запроса вставки
try{
    $sql = "INSERT INTO persons (first_name, last_name, email) VALUES
            ('John', 'Rambo', 'johnrambo@mail.com'),
            ('Clark', 'Kent', 'clarkkent@mail.com'),
            ('John', 'Carter', 'johncarter@mail.com'),
            ('Harry', 'Potter', 'harrypotter@mail.com')";
    $pdo->exec($sql);
    echo "Записи успешно вставлены.";
} catch(PDOException $e){
    die("ERROR: Не удалось выполнить $sql. " . $e->getMessage());
}

// Закрыть соединение
unset($pdo);
class UnknownBreedException extends Exception {}
class UnknownActionException extends Exception {}
class UnableToHuntException extends UnknownActionException {}
class UnableToMakeSoundException extends UnknownActionException {}

interface DogInterface{
    public function hunt(): void;
}

abstract class Dog {

    public string $name = "dog";

    protected string $color = 'black';

    private int $size = 5;

    static public int $count_legs = 4;

    public function showCharacteristic(): void
    {
        echo "My name is {$this->name}, my color is {$this->color}, my size is {$this->size}";
    }

    public function sound(): void
    {
        echo "woof, woof. ";
    }
    public function hunt(): void
    {
        throw new Exception("Not implemented?");
    }
}

class Mops extends Dog implements DogInterface{

    public string $name;

    protected string $color;

    protected int $size;
    public function __construct()
    {
        $this->color = 'yellow';
        $this->name = 'Mops';
        $this->size = 500;
    }



    public function hunt(): void
    {
        throw new UnableToHuntException("I'm your sofa guard, maaaan");
    }
}
class ShibuInu extends Dog implements DogInterface{

    public string $name = 'ShibuInu';

    public function hunt(): void
    {
        echo "I'm hunting for your new boots, mate!\n";
    }
}

class Dachshund extends Dog implements DogInterface{

    public function hunt(): void
    {
        echo "Looking for a rabbit in the deep-deep hole!";
    }
}
class PlushLabr extends Dog implements DogInterface{

    public function sound(): void
    {
        throw new UnableToMakeSoundException("I'm just a toy, GTFO.");
    }
    public function hunt(): void
    {
        throw new UnableToHuntException("I'm still just a toy, GTFO.");
    }
}
class RubberDachshund extends Dog implements DogInterface{

    public function sound(): void
    {
        echo "peep, peep";
    }
    public function hunt(): void
    {
        throw new UnableToHuntException("I'm qute useful for your bath, not the hunting adventure");
    }
}
//Dog factory pattern
function dog_fabric(string $breed): Dog
{
    switch ($breed) {
        case "shibu-inu":
            return new ShibuInu();
        case "mops":
            return new Mops();
        case "dachshund":
            return new Dachshund();
        case "plush-labr":
            return new PlushLabr();
        case "rubber-dachshund":
            return new RubberDachshund();
        default:
            throw new UnknownBreedException("Unknown breed `".$breed."`");
    }
}
/*
var_dump($_POST);
var_dump($_REQUEST);
die();
*/
if (!$_POST){
    return;
}
$argv = explode(" ", $_POST['message']);

Dog::$count_legs;

$dog = $argv[0];
$action = $argv[1];

    try {
    $dog = dog_fabric($dog);
    switch ($action) {
        case 'sound':
            $dog->sound();
            break;
        case 'hunt':
            $dog->hunt();
            break;
        default:
            throw new UnknownActionException("unknown action ".$action);
    }
    $dog->showCharacteristic();
} catch (UnknownBreedException $e) {
    echo "Failed to determine the breed of the dog: ".$e->getMessage()."\n";
    die();
} catch(Exception $e) {
    echo "".$e->getMessage()."\n";
    die();
}


?>