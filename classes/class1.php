<?php 

/**
 * 
 */
class Test 
{
	public $test;
	function __construct($no)
	{
		$this->test = $no;
		return $this;
	}
}
class OopClass
{
    public $first;
    public $second;
    public $third;

    public static function make($first)
    {
        return new OopClass($first);
    }

    public function __construct($first)
    {
        $this->first = $first;
    }

    public function second($second)
    {
        $this->second = $second;
        return $this;
    }

    public function third($third)
    {
        $this->third = $third;
        return $this;
    }
}
echo '<pre>';
$b  = new OopClass(new OopClass(new test(['Hello','dear'])));
$a = OopClass::make($b)->second('To')->third('World');
print_r($a);
//echo $a->first;

class Counter implements Countable
{
	public $a;
	public function __construct()
    {
        return $this->test($this->a)  ;
    }
     public function count():int
    {
        
        return count(get_class_methods($this));
    }
    public function test($a)
	{
		$this->a = $a;
		return $this->a;
	}
}
$count = new Counter();
var_dump($count);
var_dump($count->count());
var_dump($count->test(['a','b','c','d','e']));
var_dump($count->count());

 ?>