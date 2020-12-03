<?php

namespace Hiberus\Garcia\Api\Data;

/**
 * Interface ExamInterface
 * @package Hiberus\Garcia\Api\Data
 */
interface ExamInterface
{
    const ID = 'id_exam';
    const FIRSTNAME = 'firstname';
    const LASTNAME = 'lastname';
    const MARK = 'mark';

    /**
     * Get Exam ID
     *
     * @return int
     */
    public function getId();

    /**
     * Set Exam ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get Exam Firstname
     *
     * @return string
     */
    public function getFirstname();

    /**
     * Set Exam Firstname
     *
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname);

    /**
     * Get Exam Lastname
     *
     * @return string
     */
    public function getLastname();

    /**
     * Set Exam Lastname
     *
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname);

    /**
     * Get Exam mark
     *
     * @return float
     */
    public function getMark();

    /**
     * Set Exam mark
     *
     * @param float $mark
     * @return $this
     */
    public function setMark($mark);
}
