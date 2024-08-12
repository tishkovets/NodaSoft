<?php

namespace NW\WebService\Actors;

abstract class Actor
{
    public function __construct(protected int $id, protected string $name)
    {
    }

    /**
     * @param int $id
     * @return self
     */
    abstract public static function load(int $id): self;

    /**
     * @return string
     */
    abstract public static function role(): string;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


}
