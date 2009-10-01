<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__) . '/../lib/LinkedList.php';

class LinkedListTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->linked_list = new LinkedList();
    }

    public function testEmptyLinkedListIsEmpty()
    {
        $this->assertTrue($this->linked_list->isEmpty());
    }

    public function testPush()
    {
        $nodes = array(new Node(1), new Node(2));

        $this->linked_list->push($nodes[0]);

        $this->assertFalse($this->linked_list->isEmpty());

        $this->linked_list->push($nodes[1]);

        $this->assertFalse($this->linked_list->isEmpty());
        $this->assertEquals(2, $this->linked_list->size());

        $node = $this->linked_list->getIndex(0);

        $this->assertEquals(1, $node->value());
    }

    public function testFirst()
    {
        $this->assertEquals(null, $this->linked_list->getFirst());

        $node = new Node(1);

        $this->linked_list->push($node);
        $this->assertEquals($node->value(), $this->linked_list->getFirst()->value());

        $another_node = new Node(2);

        $this->linked_list->push($another_node);
        $this->assertEquals($node->value(), $this->linked_list->getFirst()->value());
    }

    public function testLast()
    {
        $this->assertEquals(null, $this->linked_list->getLast());

        $node = new Node(1);

        $this->linked_list->push($node);
        $this->assertEquals($node->value(), $this->linked_list->getLast()->value());

        $another_node = new Node(2);

        $this->linked_list->push($another_node);
        $last = $this->linked_list->getLast();
        $this->assertEquals($another_node->value(), $last->value());
    }

    public function testInsertAtBeginning()
    {
        $node = new Node(1);
        $this->linked_list->insertAtBeginning($node);
        $this->assertEquals($node, $this->linked_list->getFirst());
        $this->assertFalse($this->linked_list->isEmpty());

        $another_node = new Node(1);
        $this->linked_list->insertAtBeginning($another_node);

        $this->assertEquals($another_node, $this->linked_list->getFirst());
        $this->assertEquals($node, $this->linked_list->getLast());
    }

    public function testRemoveBeginning()
    {
        $this->linked_list->removeBeginning();
        $this->assertEquals('', (string) $this->linked_list);

        $this->linked_list->clear();
        $this->linked_list->push(new Node(1));
        $this->linked_list->removeBeginning();
        $this->assertEquals('', (string) $this->linked_list);

        $this->linked_list->clear();
        $this->linked_list->push(new Node(1));
        $this->linked_list->push(new Node(2));
        $this->linked_list->removeBeginning();
        $this->assertEquals('2', (string) $this->linked_list);

        $this->linked_list->clear();
        $this->linked_list->push(new Node(1));
        $this->linked_list->push(new Node(2));
        $this->linked_list->push(new Node(3));
        $this->linked_list->removeBeginning();
        $this->assertEquals('2-3', (string) $this->linked_list);

        $this->linked_list->clear();
        $this->linked_list->push(new Node(1));
        $this->linked_list->removeBeginning();
        $this->linked_list->push(new Node(2));
        $this->linked_list->removeBeginning();
        $this->assertEquals('', (string) $this->linked_list);
    }

    public function testPop()
    {
        $this->linked_list->pop();
        $this->assertEquals('', (string) $this->linked_list);

        $this->linked_list->clear();
        $this->linked_list->push(new Node(1));
        $this->linked_list->pop();
        $this->assertEquals('', (string) $this->linked_list);

        $this->linked_list->clear();
        $this->linked_list->push(new Node(1));
        $this->linked_list->push(new Node(2));
        $this->linked_list->pop();
        $this->assertEquals('1', (string) $this->linked_list);

        $this->linked_list->clear();
        $this->linked_list->push(new Node(1));
        $this->linked_list->push(new Node(2));
        $this->linked_list->push(new Node(3));
        $this->linked_list->pop();
        $this->assertEquals('1-2', (string) $this->linked_list);

        $this->linked_list->clear();
        $this->linked_list->push(new Node(1));
        $this->linked_list->pop();
        $this->linked_list->push(new Node(1));
        $this->assertEquals('1', (string) $this->linked_list);
    }

    public function testReverse()
    {
        $this->linked_list->push(new Node(1));
        $this->assertEquals('1', $this->linked_list->printReverse());

        $this->linked_list->push(new Node(2));
        $this->assertEquals('2-1', $this->linked_list->printReverse());

        $this->linked_list->push(new Node(3));
        $this->assertEquals('3-2-1', $this->linked_list->printReverse());

        $this->linked_list->pop();
        $this->assertEquals('2-1', $this->linked_list->printReverse());

        $this->linked_list->pop();
        $this->assertEquals('1', $this->linked_list->printReverse());

        $this->linked_list->pop();
        $this->assertEquals('', $this->linked_list->printReverse());

        $this->linked_list->clear();

        $this->linked_list->push(new Node(1));
        $this->linked_list->push(new Node(2));
        $this->linked_list->push(new Node(3));

        $this->assertEquals('3-2-1', $this->linked_list->printReverse());

        $this->linked_list->removeBeginning();
        $this->assertEquals('3-2', $this->linked_list->printReverse());

        $this->linked_list->removeBeginning();
        $this->assertEquals('3', $this->linked_list->printReverse());

        $this->linked_list->removeBeginning();

        $this->assertEquals('', $this->linked_list->printReverse());
    }

    public function testGetIndex()
    {
        // for a non-empty LinkedList
        $first_node = new Node(1);
        $this->linked_list->push($first_node);

        $index = $this->linked_list->getIndex(0);
        $this->assertEquals($first_node, $index);

        $last_node = new Node(2);
        $this->linked_list->push($last_node);

        $index = $this->linked_list->getIndex(0);
        $this->assertEquals($first_node, $index);

        $index = $this->linked_list->getIndex(1);
        $this->assertEquals($last_node, $index);

        $third_node = new Node(3);
        $fourth_node = new Node(4);

        $this->linked_list->push($third_node);
        $this->linked_list->push($fourth_node);

        $index = $this->linked_list->getIndex(1);
        $this->assertEquals($index, $index);

        $index = $this->linked_list->getIndex(2);
        $this->assertEquals($index, $index);

        $final_index = $this->linked_list->getIndex(3);
        $this->assertEquals($final_index, $final_index);

        // for an empty LinkedList
        $this->linked_list = new LinkedList();

        $non_index     = $this->linked_list->getIndex(0);
        $another_index = $this->linked_list->getIndex(1);
        $last_index    = $this->linked_list->getIndex(2);
        $negative_index    = $this->linked_list->getIndex(-1);

        $this->assertEquals(null, $non_index);
        $this->assertEquals(null, $another_index);
        $this->assertEquals(null, $last_index);
        $this->assertEquals(null, $negative_index);
    }
}

?>
