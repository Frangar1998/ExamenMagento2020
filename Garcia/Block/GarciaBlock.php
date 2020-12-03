<?php

namespace Hiberus\Garcia\Block;

class GarciaBlock extends \Magento\Framework\View\Element\Template {

    protected $_template = 'Hiberus_Garcia::examlist.phtml';

    protected $_examRepository;
    protected $_searchCriteriaBuilder;
    protected $_sortOrderBuilder;
    protected $logger;
    protected $helper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Hiberus\Garcia\Api\ExamRepositoryInterface $examRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder,
        \Psr\Log\LoggerInterface $logger,
        \Hiberus\Garcia\Helper\Config $helper,
        array $data=[]
        ){
            $this->_examRepository = $examRepository;
            $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
            $this->_sortOrderBuilder = $sortOrderBuilder;
            $this->logger = $logger;
            $this->helper = $helper;
            parent::__construct($context, $data);
    }

    public function getExams(){
        $numberexams = intval($this->helper->getExamNumber());
        if($numberexams == 0){
            $this->logger->debug('Numero de examenes: '.$this->getNumberOfStudents().' - Nota media: '.$this->getMarksAverage());
            return $this->_examRepository->getList($this->_searchCriteriaBuilder
                ->addSortOrder($this->_sortOrderBuilder->setField('mark')->setDirection('DESC')->create())
                ->create())->getItems();
        }
        $this->logger->debug('Numero de examenes: '.$this->getNumberOfStudents().' - Nota media: '.$this->getMarksAverage());
        return $this->_examRepository->getList($this->_searchCriteriaBuilder
        ->addSortOrder($this->_sortOrderBuilder->setField('mark')->setDirection('DESC')->create())
        ->setPageSize($numberexams)
        ->create())->getItems();
    }

    public function getNumberOfStudents(){
        return count($this->_examRepository->getList($this->_searchCriteriaBuilder->create())->getItems());
    }

    public function getMaxMark(){
        $exams = $this->_examRepository->getList($this->_searchCriteriaBuilder->create())->getItems();
        $max = 0;
        foreach ($exams as $exam) {
            if ($exam->getMark() > $max) {
                $max = $exam->getMark();
            }
        }
        return $max;
    }

    public function getMarksAverage(){
        $exams = $this->_examRepository->getList($this->_searchCriteriaBuilder->create())->getItems();
        $sum = 0;
        foreach ($exams as $exam) {
            $sum += $exam->getMark();
        }
        return $sum/count($exams);
    }

    public function getColor($exam){
        $cutmark = intval($this->helper->getCutMark());
        return $exam->getMark() < $cutmark?'red':'green';
    }
}
