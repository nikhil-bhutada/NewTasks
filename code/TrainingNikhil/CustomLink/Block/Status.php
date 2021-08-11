<?php

namespace TrainingNikhil\CustomLink\Block;

class Status extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    protected $resource;
    protected $order;
    protected $session;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Customer\Model\Session $session,
        \Magento\Sales\Model\Order $order,
        array $data = []
    )
    {
        $this->resource = $resource;
        $this->session = $session;
        $this->order = $order;
        parent::__construct($context, $data);
    }
protected function _prepareLayout()
{

    parent::_prepareLayout();
    $this->pageConfig->getTitle()->set(__('Completed Orders'));

    if ($this->getOrders()) {
        $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'complete.history.pager'
        )->setAvailableLimit(array(5=>5,10=>10,15=>15,20=>20))
            ->setShowPerPage(true)->setCollection(
            $this->getOrders()
        );
        $this->setChild('pager', $pager);
        $this->getOrders()->load();
    }
    return $this;
}

public function getPagerHtml()
{
    return $this->getChildHtml('pager');
}
    /**
     * Get form action URL for POST booking request
     *
     * @return string
     */
    public function getOrders()
    {

        //get values of current page
    $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
    //get values of current limit
    $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest
    ()->getParam('limit') : 5;

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
$connection = $resource->getConnection();
$customerSession = $objectManager->create('Magento\Customer\Model\Session');
if ($customerSession->isLoggedIn()) {
    $customer_id = $customerSession->getCustomer()->getId();
    $order_collection = $objectManager->create('Magento\Sales\Model\Order')->getCollection()->addAttributeToFilter('customer_id', $customer_id)->addAttributeToFilter('status', 'complete');
     $order_collection->setPageSize($pageSize);
    $order_collection->setCurPage($page);
    return $order_collection;
}
else
{
    return false;
}

// $connection =$this->resource->getConnection();
// if ($this->session->isLoggedIn()) {
//     $customer_id = $this->session->getCustomer()->getId();
//     $order_collection = $this->order->getCollection()->addAttributeToFilter('customer_id', $customer_id)->addAttributeToFilter('status', 'complete');
//     }
}
}