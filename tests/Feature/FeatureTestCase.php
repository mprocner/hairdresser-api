<?php
declare(strict_types=1);
/**
 * File: FeatureTestCase.php
 *
 * @author Mateusz Procner<mateusz.procner@gmail.com>
 * @copyright Copyright (C) 2020 Mateusz Procner
 */

namespace App\Tests\Feature;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Booking;
use App\Entity\HairdresserPosition;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\StringInput;

class FeatureTestCase extends ApiTestCase
{
    /**
     * @var
     */
    protected $application;


    protected $entityManager;

    /**
     * @var KernelBrowser
     */
    protected $client;

    /**
     *
     */
    public function setUp()
    {
        $kernel = self::createKernel();
        $kernel->boot();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->truncateEntities([
            User::class,
            Booking::class,
            HairdresserPosition::class,
        ]);

        $this->runCommand('doctrine:schema:drop --full-database');
        $this->runCommand('doctrine:migrations:migrate');
        $this->runCommand('doctrine:fixtures:load');
    }

    private function truncateEntities(array $entities)
    {
        $connection = $this->entityManager->getConnection();
        $databasePlatform = $connection->getDatabasePlatform();
        if ($databasePlatform->supportsForeignKeyConstraints()) {
            $connection->query('SET FOREIGN_KEY_CHECKS=0');
        }
        foreach ($entities as $entity) {
            $query = $databasePlatform->getTruncateTableSQL(
                $this->entityManager->getClassMetadata($entity)->getTableName()
            );
            $connection->executeUpdate($query);
        }
        if ($databasePlatform->supportsForeignKeyConstraints()) {
            $connection->query('SET FOREIGN_KEY_CHECKS=1');
        }
    }

    /**
     * @param $command
     * @return int
     * @throws \Exception
     */
    protected function runCommand($command)
    {
        $command = sprintf('%s --quiet', $command);

        return $this->getApplication()->run(new StringInput($command));
    }

    /**
     * @return Application
     */
    protected function getApplication()
    {
        if (null === $this->application) {
            $this->client = static::createClient();

            $this->application = new Application($this->client->getKernel());
            $this->application->setAutoExit(false);
        }

        return $this->application;
    }
}