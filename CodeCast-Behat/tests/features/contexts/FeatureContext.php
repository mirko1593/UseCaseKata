<?php

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

    public function __construct($codecastGateway = null, $userGateway = null, $gatekeeper = null)
    {
        Application::$codecastGateway = $codecastGateway ?? new InMemoryCodeCastGateway;
        Application::$userGateway = $userGateway ?? new InMemoryUserGateway;
        Application::$gateKeeper = $gateKeeper ?? new GateKeeper;
        $this->useCase = new CodeCastSummariesUseCase;
        $this->presenter = new CodeCastSummariesPresenter;
    }

    /**
     * @Given there is no codecasts available
     */
    public function thereIsNoCodecastsAvailable()
    {
        Application::$codecastGateway->clearCodeCasts();
    }

    /**
     * @Given there is a user :username
     */
    public function thereIsAUser($username)
    {
        Application::$userGateway->save(new User($username));
    }

    /**
     * @When :username log in
     */
    public function logIn($username)
    {
        $user = Application::$userGateway->findUser($username);
        Application::$gateKeeper->setLoggedInUser($user);
    }

    /**
     * @When view the codecasts summaries
     */
    public function viewTheCodecastsSummaries()
    {
        $this->useCase->summarizeCodeCasts(Application::$gateKeeper->getLoggedInUser(), $this->presenter);
    }    

    /**
     * @Then there will be :count codecasts summaries
     */
    public function thereWillBeCodecastsSummaries($count)
    {
        PHPUnit\Framework\Assert::assertCount(intval($count), $this->presenter->getViewModel());
    } 
}
