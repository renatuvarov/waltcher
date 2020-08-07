<?php

namespace App\Handlers;

use Exception;
use Illuminate\Database\ConnectionInterface;
use Psr\Log\LoggerInterface;

class TransactionManager
{
    /**
     * @var ConnectionInterface
     */
    private $connection;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(ConnectionInterface $connection, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->logger = $logger;
    }

    public function handle(callable $callback)
    {
        $result = null;

        $this->connection->beginTransaction();

        try {
            $result = $callback();
            $this->connection->commit();
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            $this->connection->rollback();
        }

        return $result;
    }
}
