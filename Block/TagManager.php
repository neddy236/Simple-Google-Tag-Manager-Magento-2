<?php
# @Author: Vasilis Neris
# @see: https://github.com/neddy236/Simple-Google-Tag-Manager-Magento-2



namespace Skytech\GoogleTagManager\Block;

class TagManager extends \Magento\Framework\View\Element\Template {


   protected $scopeConfig;
   protected $_product = null;
   protected $_registry;
   protected $_productFactory;
   protected $_checkoutSession;
   protected $_storeManager;


	public function __construct(
      \Magento\Framework\View\Element\Template\Context $context,
      \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
      \Magento\Framework\Registry $registry,
      \Magento\Catalog\Model\ProductFactory $productFactory,
      \Magento\Checkout\Model\Session $checkoutSession,
      \Magento\Store\Model\StoreManagerInterface $storeManager,
      array $data = []
      )
     {
      $this->_scopeConfig = $scopeConfig;
      $this->_registry = $registry;
      $this->_productFactory = $productFactory;
      $this->_checkoutSession = $checkoutSession;
      $this->_storeManager = $storeManager;
      parent::__construct($context,$data);
     }


     public function getStoreConfig($data)
	  {
		return $this->_scopeConfig->getValue($data, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
     }
     
     public function getCurrentProduct()
     {       
        return $this->_registry->registry('current_product');
     }

     public function getOrder()
	  {
		$order = $this->_checkoutSession->getLastRealOrder();
		return $order;
     }

     public function getOrderId()
     {
        return $this->getOrder()->getIncrementId();
     }

     public function getGrandTotal()
     {
        return $this->getOrder()->getGrandTotal();
     }

     public function getOrderItems()
     {
        /** @Magento/Sales/Model/Order/Items */
        return $this->getOrder()->getAllItems();
     }

     public function getCurrencyCode() {
       return $this->_storeManager->getStore()->getCurrentCurrency()->getCode();
     }
}