<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesProductConfigurationGui\Communication\Resolver;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\SalesProductConfigurationTemplateTransfer;

interface ProductConfigurationTemplateResolverInterface
{
    public function resolveProductConfigurationTemplate(ItemTransfer $itemTransfer): ?SalesProductConfigurationTemplateTransfer;
}
