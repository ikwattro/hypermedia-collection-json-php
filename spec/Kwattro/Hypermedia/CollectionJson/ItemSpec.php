<?php

namespace spec\Kwattro\Hypermedia\CollectionJson;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ItemSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kwattro\Hypermedia\CollectionJson\Item');
    }

    function it_should_not_have_a_href_by_default()
    {
        $this->getHref()->shouldReturn(null);
    }

    function its_href_should_be_mutable()
    {
        $this->getHref()->shouldReturn(null);
        $this->setHref('http://example.com/resource');

        $this->getHref()->shouldReturn('http://example.com/resource');
    }

    function its_data_should_be_empty_by_default_and_of_array_type()
    {
        $this->getData()->shouldReturn(array());
    }

    function its_data_could_be_set_with_an_array()
    {
        $this->getData()->shouldReturn(array());
        $data = array('name' => 'Patrick');
        $this->setData($data);

        $this->getData()->shouldReturn($data);
    }

    function it_should_have_an_empty_links_array_by_default()
    {
        $this->getLinks()->shouldReturn(array());
    }

    function it_should_be_possible_to_add_data_to_existing_data()
    {
        $data = array(
            'name' => 'Chris'
        );
        $this->setData($data);
        $this->addData(array('city' => 'Plymouth'));

        $this->getData()->shouldReturn(array(
            'name' => 'Chris',
            'city' => 'Plymouth'
        ));
    }

    function it_should_merge_data_with_same_key()
    {
        $this->setData(array('name' => 'John'));
        $this->addData(array('name' => 'Ludo'));

        $this->getData()->shouldReturn(array('name' => 'Ludo'));
    }

    function it_should_be_possible_to_get_key_value_pair_from_data()
    {
        $this->setData(array('name' => 'Marcel'));

        $this->get('name')->shouldReturn('Marcel');
    }

    function it_should_return_null_if_property_key_does_not_exist()
    {
        $this->get('name')->shouldReturn(null);
    }

    function it_should_return_bool_if_data_property_exist_or_not()
    {
        $this->has('name')->shouldReturn(false);
        $this->setData(array('name' => 'Chris'));
        $this->has('name')->shouldReturn(true);
    }

    function it_should_be_possible_to_add_a_link_to_the_item()
    {
        $this->getLinks()->shouldReturn(array());
        $this->addLink('actors', 'http://example.com/actors');

        $this->getLinks()->shouldReturn(array(
            0 => array(
                'rel' => 'actors',
                'url' => 'http://example.com/actors'
            )
        ));
    }
}
