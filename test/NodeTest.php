<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__) . '/../lib/Node.php';

class NodeTest extends PHPUnit_Framework_TestCase
{
    public function testEmptyNode()
    {
        $node = new Node('');
        $this->assertEquals('', (string) $node);
        
        $node = new Node(null);
        $this->assertEquals('', (string) $node);
    }

    public function testNonEmptyNode()
    {
        $node = new Node('one');
        $this->assertEquals('one', $node->value());

        $node = new Node(123);
        $this->assertEquals(123, $node->value());
        
        $node = new Node(array('item1', 'item2'));
        $this->assertEquals(array('item1', 'item2'), $node->value());
    }
    
    public function testValue()
    {
        $node = new Node('1');
        $this->assertEquals('1', $node->value());
        
        $node = new Node('');
        $this->assertEquals('', $node->value());
        
        $node = new Node(1);
        $this->assertEquals(1, $node->value());

        $node = new Node(array(1,2,3));
        $this->assertEquals(array(1,2,3), $node->value());
    }
}