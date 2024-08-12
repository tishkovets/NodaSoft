<?php

namespace NW\WebService\Actors;

use NW\WebService\Exceptions\ResellerNotFoundException;

class Reseller extends Actor
{

    /**
     * @var Employee[]
     */
    protected array $employees;

    public function __construct(int $id, string $name, protected string $email)
    {
        parent::__construct($id, $name);
    }

    /**
     * @return string
     */
    public static function role(): string
    {
        return 'reseller';
    }

    /**
     * @param int $id
     * @return Reseller
     * @throws ResellerNotFoundException
     */
    public static function load(int $id): Reseller
    {
        try {
            return new Reseller($id, 'Jessica Daw', 'jessica@daw.com');
        } catch (\Throwable $e) {
            throw new ResellerNotFoundException($e->getMessage(), 404, $e);
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return Employee[]
     */
    public function getEmployees(): array
    {
        if (!isset($this->employees)) {
            $this->employees = $this->loadEmployees();
        }

        return $this->employees;
    }

    /**
     * @return Employee[]
     */
    protected function loadEmployees(): array
    {
        // fakes the method
        return [
            new Employee(101, 'Adam Daw', 'adam@daw.com'),
            new Employee(102, 'Eva Daw', 'eva@daw.com'),
        ];
    }

}
