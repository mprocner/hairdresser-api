<?php
declare(strict_types=1);
/**
 * File: CurrentUserExtension.php
 *
 * @author Mateusz Procner<mateusz.procner@gmail.com>
 * @copyright Copyright (C) 2020 Mateusz Procner
 */

namespace App\Doctrine;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Booking;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;

/**
 * Class CurrentUserExtension
 * @package App\Doctrine
 */
final class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{

    /**
     * @var Security
     */
    private $security;

    /**
     * CurrentUserExtension constructor.
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param QueryNameGeneratorInterface $queryNameGenerator
     * @param string $resourceClass
     * @param string|null $operationName
     */
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param QueryNameGeneratorInterface $queryNameGenerator
     * @param string $resourceClass
     * @param array $identifiers
     * @param string|null $operationName
     * @param array $context
     */
    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string $resourceClass
     */
    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass): void
    {
        if (Booking::class !== $resourceClass || null === $user = $this->security->getUser()) {
            return;
        }

        $rootAlias = $queryBuilder->getRootAliases()[0];
        $queryBuilder->andWhere(sprintf('%s.user = :current_user', $rootAlias));
        $queryBuilder->setParameter('current_user', $user->getId());
    }
}
