<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesProductConfigurationGui\Communication\Expander;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\SalesProductConfigurationGui\Communication\Resolver\ProductConfigurationTemplateResolverInterface;

class ProductConfigurationOrderDetailDataExpander implements ProductConfigurationOrderDetailDataExpanderInterface
{
    protected const string KEY_ORDER_ITEM_PRODUCT_CONFIGURATION_TEMPLATES = 'orderItemProductConfigurationTemplates';

    protected const string KEY_TEMPLATE = 'template';

    protected const string KEY_ORDER_ITEM = 'orderItem';

    public function __construct(protected readonly ProductConfigurationTemplateResolverInterface $productConfigurationTemplateResolver)
    {
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param array<string, mixed> $orderDetailData
     *
     * @return array<string, mixed>
     */
    public function expand(OrderTransfer $orderTransfer, array $orderDetailData): array
    {
        $productConfigurationTemplates = [];

        foreach ($orderTransfer->getItems() as $itemTransfer) {
            $productConfigurationTemplates[$itemTransfer->getIdSalesOrderItem()] = [
                static::KEY_TEMPLATE => $this->productConfigurationTemplateResolver->resolveProductConfigurationTemplate($itemTransfer),
                static::KEY_ORDER_ITEM => $itemTransfer,
            ];
        }

        $orderDetailData[static::KEY_ORDER_ITEM_PRODUCT_CONFIGURATION_TEMPLATES] = $productConfigurationTemplates;

        return $orderDetailData;
    }
}
