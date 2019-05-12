<?php

class Foo {
    protected static $className = 'Foo';
    public static function bar() {
        echo static::$className . "::bar\n";
    }
    public function __construct() {
        echo static::$className . "::__construct\n";
    }
}

class FooChild extends Foo {
    protected static $className = 'FooChild';
}
<<__EntryPoint>> function main() {
register_shutdown_function(array('Foo', 'bar'));
register_shutdown_function(array('FooChild', 'bar'));

$foo = new Foo();
$fooChild = new FooChild();
unset($foo);
unset($fooChild);
}
