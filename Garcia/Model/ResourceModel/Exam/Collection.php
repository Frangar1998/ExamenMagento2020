<?php

namespace Hiberus\Garcia\Model\ResourceModel\Exam;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Hiberus\Garcia\Model;

/**
 * Class Collection
 * @package Hiberus\Garcia\Model\ResourceModel\Exam
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model\Exam::class, Model\ResourceModel\Exam::class);
    }
}
