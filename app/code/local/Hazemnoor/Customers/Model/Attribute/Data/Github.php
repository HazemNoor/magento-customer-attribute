<?php
/**
 * Github URL Attribute Data Model
 *
 * @category    Hazemnoor
 * @package     Hazemnoor_Customers
 * @author      Hazem Noor <hazemnoor@gmail.com>
 */
class Hazemnoor_Customers_Model_Attribute_Data_Github extends Mage_Customer_Model_Attribute_Data_Text
{
    /**
     * Validate Github URL
     * Return true and skip validation if Github URL is valid
     *
     * @param array|string $value
     *
     * @return array|bool
     * @throws Mage_Core_Exception
     * @throws Varien_Exception
     */
    public function validateValue($value)
    {
        $errors     = array();
        $attribute  = $this->getAttribute();
        $label      = Mage::helper('eav')->__($attribute->getStoreLabel());

        // Check if unique
        if ( $attribute->getIsUnique() ) {
            $collection = Mage::getModel( 'customer/customer' )->getCollection();
            $collection->addAttributeToFilter( $attribute->getAttributeCode(), $value );
            $collection->addFieldToFilter( 'entity_id', array( 'neq' => $this->getEntity()->getId() ) );

            if ( $collection->getSize() ) {
                $errors[] = Mage::helper('hazemnoor_cusromers')->__(sprintf( 'The value %s for %s is already used', $value, $label ));
            }
        }

        $result = parent::validateValue($value);

        if ($result !== true) {
            $errors = array_merge($errors, $result);
        }

        if (count($errors) == 0) {
            return true;
        }

        return $errors;
    }
}
