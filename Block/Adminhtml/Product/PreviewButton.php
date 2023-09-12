<?php

namespace Magepow\Preview\Block\Adminhtml\Product;

use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\Catalog\Model\Product\Visibility;

class PreviewButton extends \Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic
{

    private function disablePreview()
    {
        return $this->getProduct()->getStatus() == Status::STATUS_DISABLED
            || $this->getProduct()->isReadonly()
            || $this->getProduct()->getVisibility() == Visibility::VISIBILITY_NOT_VISIBLE;
    }

    public function getButtonData()
    {
        if($this->disablePreview()){    
            return [];
        }
        $product = $this->getProduct();
        if($product){
            $storeId    =  (int)$this->context->getRequestParam('store');
            if (!$storeId) {
                $storeManager = \Magento\Framework\App\ObjectManager::getInstance()
                                ->create(\Magento\Store\Model\StoreManagerInterface::class);
                $storeId = $storeManager->getDefaultStoreView()->getId();
            }
            $productUrl = $product->setStoreId($storeId)->getUrlModel()->getUrlInStore($product, ['_escape' => true]);
            return [
                'label' => __('Preview'),
                'class' => 'action-secondary preview',
                // 'on_click' => "confirmSetLocation('Are you sure', '{$productUrl}')",
                'on_click' => 'window.open( \'' . $productUrl . '\')',
                'sort_order' => 10
            ];
        }
    }

}