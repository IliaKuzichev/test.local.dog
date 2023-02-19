<?php

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