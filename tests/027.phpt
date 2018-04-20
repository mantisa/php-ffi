--TEST--
FFI 027: Incomplete and variable length arrays
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
try {
	$p = FFI::new("int[*]");
	echo "ok\n";
} catch (Throwable $e) {
	echo get_class($e) . ": " . $e->getMessage()."\n";
}
try {
	new FFI("static int (*foo)[*];");
	echo "ok\n";
} catch (Throwable $e) {
	echo get_class($e) . ": " . $e->getMessage()."\n";
}
try {
	new FFI("typedef int foo[*];");
	echo "ok\n";
} catch (Throwable $e) {
	echo get_class($e) . ": " . $e->getMessage()."\n";
}
try {
	new FFI("static void foo(int[*][*]);");
	echo "ok\n";
} catch (Throwable $e) {
	echo get_class($e) . ": " . $e->getMessage()."\n";
}
try {
	var_dump(FFI::sizeof(FFI::new("int[0]")));
} catch (Throwable $e) {
	echo get_class($e) . ": " . $e->getMessage()."\n";
}
try {
	var_dump(FFI::sizeof(FFI::new("int[]")));
} catch (Throwable $e) {
	echo get_class($e) . ": " . $e->getMessage()."\n";
}
try {
	var_dump(FFI::sizeof(FFI::cast("int[]", FFI::new("int[2]"))));
} catch (Throwable $e) {
	echo get_class($e) . ": " . $e->getMessage()."\n";
}
try {
	new FFI("struct _x {int a; int b[];};");
	echo "ok\n";
} catch (Throwable $e) {
	echo get_class($e) . ": " . $e->getMessage()."\n";
}
try {
	$f = new FFI("typedef int(*foo)[];");
	echo "ok\n";
} catch (Throwable $e) {
	echo get_class($e) . ": " . $e->getMessage()."\n";
}
try {
	$f = new FFI("typedef int foo[][2];");
	echo "ok\n";
} catch (Throwable $e) {
	echo get_class($e) . ": " . $e->getMessage()."\n";
}
try {
	$f = new FFI("typedef int foo[];");
	echo "ok\n";
} catch (Throwable $e) {
	echo get_class($e) . ": " . $e->getMessage()."\n";
}
try {
	$f = new FFI("static int foo(int[]);");
	echo "ok\n";
} catch (Throwable $e) {
	echo get_class($e) . ": " . $e->getMessage()."\n";
}
?>
--EXPECTF--
FFI\ParserException: '[*]' not allowed in other than function prototype scope at line 1
FFI\ParserException: '[*]' not allowed in other than function prototype scope at line 1
FFI\ParserException: '[*]' not allowed in other than function prototype scope at line 1
ok
int(0)
FFI\ParserException: '[]' not allowed at line 1
FFI\ParserException: '[]' not allowed at line 1
ok
ok
ok
ok
ok
