<?php

namespace Hiberus\Garcia\Plugin;

use Hiberus\Garcia\Api\Data\ExamInterface;
use Hiberus\Garcia\Api\Data\ExamSearchResultsInterface;
use Hiberus\Garcia\Api\ExamRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class PluginMark
 * @package Hiberus\Garcia\Plugin
 */
class PluginMark
{
    /**
     * @param ExamRepositoryInterface $subject
     * @param ExamSearchResultsInterface $result
     * @return array
     */
    public function afterGetList(
        ExamRepositoryInterface $subject,
        $result
    ) {
        foreach ($result->getItems() as $exam) {
            if ($exam->getMark() < 5) {
                $exam->setMark(4.9);
            }
        }
        return $result;
    }

}
