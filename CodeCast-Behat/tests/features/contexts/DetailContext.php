<?php 

use CodeCast\Licence;
use CodeCast\CodeCast;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Gherkin\Node\PyStringNode;
use CodeCast\{Application, GateKeeper, User};
use CodeCast\UseCases\CodeCastDetail\CodeCastDetailUseCase;
use CodeCast\UseCases\CodeCastDetail\CodeCastDetailPresenter;

/**
 * Defines application features from the specific context.
 */
class DetailContext implements Context
{
    protected $useCase;

    public function __construct()
    {
        FeatureSetUp::setUp();
        $this->useCase = new CodeCastDetailUseCase;
        $this->presenter = new CodeCastDetailPresenter;
    }

    /**
     * @Given set permalink :permalink for :title
     */
    public function setPermalinkFor($permalink, $title)
    {
        $codeCast = Application::$codeCastGateway->findCodeCastByTitle($title);
        $codeCast->setPermalink($permalink);
    }

    /**
     * @When :user visit (the) codeCast detail by :permalink
     */
    public function visitTheCodecastDetailBy($user, $permalink)
    {
        $this->useCase->requestDetailByPermalink($permalink, $user, $this->presenter);
    }

    /**
     * @Then user will see codecast detail:
     */
    public function userWillSeeCodecastDetail(TableNode $table)
    {
        $viewModel = $this->presenter->getViewModel();

        PHPUnit\Framework\Assert::assertArraySubset($table->getHash()[0], $viewModel->toArray());
    } 

}