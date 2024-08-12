<?php

namespace NW\WebService\Actors;

use NW\WebService\Exceptions\EmployeeNotFoundException;

class Employee extends Actor
{
    public function __construct(int $id, string $name, protected string $email)
    {
        parent::__construct($id, $name);
    }

    /**
     * @return string
     */
    public static function role(): string
    {
        return 'employee';
    }

    /**
     * @param int $id
     * @return Employee
     * @throws EmployeeNotFoundException
     */
    public static function load(int $id): Employee
    {
        // fakes the method
        try {
            return new Employee($id, 'Jacob Daw', 'jacob@daw.com');
        } catch (\Throwable $e) {
            throw new EmployeeNotFoundException($e->getMessage(), 402, $e);
        }
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
