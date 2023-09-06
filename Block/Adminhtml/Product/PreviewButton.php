<?php

namespace Magepow\Preview\Block\Adminhtml\Product;

class PreviewButton extends \Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic
{
    public function getButtonData()
    {
        $product = $this->getProduct();
        if($product){
            $storeId    =  (int)$this->context->getRequestParam('store');
            $productUrl = $product->setStoreId($storeId)->getUrlModel()->getUrlInStore($product, ['_escape' => true]);
            return [
                'label' => __('Preview'),
                'class' => 'action-secondary preview',
                // 'on_click' => "confirmSetLocation('Are you sure', '{$productUrl}')",
                'on_click' => 'window.open( \'' . $productUrl . '\')',
                'sort_order' => 10
            ];
        }

        return [];
    }

}