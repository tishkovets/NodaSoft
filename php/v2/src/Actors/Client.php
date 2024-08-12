<?php

namespace NW\WebService\Actors;

use NW\WebService\Exceptions\ClientNotFoundException;

final class Client extends Actor
{
    public function __construct(int $id, string $name, protected ?string $phone, protected ?string $email)
    {
        parent::__construct($id, $name);
    }

    /**
     * @return string
     */
    public static function role(): string
    {
        return 'client';
    }

    /**
     * @param int $id
     * @return Client
     * @throws ClientNotFoundException
     */
    public static function load(int $id): Client
    {
        // fakes the method
        try {
            return new Client($id, 'Jhon Daw', '+79123456789', 'jhon@daw.ru');
        } catch (\Throwable $e) {
            throw new ClientNotFoundException($e->getMessage(), 400, $e);
        }
    }

    /**
     * @return bool
     */
    public function hasPhone(): bool
    {
        return null !== $this->phone;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return bool
     */
    public function hasEmail(): bool
    {
        return null !== $this->email;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
}
