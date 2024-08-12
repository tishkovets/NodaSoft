<?php

namespace NW\WebService\Actors;

use NW\WebService\Exceptions\ExpertNotFoundException;

class Expert extends Actor
{
    /**
     * @return string
     */
    public static function role(): string
    {
        return 'expert';
    }

    /**
     * @param int $id
     * @return Expert
     * @throws ExpertNotFoundException
     */
    public static function load(int $id): Expert
    {
        // fakes the method
        try {
            return new Expert($id, 'Jane Daw');
        } catch (\Throwable $e) {
            throw new ExpertNotFoundException($e->getMessage(), 403, $e);
        }
    }
}
