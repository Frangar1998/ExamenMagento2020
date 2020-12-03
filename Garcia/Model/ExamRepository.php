<?php

namespace Hiberus\Garcia\Model;

use Hiberus\Garcia\Api\Data\ExamInterfaceFactory;
use Hiberus\Garcia\Api\Data\ExamSearchResultsInterface;
use Hiberus\Garcia\Model\ResourceModel\Exam\Collection;
use Hiberus\Garcia\Model\ResourceModel\Exam\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Hiberus\Garcia\Api\Data;
use Hiberus\Garcia\Api\ExamRepositoryInterface;
use Hiberus\Garcia\Model\ResourceModel;

/**
 * Class ExamRepository
 * @package Hiberus\Garcia\Model
 */
class ExamRepository implements ExamRepositoryInterface
{
    /**
     * @var \Hiberus\Garcia\Model\ResourceModel\Exam
     */
    private $resourceExam;

    /**
     * @var ExamInterfaceFactory
     */
    private $examFactory;

    /**
     * @var CollectionFactory
     */
    private $examCollectionFactory;

    /**
     * @var Data\ExamSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param \Hiberus\Garcia\Model\ResourceModel\Exam $resourceExam
     * @param ExamInterfaceFactory $examFactory
     * @param CollectionFactory $examCollectionFactory
     * @param Data\ExamSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    function __construct(
        ResourceModel\Exam $resourceExam,
        ExamInterfaceFactory $examFactory,
        CollectionFactory $examCollectionFactory,
        Data\ExamSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resourceExam = $resourceExam;
        $this->examFactory = $examFactory;
        $this->examCollectionFactory = $examCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param \Hiberus\Garcia\Api\Data\ExamInterface $exam
     * @return \Hiberus\Garcia\Api\Data\ExamInterface
     * @throws CouldNotSaveException
     */
    public function save(\Hiberus\Garcia\Api\Data\ExamInterface $exam)
    {
        try {
            $this->resourceExam->save($exam);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $exam;
    }

    /**
     * @param int $examId
     * @return Data\ExamInterface
     * @throws NoSuchEntityException
     */
    public function getById($examId)
    {
        $exam = $this->examFactory->create();
        $this->resourceExam->load($exam, $examId);
        if (!$exam->getId()) {
            throw new NoSuchEntityException(__('Exam with id "%1" does not exist', $examId));
        }
        return $exam;
    }

    /**
     * @param \Hiberus\Garcia\Api\Data\ExamInterface $exam
     * @return \Hiberus\Garcia\Api\Data\ExamInterface
     * @throws CouldNotSaveException
     */
    public function delete(\Hiberus\Garcia\Api\Data\ExamInterface $exam)
    {
        try {
            $this->resourceExam->delete($exam);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $exam;
    }

    /**
     * @param int $examId
     * @return \Hiberus\Garcia\Api\Data\ExamInterface
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function deleteById($examId)
    {
        return $this->delete($this->getById($examId));
    }

    /**
     * Retrieve exams matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return ExamSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->examCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var Data\ExamSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
