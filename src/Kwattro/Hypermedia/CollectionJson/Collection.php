<?php

namespace Kwattro\Hypermedia\CollectionJson;

use Doctrine\Common\Collections\ArrayCollection;
use Kwattro\Hypermedia\CollectionJson\Item;

class Collection
{
    const version = "1.0";

    protected $items;
    protected $href;
    protected $errors;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->errors = array();
    }

    /**
     * Returns the collection of Items
     *
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Returns the current version of the Collection+Json Hypermadia Format
     *
     * @return string
     */
    public function getVersion()
    {
        return self::version;
    }

    /**
     * Adds an Item to the collection
     *
     * @param Item $item
     * @return bool
     */
    public function addItem(Item $item)
    {
        return $this->items->add($item);
    }

    /**
     * Removes an Item from the collection
     *
     * @param Item $item
     * @return bool
     */
    public function removeItem(Item $item)
    {
        return $this->items->removeElement($item);
    }

    /**
     * Gets the Collection location
     *
     * @return mixed
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Sets the Collection location
     *
     * @param $href
     */
    public function setHref($href)
    {
        $this->href = $href;
    }

    /**
     * Get errors related to the resource location query
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Add an error related to the resource location query
     *
     * @param array $error
     */
    public function setError(array $error)
    {
        $this->errors[] = $error;
    }

    /**
     * Gets total number of errors
     *
     * @return int
     */
    public function getErrorsCount()
    {
        return count($this->errors);
    }
}
