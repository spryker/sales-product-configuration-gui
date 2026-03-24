<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\SalesProductConfigurationGui\Communication\Plugin\Sales;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\SalesProductConfigurationGui\Communication\Plugin\Sales\ProductConfigurationSalesOrderDetailDataExpanderPlugin;
use SprykerTest\Zed\SalesProductConfigurationGui\SalesProductConfigurationGuiCommunicationTester;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group SalesProductConfigurationGui
 * @group Communication
 * @group Plugin
 * @group Sales
 * @group ProductConfigurationSalesOrderDetailDataExpanderPluginTest
 * Add your own group annotations below this line
 */
class ProductConfigurationSalesOrderDetailDataExpanderPluginTest extends Unit
{
    protected const string DEFAULT_OMS_PROCESS_NAME = 'Test01';

    protected SalesProductConfigurationGuiCommunicationTester $tester;

    public function testExpandAddsOrderItemProductConfigurationTemplatesKey(): void
    {
        // Arrange
        $plugin = $this->getSalesOrderDetailDataExpanderPlugin();
        $orderTransfer = new OrderTransfer();

        // Act
        $result = $plugin->expand($orderTransfer, []);

        // Assert
        $this->assertArrayHasKey('orderItemProductConfigurationTemplates', $result);
        $this->assertIsArray($result['orderItemProductConfigurationTemplates']);
        $this->assertEmpty($result['orderItemProductConfigurationTemplates']);
    }

    public function testExpandAddsOrderItemProductConfigurationTemplatesIndexedByItemId(): void
    {
        // Arrange
        $this->tester->configureTestStateMachine([static::DEFAULT_OMS_PROCESS_NAME]);
        $saveOrderTransfer = $this->tester->haveOrder([], static::DEFAULT_OMS_PROCESS_NAME);

        $plugin = $this->getSalesOrderDetailDataExpanderPlugin();
        $orderTransfer = (new OrderTransfer())->setItems($saveOrderTransfer->getOrderItems());

        // Act
        $result = $plugin->expand($orderTransfer, []);

        // Assert
        $this->assertArrayHasKey('orderItemProductConfigurationTemplates', $result);

        $itemTransfer = $saveOrderTransfer->getOrderItems()->offsetGet(0);
        $idSalesOrderItem = $itemTransfer->getIdSalesOrderItem();
        $this->assertArrayHasKey($idSalesOrderItem, $result['orderItemProductConfigurationTemplates']);

        $itemData = $result['orderItemProductConfigurationTemplates'][$idSalesOrderItem];
        $this->assertArrayHasKey('template', $itemData);
        $this->assertArrayHasKey('orderItem', $itemData);
    }

    public function testExpandPreservesExistingData(): void
    {
        // Arrange
        $plugin = $this->getSalesOrderDetailDataExpanderPlugin();
        $orderTransfer = new OrderTransfer();
        $existingData = ['someKey' => 'someValue'];

        // Act
        $result = $plugin->expand($orderTransfer, $existingData);

        // Assert
        $this->assertArrayHasKey('someKey', $result);
        $this->assertArrayHasKey('orderItemProductConfigurationTemplates', $result);
    }

    public function getSalesOrderDetailDataExpanderPlugin(): ProductConfigurationSalesOrderDetailDataExpanderPlugin
    {
        return new ProductConfigurationSalesOrderDetailDataExpanderPlugin();
    }
}
