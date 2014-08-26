<?php

namespace Kwattro\Hypermedia\CollectionJson;

class Item
{
    protected $href;
    protected $data;
    protected $links;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = array();
        $this->links = array();
    }

    /**
     * Returns the location of the resource
     *
     * @return string location of the resource
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Sets the location of the resource
     *
     * @param string $href location of the resource
     */
    public function setHref($href)
    {
        $this->href = $href;
    }

    /**
     * Returns the resource data properties
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the resource data properties
     *
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * Returns the links related to the resource
     *
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Adds a link related to the resource
     *
     * For example, for a Movie Actor Item, you may want to add a link to the biography of the actor
     *
     * @param string $rel
     * @param string $url
     */
    public function addLink($rel, $url)
    {
        $this->links[] = array(
            'rel' => $rel,
            'url' => $url
        );
    }

    /**
     * Append data properties to the existing data
     *
     * @param array $data
     */
    public function addData(array $data)
    {
        $this->data = array_merge($this->data, $data);
    }

    /**
     * Get data property key/value pair
     *
     * @param string $key
     * @return string|null the value of the key property, null if not found
     */
    public function get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    /**
     * Returns whether or not data properties contain a specific key
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->data[$key]) ? true : false;
    }
}
