<?php

class foo {
    private $test = 1;
}

function test() {
    return new foo;
}
<<__EntryPoint>> function main() {
test()->test = 2;
}
