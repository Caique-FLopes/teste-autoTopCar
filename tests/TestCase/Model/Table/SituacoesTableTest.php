<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SituacoesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SituacoesTable Test Case
 */
class SituacoesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SituacoesTable
     */
    public $Situacoes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Situacoes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Situacoes') ? [] : ['className' => SituacoesTable::class];
        $this->Situacoes = TableRegistry::getTableLocator()->get('Situacoes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Situacoes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
