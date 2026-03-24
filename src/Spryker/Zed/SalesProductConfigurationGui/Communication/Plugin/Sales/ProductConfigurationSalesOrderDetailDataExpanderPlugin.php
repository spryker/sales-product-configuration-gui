<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesProductConfigurationGui\Communication\Plugin\Sales;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesExtension\Dependency\Plugin\SalesOrderDetailDataExpanderPluginInterface;

/**
 * @method \Spryker\Zed\SalesProductConfigurationGui\Communication\SalesProductConfigurationGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\SalesProductConfigurationGui\SalesProductConfigurationGuiConfig getConfig()
 */
class ProductConfigurationSalesOrderDetailDataExpanderPlugin extends AbstractPlugin implements SalesOrderDetailDataExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     * - Expands order detail data with product configuration templates for each order item.
     * - Resolves templates using ProductConfigurationTemplateResolver and render strategy plugins.
     * - Adds `orderItemProductConfigurationTemplates` array indexed by item ID with template data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param array<string, mixed> $orderDetailData
     *
     * @return array<string, mixed>
     */
    public function expand(OrderTransfer $orderTransfer, array $orderDetailData): array
    {
        return $this->getFactory()->createProductConfigurationOrderDetailDataExpander()->expand($orderTransfer, $orderDetailData);
    }
}
