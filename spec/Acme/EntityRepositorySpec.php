<?php

namespace spec\Acme;

use Acme\Entity;
use PhpSpec\ObjectBehavior;

class EntityRepositorySpec extends ObjectBehavior
{
    function it_returns_an_entity_by_id(Entity $entity)
    {
        $entity->getId()->willReturn(123);

        $this->save($entity);
        $this->find(123)->shouldReturn($entity);
    }

    function it_returns_null_if_the_id_does_not_exist(Entity $entity)
    {
        $entity->getId()->willReturn(123);

        $this->save($entity);
        $this->find(456)->shouldReturn(null);
    }
}
