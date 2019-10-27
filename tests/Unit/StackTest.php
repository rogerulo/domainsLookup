<?php
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    protected $stack;

    protected function setUp(): void
    {
        $this->stack = [];
    }

    public function testEmpty()
    {
        $this->assertTrue(empty($this->stack));
    }

    public function testPush()
    {
        array_push($this->stack, 'foo');
        $this->assertSame('foo', $this->stack[count($this->stack)-1]);
        $this->assertFalse(empty($this->stack));
    }

    public function testPop()
    {
        array_push($this->stack, 'foo');
        $this->assertSame('foo', array_pop($this->stack));
        $this->assertTrue(empty($this->stack));
    }

    public function testPushInvalidDomainFormat(){
                // Stop here and mark this test as incomplete.
                $this->markTestIncomplete(
                    'This test has not been implemented yet.'
                  );
    }

    public function testPushValidDomainFormat(){
                // Stop here and mark this test as incomplete.
                $this->markTestIncomplete(
                    'This test has not been implemented yet.'
                  );
    }

    public function testPushExistingEntry(){
                // Stop here and mark this test as incomplete.
                $this->markTestIncomplete(
                    'This test has not been implemented yet.'
                  );
    }

    public function testIsUsingAjax(){
                // Stop here and mark this test as incomplete.
                $this->markTestIncomplete(
                    'This test has not been implemented yet.'
                  );
    }

}
