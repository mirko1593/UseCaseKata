<?php

use CodeCast\Licence;
use CodeCast\CodeCast;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Gherkin\Node\PyStringNode;
use CodeCast\{Application, GateKeeper, User};
use CodeCast\UseCases\CodeCastSummaries\CodeCastSummariesUseCase;
use CodeCast\UseCases\CodeCastSummaries\CodeCastSummariesPresenter;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    protected $useCase;

    public function __construct()
    {
        FeatureSetUp::setUp();
        $this->useCase = new CodeCastSummariesUseCase;
        $this->presenter = new CodeCastSummariesPresenter;
    }
}