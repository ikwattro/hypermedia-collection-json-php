<?php

namespace Kwattro\Hypermedia\CollectionJson;

use Kwattro\Hypermedia\CollectionJson\Collection,
    Kwattro\Hypermedia\CollectionJson\EventSubscriber\EventSubscriber;
use JMS\Serializer\SerializerBuilder,
    JMS\Serializer\EventDispatcher\EventDispatcher;
use Doctrine\Common\Annotations\AnnotationRegistry;

class Serializer
{
    protected $builder;
    protected $annotationRegistry;

    public function __construct()
    {
        $this->builder = SerializerBuilder::create()
            ->configureListeners(function(EventDispatcher $dispatcher) {
                $dispatcher->addSubscriber(new EventSubscriber());
            })
            ->build();
        AnnotationRegistry::registerLoader('class_exists');
    }

    public static function create()
    {
        return new static();
    }

    public function serialize(Collection $collection)
    {
        $output = array(
            'collection' => $collection
        );

        return $this->builder->serialize($output, 'json');
    }

    public function deserialize($json)
    {
        return $this->builder->deserialize($json, 'Kwattro\Hypermedia\CollectionJson\Collection', 'json');
    }
}
