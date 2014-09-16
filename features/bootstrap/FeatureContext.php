<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use Acme\EntityRepository;
use Acme\ShowEntityNameController;
use Acme\Entity;

/**
 * Behat context class.
 */
class FeatureContext implements SnippetAcceptingContext
{
    /**
     * @var EntityRepository
     */
    private $entityRepository;

    /**
     * @var ShowEntityNameController
     */
    private $controller;

    /**
     * @var mixed
     */
    private $result;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context object.
     * You can also pass arbitrary arguments to the context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->entityRepository = new EntityRepository();
        $this->controller = new ShowEntityNameController($this->entityRepository);
    }

    /**
     * @Given there is an entity with this information:
     */
    public function thereIsAnEntityWithThisInformation(TableNode $info)
    {
        $info = $info->getRowsHash();

        $entity = new Entity();
        $entity->setId((int) $info['Id']);
        $entity->setName($info['Name']);

        $this->entityRepository->save($entity);
    }

    /**
     * @When I request the name for the entity :entityId
     */
    public function iRequestTheNameForTheEntity($entityId)
    {
        try {
            $this->result = $this->controller->showEntityNameAction((int) $entityId);
        } catch (\Exception $e) {
            $this->result = $e;
        }
    }

    /**
     * @Then I should get :entityName back
     */
    public function iShouldGetBack($entityName)
    {
        if ($this->result !== $entityName) {
            $result = (string) $this->result;

            throw new \LogicException("Expected `$entityName` but got `$result` instead");
        }
    }

    /**
     * @Given the entity :entityId does not exists
     */
    public function theEntityDoesNotExists($entityId)
    {
        if ($this->entityRepository->find((int) $entityId)) {
            throw new \LogicException("Entity `$entityId` was not expected but it exists");
        }
    }

    /**
     * @Then I should get an exception
     */
    public function iShouldGetAnException()
    {
        if (!$this->result instanceof \Exception) {
            $result = (string) $this->result;

            throw new \LogicException("Expected to get an exception but got `$result` instead");
        }
    }
}
