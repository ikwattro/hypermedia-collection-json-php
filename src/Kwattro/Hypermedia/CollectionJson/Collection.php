<?php

namespace Kwattro\Hypermedia\CollectionJson;

use Doctrine\Common\Collections\ArrayCollection;
use Kwattro\Hypermedia\CollectionJson\Item;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * @AccessorOrder("custom", custom = {"version", "href" ,"items", "errors"})
 *
 */
class Collection
{
    const version = "1.0";

    /**
     * @Type("ArrayCollection")
     *
     */
    protected $items;

    /**
     * @Type("string")
     */
    protected $href;

    /**
     * @Type("array")
     */
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
     * @VirtualProperty
     * @SerializedName("items")
     *
     * Returns the collection of Items
     *
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @VirtualProperty
     * @SerializedName("version")
     *
     *
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
     * @VirtualProperty
     * @SerializedName("href")
     *
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
     * @VirtualProperty
     * @SerializedName("errors")
     *
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

    /**
     * Serialize the Collection object to Json
     *
     * @return string json object
     */
    public function serialize()
    {
        return json_encode($this->getArrayCollection());
    }

    /**
     * Get an array representation of the Collection
     *
     * @return array
     */
    public function getArrayCollection()
    {
        $items = array();
        foreach ($this->items as $item) {
            $items[] = $item->toArray();
        }
        $arrayCollection = array(
            'collection' => array(
                'version' => self::version,
                'href' => $this->href,
                'items' => $items,
                'errors' => $this->getErrors()
            )
        );
        return $arrayCollection;
    }
}
