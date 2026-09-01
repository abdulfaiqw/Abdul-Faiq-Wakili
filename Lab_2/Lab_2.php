// task1:

<?php

class Library {
    const MAX_BOOKS = 3;
}

echo "Maximum books allowed: " . Library::MAX_BOOKS;



// task2:



class StudentCounter {
    public static $count = 0;

    public static function addStudent() {
        self::$count++;
    }
}

StudentCounter::addStudent();
StudentCounter::addStudent();
StudentCounter::addStudent();

echo "Total students: " . StudentCounter::$count;



// task3:



abstract class Vehicle {
    abstract public function start();
}

class Car extends Vehicle {
    public function start() {
        echo "Car engine started";
    }
}

class Bike extends Vehicle {
    public function start() {
        echo "Bike started";
    }
}

$car = new Car();
$bike = new Bike();

$car->start();
echo "\n";
$bike->start();

?>
