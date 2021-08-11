<?php

namespace TrainingNikhil\CustomField\Model\Source;

class Customdropdownchildren extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource 
{
    public function getAllOptions() 
    {
        $type = [];
        $type[] = [
                'value' => '',
                'label' => '--Select--'
            ];
        $type[] = [
                'value' => 1,
                'label' => '1'
            ];
        $type[] = [
                'value' => 2,
                'label' => '2'
            ];
            $type[] = [
                'value' => 3,
                'label' => '3'
            ];
            $type[] = [
                'value' => 4,
                'label' => '4'
            ];
            $type[] = [
                'value' => 5,
                'label' => '5'
            ];
            $type[] = [
                'value' => 6,
                'label' => '6'
            ];
            $type[] = [
                'value' => 7,
                'label' => '7'
            ];
            $type[] = [
                'value' => 8,
                'label' => '8'
            ];
            $type[] = [
                'value' => 9,
                'label' => '9'
            ];
            $type[] = [
                'value' => 10,
                'label' => '10'
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