<?php

namespace spec\Acme;

use Acme\Entity;
use Acme\EntityRepository;
use PhpSpec\ObjectBehavior;

class ShowEntityNameControllerSpec extends ObjectBehavior
{
    function let(EntityRepository $entityRepository)
    {
        $this->beConstructedWith($entityRepository);
    }

    function it_shows_the_entity_name_for_a_given_id(EntityRepository $entityRepository, Entity $entity)
    {
        $entity->getName()->willReturn('Entity');

        $entityRepository->find(456)->willReturn($entity);

        $this->showEntityNameAction(456)->shouldReturn('Entity');
    }

    function it_throws_an_exception_if_entity_is_not_found(EntityRepository $entityRepository)
    {
        $entityRepository->find(789)->willReturn(null);

        $this->shouldThrow(\Exception::class)->duringShowEntityNameAction(789);
    }
}























