<?php

abstract class fail {
    abstract function show();
}

class pass extends fail {
    function show() {
        echo "Call to function show()\n";
    }
}
<<__EntryPoint>> function main() {
$t2 = new pass();
$t2->show();

$t = new fail();
$t->show();

echo "Done\n"; // shouldn't be displayed
}
