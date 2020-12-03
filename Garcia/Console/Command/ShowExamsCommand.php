<?php

namespace Hiberus\Garcia\Console\Command;

use Hiberus\Garcia\Api\Data\ExamInterface;
use Hiberus\Garcia\Api\ExamRepositoryInterface;
use Hiberus\Garcia\Console\Command\Input\ShowExams\ListInputValidator;
use Hiberus\Garcia\Console\Command\Options\ShowExams\ListOptions;
use Hiberus\Garcia\Helper\Config;
use Hiberus\Garcia\Helper\FastLoading;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Console\Cli;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

/**
 * Class ShowExamsCommand
 * @package Hiberus\Garcia\Console\Command
 */
class ShowExamsCommand extends Command
{
    const   DETAIL_TAG  =   'detail';

    /**
     * @var ListInputValidator
     */
    protected $validator;

    /**
     * @var ListOptions
     */
    protected $listOptions;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var ExamRepositoryInterface
     */
    private $examRepository;

    /**
     * @var Config
     */
    private $config;

    /**
     * ShowExamsCommand constructor.
     * @param ListInputValidator $validator
     * @param ListOptions $listOptions
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param ExamRepositoryInterface $examRepository
     * @param Config $config
     * @param string|null $name
     */
    public function __construct(
        ListInputValidator $validator,
        ListOptions $listOptions,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ExamRepositoryInterface $examRepository,
        Config $config,
        string $name = null
    ) {
        $this->validator = $validator;
        $this->listOptions = $listOptions;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->examRepository = $examRepository;
        $this->config = $config;

        parent::__construct($name);
    }

    /**
     * Configure
     */
    protected function configure()
    {
        $this->setName('hiberus:garcia')
            ->setDescription('Show Exams List')
            ->setDefinition($this->listOptions->getOptionsList());

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws LocalizedException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $time = microtime(true);

        if($this->config->isEnabled()) {
            $this->initFormatter($output);

            $this->process($input, $output);

            $output->writeln('Execution time: ' . (microtime(true) - $time));
        }

        return Cli::RETURN_SUCCESS;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    private function process(InputInterface $input, OutputInterface $output)
    {
        $this->validator->validate($input);

        /** @var ExamInterface $exam */
        foreach ($this->getExamList() as $exam) {
            $output->writeln(
                sprintf(
                    "<%s> >> Name: %s - Mark: %s <%s>",
                    self::DETAIL_TAG,
                    $exam->getFirstname().' '.$exam->getLastname(),
                    $exam->getMark(),
                    self::DETAIL_TAG
                )
            );
        }

    }

    /**
     * @return ExamtInterface[]
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    private function getExamList()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $examResults = $this->examRepository->getList($searchCriteria);

        if (empty($examResults)) {
            throw new NoSuchEntityException(
                __('No exams found.')
            );
        }

        return $examResults;
    }

    /**
     * @param OutputInterface $output
     */
    private function initFormatter(OutputInterface $output)
    {
        /** @var OutputFormatterInterface $outputFormatter */
        $outputFormatter = $output->getFormatter();
        $outputFormatter->setStyle(self::DETAIL_TAG, new OutputFormatterStyle('yellow'));
    }
}
