<?php

namespace MikeDonkers\BaseConfig\Setup;
use Magento\Theme\Model\Config;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Design\Theme\ThemeProviderInterface;
use Magento\Store\Model\Store;

/**
 * Class UpgradeData
 * @package MikeDonkers\BaseConfig\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var Config
     */
    protected $config;
    /**
     * @var ThemeProviderInterface
     */
    protected $themeProvider;

    /**
     * UpgradeData constructor.
     * @param ThemeProviderInterface $themeProvider
     * @param Config $config
     */
    public function __construct(
        ThemeProviderInterface $themeProvider,
        Config $config
    ) {
        $this->config = $config;
        $this->themeProvider = $themeProvider;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Zend_Json_Exception
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $this->setTheme($context);

        $setup->endSetup();
    }

    /**
     * @param ModuleContextInterface $context
     */
    protected function setTheme(ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $theme = $this->themeProvider->getThemeByFullPath('frontend/MikeDonkers/main');
            $this->config->assignToStore(
                $theme,
                [Store::DEFAULT_STORE_ID],
                ScopeConfigInterface::SCOPE_TYPE_DEFAULT
            );
        }
    }
}
