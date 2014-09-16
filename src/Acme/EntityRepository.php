<?php

namespace Acme;

class EntityRepository
{
    /**
     * @var array
     */
    private $cache;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cache = [];
    }

    /**
     * @param Entity $entity
     */
    public function save(Entity $entity)
    {
        $this->cache[$entity->getId()] = $entity;
    }

    /**
     * @param int $id
     *
     * @return null|Entity
     */
    public function find($id)
    {
        if (array_key_exists($id, $this->cache)) {
            return $this->cache[$id];
        }

        return null;
    }
}
