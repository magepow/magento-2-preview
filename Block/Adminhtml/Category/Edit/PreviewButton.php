<?php

namespace Magepow\Preview\Block\Adminhtml\Category\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Catalog\Block\Adminhtml\Category\AbstractCategory;

/**
 * Class PreviewButton
 */
class PreviewButton extends AbstractCategory implements ButtonProviderInterface
{
    /**
     * Clear Cache button
     *
     * @return array
     */
    public function getButtonData()
    {
        $category = $this->getCategory();
        $categoryId = (int)$category->getId();
        if ($categoryId && $category->getLevel() > 1) {

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

        return [];
    }
}