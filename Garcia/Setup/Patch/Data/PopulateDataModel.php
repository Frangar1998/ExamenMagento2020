<?php

namespace Hiberus\Garcia\Setup\Patch\Data;

use Hiberus\Garcia\Api\Data\ExamInterface;
use Hiberus\Garcia\Api\Data\ExamInterfaceFactory;
use Hiberus\Garcia\Api\ExamRepositoryInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\HTTP\Client\CurlFactory;
use Magento\Framework\File\Csv;

/**
 * Class PopulateDataModel
 * @package Hiberus\Garcia\Setup\Patch\Data
 */
class PopulateDataModel implements DataPatchInterface
{
    const   DATA =   'app/code/Hiberus/Garcia/Setup/data/import.csv';

    /**
     * @var ExamRepositoryInterface
     */
    private $examRepository;

    /**
     * @var ExamInterfaceFactory
     */
    private $examFactory;

    /**
     * @var Csv
     */
    private $csv;

    /**
     * PopulateDataModel constructor.
     * @param ExamRepositoryInterface $examRepository
     * @param ExamInterfaceFactory $examFactory
     * @param Csv $csv
     */
    public function __construct(
        ExamRepositoryInterface $examRepository,
        ExamInterfaceFactory $examFactory,
        Csv $csv
    ) {
        $this->examRepository = $examRepository;
        $this->examFactory = $examFactory;
        $this->csv = $csv;
    }

    /**
     * @return DataPatchInterface|void
     */
    public function apply()
    {
        $this->populateData();
    }

    /**
     * Populate Data Model
     */
    private function populateData()
    {
        $this->populateExams();
    }

    /**
     * Populate Exams Data
     */
    private function populateExams()
    {
        $data = $this->csv->getData(self::DATA);
        foreach ($data as $name) {
            /** @var ExamInterface $exam */
            $exam = $this->examFactory->create();
            
            $exam->setFirstname($name[0])
                 ->setLastname($name[1])
                 ->setMark(mt_rand(0,10*100)/100);

            $this->examRepository->save($exam);
        }
    }

    /**
     * @return string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return string[]
     */
    public function getAliases()
    {
        return [];
    }
}
