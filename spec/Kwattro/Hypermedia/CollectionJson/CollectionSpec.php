<?php

namespace spec\Kwattro\Hypermedia\CollectionJson;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Kwattro\Hypermedia\CollectionJson\Item;

class CollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kwattro\Hypermedia\CollectionJson\Collection');
    }

    function it_should_have_a_version_by_default()
    {
        $this->getVersion()->shouldReturn('1.0');
    }

    function it_should_have_a_collection_of_items_by_default()
    {
        $this->getItems()->shouldHaveType('Doctrine\Common\Collections\ArrayCollection');
    }

    function it_should_be_possible_to_add_an_item(Item $item)
    {
        $this->addItem($item);
        $this->getItems()->contains($item)->shouldReturn(true);
    }

    function it_should_be_possible_to_remove_an_item(Item $item)
    {
        $this->getItems()->count()->shouldReturn(0);
        $this->addItem($item);
        $this->getItems()->contains($item)->shouldReturn(true);
        $this->removeItem($item);
        $this->getItems()->contains($item)->shouldReturn(false);
    }

    function it_should_not_have_a_resource_location_by_default()
    {
        $this->getHref()->shouldReturn(null);
    }

    function its_href_should_be_mutable()
    {
        $this->setHref('http://example.com/movies');
        $this->getHref()->shouldReturn('http://example.com/movies');
    }

    function it_should_not_have_errors_by_default()
    {
        $this->getErrors()->shouldReturn(array());
    }

    function it_should_be_possible_to_add_an_error()
    {
        $this->getErrors()->shouldReturn(array());
        $this->setError(array(
            'code' => 404,
            'description' => 'resource not found'
        ));
        $this->getErrorsCount()->shouldReturn(1);
        $this->getErrors()->shouldReturn(array(
            0 => array(
                'code' => 404,
                'description' => 'resource not found'
            )
        ));
    }

    function it_should_arrayize_the_collection(Item $item)
    {
        $item->setHref('http://example.com/user/1234');
        $item->addData(array('name' => 'John'));
        $this->setHref('http://example.com');
        $this->addItem($item);
        $coll = $this->getArrayCollection();
        $coll['collection']['version']->shouldReturn('1.0');
        $items = $coll['collection']['items'];
    }
}
