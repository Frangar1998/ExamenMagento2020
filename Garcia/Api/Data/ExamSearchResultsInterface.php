<?php

namespace Hiberus\Garcia\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ExamSearchResultsInterface
 * @package Hiberus\Garcia\Api\Data
 */
interface ExamSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get exam list.
     *
     * @return \Hiberus\Garcia\Api\Data\ExamInterface[]
     */
    public function getItems();

    /**
     * Set exam list.
     *
     * @param \Hiberus\Garcia\Api\Data\ExamInterface[] $items
     * @return \Hiberus\Garcia\Api\Data\ExamSearchResultsInterface
     */
    public function setItems(array $items);
}
