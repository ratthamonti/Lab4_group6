<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace PrestaShop\PrestaShop\Core\Domain\ShowcaseCard\QueryHandler;

use PrestaShop\PrestaShop\Core\CommandBus\Attributes\AsQueryHandler;
use PrestaShop\PrestaShop\Core\ConfigurationInterface;
use PrestaShop\PrestaShop\Core\Domain\ShowcaseCard\ConfigurationMap;
use PrestaShop\PrestaShop\Core\Domain\ShowcaseCard\Exception\ShowcaseCardException;
use PrestaShop\PrestaShop\Core\Domain\ShowcaseCard\Query\GetShowcaseCardIsClosed;

/**
 * Finds out if a showcase card has been closed
 */
#[AsQueryHandler]
final class GetShowcaseCardIsClosedHandler implements GetShowcaseCardIsClosedHandlerInterface
{
    /**
     * @var ConfigurationInterface
     */
    private $configuration;
    /**
     * @var ConfigurationMap
     */
    private $configurationMap;

    /**
     * @param ConfigurationInterface $configuration
     * @param ConfigurationMap $configurationMap
     */
    public function __construct(ConfigurationInterface $configuration, ConfigurationMap $configurationMap)
    {
        $this->configuration = $configuration;
        $this->configurationMap = $configurationMap;
    }

    /**
     * @param GetShowcaseCardIsClosed $query
     *
     * @return bool
     *
     * @throws ShowcaseCardException
     */
    public function handle(GetShowcaseCardIsClosed $query)
    {
        $configurationName = $this->configurationMap->getConfigurationNameForClosedStatus($query->getShowcaseCard());

        return (bool) $this->configuration->get($configurationName);
    }
}
