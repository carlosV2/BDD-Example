<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;

class EntitySpec extends ObjectBehavior
{
    function it_exposes_id()
    {
        $this->setId(123);
        $this->getId()->shouldReturn(123);
    }

    function it_exposes_name()
    {
        $this->setName('Name');
        $this->getName()->shouldReturn('Name');
    }
}
