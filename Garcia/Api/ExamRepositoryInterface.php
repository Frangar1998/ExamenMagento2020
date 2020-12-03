<?php

namespace Hiberus\Garcia\Api;

use Hiberus\Garcia\Api\Data\ExamInterface;
use Hiberus\Garcia\Api\Data\ExamSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Interface ExamRepositoryInterface
 * @package Hiberus\Garcia\Api
 */
interface ExamRepositoryInterface
{
    /**
     * Save an Exam
     *
     * @param \Hiberus\Garcia\Api\Data\ExamInterface $exam
     * @return \Hiberus\Garcia\Api\Data\ExamInterface
     */
    public function save(\Hiberus\Garcia\Api\Data\ExamInterface $exam);

    /**
     * Get Exam by an Id
     *
     * @param int $examId
     * @return ExamInterface
     */
    public function getById($examId);

    /**
     * Retrieve exams matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Hiberus\Garcia\Api\Data\ExamSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete an Exam
     *
     * @param \Hiberus\Garcia\Api\Data\ExamInterface $exam
     * @return \Hiberus\Garcia\Api\Data\ExamInterface
     */
    public function delete(ExamInterface $exam);

    /**
     * Delete an Exam by an Id
     *
     * @param int $examId
     * @return \Hiberus\Garcia\Api\Data\ExamInterface
     */
    public function deleteById($examId);
}
