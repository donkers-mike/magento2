<?php
namespace MikeDonkers\CheckoutExtension\Model\Plugin\Checkout;
class LayoutProcessor
{
    /*
     _ @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     _ @param array $jsLayout
     _ @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['custom_field'] = [
            'component' => 'Magento_Ui/js/form/element/checkbox',
            'config' => [
                'customScope' => 'shippingAddress.subscribe_to_newsletter',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/checkbox',
                'options' => [],
                'id' => 'newsletter-subscription'
            ],
            'dataScope' => 'shippingAddress.custom_attributes.subscribe_to_newsletter',
            'label' => 'Subscribe to our newsletter',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 250,
            'id' => 'newsletter-subscription'
        ];


        return $jsLayout;
    }
}
