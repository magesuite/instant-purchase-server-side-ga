<?php

namespace MageSuite\InstantPurchaseServerSideGa\Plugin\ServerSideGoogleAnalytics\Model\Event\PurchaseBuilder;

class AddInstantPurchaseOriginAsDimension
{
    protected \MageSuite\InstantPurchaseServerSideGa\Helper\Configuration $configuration;

    public function __construct(\MageSuite\InstantPurchaseServerSideGa\Helper\Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function afterCreate(\MageSuite\ServerSideGoogleAnalytics\Model\Event\PurchaseBuilder $subject, $result)
    {
        $order = $subject->getOrder();

        if (empty($order->getInstantPurchaseOrigin())) {
            return $result;
        }

        $customDimensionIndex = $this->configuration->getCustomDimensionIndex();

        if (!is_numeric($customDimensionIndex)) {
            return $result;
        }

        $result->setData(
            sprintf('cd%s', $customDimensionIndex),
            $order->getInstantPurchaseOrigin()
        );

        return $result;
    }
}
