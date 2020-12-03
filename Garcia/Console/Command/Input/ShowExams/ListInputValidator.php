<?php

namespace Hiberus\Garcia\Console\Command\Input\ShowExams;

use Symfony\Component\Console\Input\InputInterface;

/**
 * Class ListInputValidator
 * @package Hiberus\Garcia\Console\Command\Input\ShowExams
 */
class ListInputValidator
{
    /**
     * Validate input options
     *
     * @param InputInterface $input
     * @return InputInterface
     */
    public function validate(InputInterface $input)
    {
        return $input;
    }
}
