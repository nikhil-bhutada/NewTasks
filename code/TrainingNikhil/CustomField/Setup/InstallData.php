<?php

namespace TrainingNikhil\CustomField\Setup;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface 
{
    private $eavSetupFactory;

    public function __construct(
        EavSetupFactory $eavSetupFactory,
        Config $eavConfig
    ) 
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) 
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        // Dropdown Field
        $eavSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'relationship', [
            'label' => 'Relationship',
            'system' => 0,
            'position' => 710,
            'sort_order' => 710,
            'visible' => true,
            'note' => '',
            'type' => 'text',
            'input' => 'select',
            'source' => 'TrainingNikhil\CustomField\Model\Source\Customdropdown',
            ]
        );

        $this->getEavConfig()->getAttribute('customer', 'relationship')->setData('is_user_defined', 1)->setData('is_required', 0)->setData('default_value', '')->setData('used_in_forms', ['adminhtml_customer', 'checkout_register', 'customer_account_create', 'customer_account_edit', 'adminhtml_checkout'])->save();



 // Dropdown Field
        $eavSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'child', [
            'label' => 'Childrens',
            'system' => 0,
            'position' => 700,
            'sort_order' => 700,
            'visible' => true,
            'note' => '',
            'type' => 'int',
            'input' => 'select',
            'source' => 'TrainingNikhil\CustomField\Model\Source\Customdropdownchildren',
            ]
        );

        $this->getEavConfig()->getAttribute('customer', 'child')->setData('is_user_defined', 1)->setData('is_required', 0)->setData('default_value', '')->setData('used_in_forms', ['adminhtml_customer', 'checkout_register', 'customer_account_create', 'customer_account_edit', 'adminhtml_checkout'])->save();
        
    }
    
    public function getEavConfig() {
        return $this->eavConfig;
    }
}