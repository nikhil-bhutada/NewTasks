<?php

namespace TrainingNikhil\CustomField\Model\Source;

class Customdropdown extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource 
{
    public function getAllOptions() 
    {
        $type = [];
        $type[] = [
                'value' => '',
                'label' => '--Select--'
            ];
        $type[] = [
                'value' => 'married',
                'label' => 'Married'
            ];
        $type[] = [
                'value' => 'unmarried',
                'label' => 'UnMarried'
            ];
        return $type;
    }
    
    public function getOptionText($value) 
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return false;
    }
}