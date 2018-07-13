<?php
$installer = $this;
$installer->startSetup();

$installer->addAttribute( "customer", "github_url", [
    "type"  => "varchar",
    "input" => "text",
    "label" => "Github URL",
    "data"  => "hazemnoor_cusromers/attribute_data_github",

    "validate_rules" => serialize( [
        'max_text_length'  => 200,
        'input_validation' => 'url',
    ] ),

    "visible"  => true,
    "required" => false,
    "unique"   => true,
    "note"     => "Ex: https://github.com/hazemnoor"
] );

$attribute = Mage::getSingleton( "eav/config" )->getAttribute( "customer", "github_url" );

$used_in_forms = [
    "adminhtml_customer",
    "checkout_register",
    "customer_account_create",
    "customer_account_edit",
    "adminhtml_checkout"
];

$attribute
    ->setData( "used_in_forms", $used_in_forms )
    ->setData( "is_used_for_customer_segment", true )
    ->setData( "is_system", 0 )
    ->setData( "is_user_defined", 1 )
    ->setData( "is_visible", 1 )
    ->setData( "sort_order", 100 );

$attribute->save();


$installer->endSetup();
