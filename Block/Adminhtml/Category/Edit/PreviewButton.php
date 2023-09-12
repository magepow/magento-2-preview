<?php

namespace Magepow\Preview\Block\Adminhtml\Category\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Catalog\Block\Adminhtml\Category\AbstractCategory;

/**
 * Class PreviewButton
 */
class PreviewButton extends AbstractCategory implements ButtonProviderInterface
{

    private function disablePreview()
    {
        return !$this->getCategory()->getIsActive()
            || !$this->getCategory()->getLevel() > 1;
    }

    /**
     * Clear Cache button
     *
     * @return array
     */
    public function getButtonData()
    {
        if ($this->disablePreview()) {
            return [];
        }
        $category = $this->getCategory();
        $categoryId = (int)$category->getId();
        $storeId     = (int)$this->getRequest()->getParam('store');
        if ($storeId) {
            $url      = $category->getUrlInstance();
            $storeUrl = $url->getUrl(Null, ['_scope' => $storeId]);
            $storeUrl = explode('/', $storeUrl);
            $categoryUrl = $category->getUrl();
            $categoryUrl = explode('/', $categoryUrl);
            $categoryUrl = array_unique(array_merge($storeUrl, $categoryUrl));
            $categoryUrl = implode('/', $categoryUrl);
        } else {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $storeManager = $objectManager->get(\Magento\Store\Model\StoreManagerInterface::class);
            $storeId = $storeManager->getDefaultStoreView()->getId();
            $category->setStoreId($storeId);
            $categoryUrl = $category->getUrl();
        }

        return [
            'label' => __('Preview'),
            'class' => 'action-secondary preview',
            // 'on_click' => "confirmSetLocation('Are you sure', '{$categoryUrl}')",
            'on_click' => 'window.open( \'' . $categoryUrl . '\')',
            'sort_order' => 10
        ];
    }
}