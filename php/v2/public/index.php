<?php

use NW\WebService\Exceptions\IncorrectInputDataException;
use NW\WebService\Operations\Operation;
use NW\WebService\Exceptions\ResellerNotFoundException;
use NW\WebService\Exceptions\ClientNotFoundException;
use NW\WebService\Exceptions\ExpertNotFoundException;
use NW\WebService\Exceptions\CreatorNotFoundException;

require __DIR__ . '/../vendor/autoload.php';

try {
    $raw = file_get_contents('php://input');
    if (!json_validate($raw)) {
        throw new IncorrectInputDataException('Incorrect json input');
    }

    $data = json_decode($raw, true);

    $operation = Operation::init($data);
    $data      = $operation->process();

    print json_encode($data);
} catch (IncorrectInputDataException $e) {
    print $e->getMessage();
} catch (ResellerNotFoundException $e) {
    print $e->getMessage();
} catch (ClientNotFoundException $e) {
    print $e->getMessage();
} catch (ExpertNotFoundException $e) {
    print $e->getMessage();
} catch (CreatorNotFoundException $e) {
    print $e->getMessage();
} catch (Throwable $e) {
    print 'unknown error';
}
