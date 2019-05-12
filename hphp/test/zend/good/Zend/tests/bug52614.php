<?php
class foo {
    public $a1;
    public $a2 = array();
    public $a3;
    public $o1;
    public $o2;

    public function f1() {
        return $this->a1;
    }

    public function f2() {
        return $this->a2;
    }

    public function f3() {
        $this->a3 = array();
        return $this->a3;
    }

    public function f4() {
        return $this->o1;
    }

    public function f5() {
        $this->o2 = new stdClass;
        return $this->o2;
    }

    public function f7(&$x) {
        $x[0] = 2;
    }

}
<<__EntryPoint>> function main() {
$foo = new foo;

$foo->f2()[0] = 1;
var_dump($foo->a2);

$foo->f3()[0] = 1;
var_dump($foo->a3);

$foo->f4()->a = 1;
var_dump($foo->o1);

$foo->f5()->a = 1;
var_dump($foo->o2);

$foo->a1 = [1];
$foo->f7(&$foo->a1);
var_dump($foo->a1[0]);
$foo->f1()[0]++;
var_dump($foo->a1[0]);
$foo->a1[0]++;
var_dump($foo->a1[0]);
}
