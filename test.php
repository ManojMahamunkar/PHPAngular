<?php

 class  Foo
{
    public static $my_static = 'MANOJ';

    public function staticValue() {
        return self::$my_static="CANDICE";
    }
}

class Bar extends Foo
{
    public function fooStatic() {
        return parent::$my_static="VRINDA";
    }
}


$foo = new Foo();

print Foo::$my_static . "\n";

print $foo->staticValue() . "\n";

print Bar::$my_static . "\n";
/*
print Foo::$my_static . "\n";

$foo = new Foo();
print $foo->staticValue() . "\n";
print $foo->my_static . "\n";      // Undefined "Property" my_static 

print $foo::$my_static . "\n";
$classname = 'Foo';
print $classname::$my_static . "\n"; // As of PHP 5.3.0

print Bar::$my_static . "\n";
$bar = new Bar();
print $bar->fooStatic() . "\n";
*/
	
	
?>