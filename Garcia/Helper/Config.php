<?php

namespace Hiberus\Garcia\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Config
 * @package Hiberus\Garcia\Helper
 */
class Config extends AbstractHelper
{
    const   XML_PATH_EXAMNUMBER =   'hiberus_garcia/general_config/examnumber';
    const   XML_PATH_CUTMARK =   'hiberus_garcia/general_config/cutmark';

    /**
     * @return mixed
     */
    public function getExamNumber()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_EXAMNUMBER
        );
    }

    /**
     * @return mixed
     */
    public function getCutMark()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_CUTMARK
        );
    }
}
