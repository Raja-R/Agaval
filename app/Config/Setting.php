<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Setting extends BaseConfig
{
    public $site_name = "Agaval POS";
    public $token_key = "AgavalPOSV1";
    public $encryption_ley = "AgavalPOSV1";
    public $tax_type = [['name'=>'Inclusive','value'=>'I'],['name'=>'Exclusive','value'=>'E']];
    public $discount_type = [['name'=>'Percentage(%)','value'=>'P'],['name'=>'Fixed(₹)','value'=>'F']];
}
