<?hh // strict

let identical = ($x) ==> {
  let y = $x;
  return y;
};
var_dump(identical(42));
