<?php namespace Tests\Repositories;

use App\Models\Independent;
use App\Repositories\IndependentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class IndependentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var IndependentRepository
     */
    protected $independentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->independentRepo = \App::make(IndependentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_independent()
    {
        $independent = factory(Independent::class)->make()->toArray();

        $createdIndependent = $this->independentRepo->create($independent);

        $createdIndependent = $createdIndependent->toArray();
        $this->assertArrayHasKey('id', $createdIndependent);
        $this->assertNotNull($createdIndependent['id'], 'Created Independent must have id specified');
        $this->assertNotNull(Independent::find($createdIndependent['id']), 'Independent with given id must be in DB');
        $this->assertModelData($independent, $createdIndependent);
    }

    /**
     * @test read
     */
    public function test_read_independent()
    {
        $independent = factory(Independent::class)->create();

        $dbIndependent = $this->independentRepo->find($independent->id);

        $dbIndependent = $dbIndependent->toArray();
        $this->assertModelData($independent->toArray(), $dbIndependent);
    }

    /**
     * @test update
     */
    public function test_update_independent()
    {
        $independent = factory(Independent::class)->create();
        $fakeIndependent = factory(Independent::class)->make()->toArray();

        $updatedIndependent = $this->independentRepo->update($fakeIndependent, $independent->id);

        $this->assertModelData($fakeIndependent, $updatedIndependent->toArray());
        $dbIndependent = $this->independentRepo->find($independent->id);
        $this->assertModelData($fakeIndependent, $dbIndependent->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_independent()
    {
        $independent = factory(Independent::class)->create();

        $resp = $this->independentRepo->delete($independent->id);

        $this->assertTrue($resp);
        $this->assertNull(Independent::find($independent->id), 'Independent should not exist in DB');
    }
}
