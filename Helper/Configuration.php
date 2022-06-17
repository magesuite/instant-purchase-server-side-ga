<?php

namespace MageSuite\InstantPurchaseServerSideGa\Helper;

class Configuration
{
    const CUSTOM_DIMENSION_INDEX_XML_PATH = 'server_side_google_analytics/instant_purchase/custom_dimension_index';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getCustomDimensionIndex()
    {
        return $this->scopeConfig->getValue(self::CUSTOM_DIMENSION_INDEX_XML_PATH);
    }
}
