<?php

namespace Rakeshmagento\FeaturedCategory\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

class FeaturedCategoryWidget extends Template implements BlockInterface
{

    protected $_template = "widget/featuredcategorywidget.phtml";

    protected $categoryRepository;
    protected $_categoryCollectionFactory;
    protected $_categoryRepository;
    protected $_storeManager;

    public function __construct(
    		Context $context, 
    		StoreManagerInterface $storeManager, 
    		CollectionFactory $categoryCollectionFactory,
    		\Magento\Catalog\Model\CategoryRepository $categoryRepository
    	)
    {
 
        $this->_storeManager = $storeManager;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_categoryRepository = $categoryRepository;
        parent::__construct($context);
    }

    /**
     * Get value of widgets' id_path parameter
     *
     * @return mixed|string
     */
    private function getParentCategoryId()
    {
        return str_replace('category/','',$this->getData('id_path'));
    }

    public function getCategoryName(){
    	return 
    		$this->_categoryRepository->get(
    							$this->getParentCategoryId()
    						)->getName();
    }


    /**
     * Get value of widgets' id_path parameter
     *
     * @return mixed|string
     */
    private function getTopContent()
    {
        return $this->getData('top_content');
    }

    /**
     * Get value of widgets' id_path parameter
     *
     * @return mixed|string
     */
    private function getCategoryCount()
    {
        return $this->getData('category_count');
    }

    /**
     * Get value of widgets' image_height parameter
     *
     * @return mixed|string
    */
    public function getThumbnailHeight()
    {
        return $this->getData('image_height');
    }
    
    /**
     * Get value of widgets' image_height parameter
     *
     * @return mixed|string
    */
    public function getThumbnailWidth()
    {
        return $this->getData('image_width');
    }

    /**
     *  Get the category collection based on the ids
     *
     * @return array
     */
    public function getCategoryCollection()
    {
        $category = $this->_categoryRepository->get(
    							$this->getParentCategoryId()
    						);
        return $category->getChildrenCategories();

    }
}