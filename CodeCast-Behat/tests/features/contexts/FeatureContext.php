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

    /**
     * @Given there is no codecasts available
     */
    public function thereIsNoCodecastsAvailable()
    {
        Application::$codeCastGateway->clearCodeCasts();
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
        PHPUnit\Framework\Assert::assertSame(intval($count), sizeof($this->presenter->getViewModel()->toArray()));
    } 

    /**
     * @Given there are codecasts:
     */
    public function thereAreCodecasts(TableNode $table)
    {
        foreach ($table as $row) {
            Application::$codeCastGateway->save(new CodeCast($row['title'], new DateTime($row['publicationDate'])));
        }
    }

    /**
     * @Given there is a :type licence for :username to view :title
     */
    public function thereIsALicenceForToView($type, $username, $title)
    {
        $user = Application::$userGateway->findUser($username);
        $codeCast = Application::$codeCastGateway->findCodeCastByTitle($title);
        Application::$licenceGateway->save(new Licence(Licence::VIEWABLE, $user, $codeCast));
    }

    /**
     * @Then the codecasts summaries will be:
     */
    public function theCodecastsSummariesWillBe(TableNode $table)
    {
        $viewModel = $this->presenter->getViewModel();

        PHPUnit\Framework\Assert::assertArraySubset($table->getHash(), $viewModel->toArray());
    }    
}
