<?php

/**
 * undocumented
 *
 * PHP version 5
 *
 * @category DataStructures
 * @package  Default
 * @author   Matt McMahand <mmcmahand@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://github.com/invalidusrname/php_linked_list
 */

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once dirname(__FILE__) . "/Node.php";

/**
 * LinkedList class
 *
 * @category DataStructures
 * @package  Default
 * @author   Matt McMahand <mmcmahand@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://github.com/invalidusrname/php_linked_list
 */
class LinkedList
{
    /**
     * first node in the LinkedList
     *
     * @var Node
     */
    private $_first;

    /**
     * last node in the LinkedList
     *
     * @var Node
     */
    private $_last;

    /**
     * number of nodes in list
     *
     * @var integer
     */
    private $_count;


    /**
     * constructor
     */
    public function __construct()
    {
        $this->_first = null;
        $this->_last  = null;
        $this->_count = 0;
    }

    /**
     * adds a node to the end of the linked list and increases the count
     *
     * @param Node $new_node node to add
     *
     * @return void
     */
    public function push($new_node)
    {
        if ($this->isEmpty()) {
            $this->insertAtBeginning($new_node);
        } else {
            $prev = $this->getLast();
            $prev->setNext($new_node);
            $new_node->setPrev($prev);
            $this->_last = $new_node;
        }
        $this->_count++;
    }

    /**
     * gets the Node at the specified index
     *
     * @param integer $index index to find
     *
     * @return mixed Node if found, otherwise null
     */
    public function getIndex($index)
    {
        if (!$this->isEmpty() && ($this->size() - 1) >= $index) {
            if ($this->size() == $index) {
                return $this->getLast();
            } else if ($index == 0) {
                return $this->getFirst();
            }

            $current_node = $this->getFirst();
            $position = 0;

            while ($current_node) {
                if ($position == $index) {
                    return $current_node;
                }

                $position++;
                $current_node = $current_node->getNext();
            }
        }
    }

    /**
     * adds a node to the beginning
     *
     * @param Node $node node to add
     *
     * @return void
     **/
    public function insertAtBeginning($node)
    {
        if ($this->isEmpty()) {
            $this->_last = $node;

        } else {
            $first = $this->getFirst();
            $first->setPrev($node);
            $node->setNext($first);
        }

        $this->_first = $node;
    }

    /**
     * undocumented function
     *
     * @return mixed the node removed
     **/
    public function removeBeginning()
    {
        if ($this->isEmpty()) {
            return;
        }

        $pop = $this->getFirst();
        $tmp = $pop->getNext();

        if ($tmp) {
            $tmp->setPrev(null);
        }

        $this->_first = $tmp;
        $this->_count--;

        if ($this->size() == 0) {
            $this->_last = null;
        }

        return $pop;
    }

    /**
     * removes the last item in the list
     *
     * @return void
     **/
    public function pop()
    {
        if ($this->isEmpty()) {
            return;
        }

        $first = $this->getFirst();
        $last  = $this->getLast();

        if ($first && $first->getNext() == null) {
            $this->_first = null;
            $this->_last  = null;
            $this->_count--;
        } else {
            $prev = $last->getPrev();
            $prev->setNext(null);
            $this->_last = $prev;
            $this->_count--;
        }
    }

    /**
     * gets the first item in the LinkedList
     *
     * @return mixed
     */
    public function getFirst()
    {
        return $this->_first;
    }

    /**
     * gets the last item in the LinkedList
     *
     * @return mixed
     */
    public function getLast()
    {
        return $this->_last;
    }

    /**
     * checks if the LinkedList is empty
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return $this->size() == 0;
    }

    /**
     * clears everything out
     *
     * @return void
     */
    public function clear()
    {
        $this->_first = null;
        $this->_last = null;
        $this->_count = 0;
    }

    /**
     * size of the LinkedList
     *
     * @return integer
     */
    public function size()
    {
        return $this->_count;
    }

    /**
     * toString
     *
     * @return string a string representation of the list
     */
    public function __toString()
    {
        $current_node = $this->getFirst();

        $nodes = array();

        while ($current_node) {
            $nodes[] = $current_node;
            $current_node = $current_node->getNext();
        }

        return join("-", $nodes);
    }

    /**
     * like __toString, but reversed
     *
     * @return string a reversed string representation of the list
     */
    public function printReverse()
    {
        $current_node = $this->getLast();

        $nodes = array();

        while ($current_node) {
            $nodes[] = $current_node;
            $current_node = $current_node->getPrev();
        }

        return join("-", $nodes);
    }
}

?>
