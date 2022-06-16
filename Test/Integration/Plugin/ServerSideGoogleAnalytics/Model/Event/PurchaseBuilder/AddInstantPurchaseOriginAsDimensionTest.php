<?php

namespace MageSuite\InstantPurchaseServerSideGa\Test\Integration\Plugin\ServerSideGoogleAnalytics\Model\Event\PurchaseBuilder;

class AddInstantPurchaseOriginAsDimensionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Magento\Sales\Model\Order
     */
    protected $order;

    /**
     * @var \MageSuite\ServerSideGoogleAnalytics\Model\Event\PurchaseBuilder
     */
    protected $purchaseBuilder;

    protected function setUp(): void
    {
        $objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
        $this->order = $objectManager->get(\Magento\Sales\Model\Order::class);
        $this->purchaseBuilder = $objectManager->get(\MageSuite\ServerSideGoogleAnalytics\Model\Event\PurchaseBuilder::class);
    }

    /**
     * @magentoDbIsolation enabled
     * @magentoAppIsolation enabled
     * @magentoAdminConfigFixture server_side_google_analytics/instant_purchase/custom_dimension_index 3
     * @magentoDataFixture Magento/Sales/_files/order_with_two_simple_products.php
     */
    public function testItAddsCustomDimensionWhenOrderWasDoneUsingInstantPurchase(): void
    {
        $order = $this->order->loadByIncrementId('100000001');

        $order->setInstantPurchaseOrigin('cart');
        $order->setGaUserId('dummy_id');

        $eventData = $this->purchaseBuilder
            ->setOrder($order)
            ->create()
            ->toArray();

        $this->assertEquals('cart', $eventData['cd3']);
    }
}
