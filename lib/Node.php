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

/**
 * Node class
 *
 * @category DataStructures
 * @package  Default
 * @author   Matt McMahand <mmcmahand@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://github.com/invalidusrname/php_linked_list
 */
class Node
{
    /**
     * data we're holding
     *
     * @var mixed
     */
    private $_data;

    /**
     * pointer to next Node
     *
     * @var mixed
     */
    private $_next;

    /**
     * pointer to the previous Node
     *
     * @var mixed
     */
    private $_prev;

    /**
     * constructor
     *
     * @param mixed $data data we're adding
     */
    public function __construct($data)
    {
        $this->_data = $data;
        $this->_next = null;
        $this->_prev = null;
    }

    /**
     * gets the node next to this one
     *
     * @return mixed
     */
    public function getNext()
    {
        return $this->_next;
    }

    /**
     * sets the next node
     *
     * @param mixed $node node to set
     *
     * @return void
     */
    public function setNext($node)
    {
        $this->_next = $node;
    }

    /**
     * gets the previous node from this one
     *
     * @return mixed
     */
    public function getPrev()
    {
        return $this->_prev;
    }

    /**
     * sets the previous node
     *
     * @param mixed $node node to set
     *
     * @return void
     */
    public function setPrev($node)
    {
        $this->_prev = $node;
    }

    /**
     * returns the data being held in the node
     *
     * @return mixed
     */
    public function value()
    {
        return $this->_data;
    }

    /**
     * a string representation of the node
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value();
    }
}

?>
