<?php

namespace Hiberus\Garcia\Model;

use Hiberus\Garcia\Api\Data\ExamInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Exam
 * @package Hiberus\Garcia\Model
 */
class Exam extends AbstractModel implements ExamInterface
{

    protected function _construct()
    {
        $this->_init(\Hiberus\Garcia\Model\ResourceModel\Exam::class);
    }

    /**
     * @return int|mixed
     */
    public function getId()
    {
        return $this->_getData(self::ID);
    }

    /**
     * @return mixed|string
     */
    public function getFirstname()
    {
        return $this->_getData(self::FIRSTNAME);
    }

    /**
     * @return mixed|string
     */
    public function getLastname()
    {
        return $this->_getData(self::LASTNAME);
    }

    /**
     * @return float
     */
    public function getMark()
    {
        return $this->_getData(self::MARK);
    }

    /**
     * @param int|mixed $id
     * @return ExamInterface|Exam|AbstractModel
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @param string $firstname
     * @return ExamInterface|Exam
     */
    public function setFirstname($firstname)
    {
        return $this->setData(self::FIRSTNAME, $firstname);
    }

    /**
     * @param string $lastname
     * @return ExamInterface|Exam
     */
    public function setLastname($lastname)
    {
        return $this->setData(self::LASTNAME, $lastname);
    }

    /**
     * @param float $mark
     * @return ExamInterface|Exam
     */
    public function setMark($mark)
    {
        return $this->setData(self::MARK, $mark);
    }
}
