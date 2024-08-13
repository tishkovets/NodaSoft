<?php

namespace NW\WebService\Actors;

use NW\WebService\Exceptions\CreatorNotFoundException;

final class Creator extends Actor
{
    /**
     * @return string
     */
    public static function role(): string
    {
        return 'creator';
    }

    /**
     * @param int $id
     * @return Creator
     * @throws CreatorNotFoundException
     */
    public static function load(int $id): Creator
    {
        // fakes the method
        try {
            return new Creator($id, 'Justin Daw');
        }  catch (\Throwable $e) {
            throw new CreatorNotFoundException($e->getMessage(), 401, $e);
        }
    }
}
