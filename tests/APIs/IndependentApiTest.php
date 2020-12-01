<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Independent;

class IndependentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_independent()
    {
        $independent = factory(Independent::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/independents', $independent
        );

        $this->assertApiResponse($independent);
    }

    /**
     * @test
     */
    public function test_read_independent()
    {
        $independent = factory(Independent::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/independents/'.$independent->id
        );

        $this->assertApiResponse($independent->toArray());
    }

    /**
     * @test
     */
    public function test_update_independent()
    {
        $independent = factory(Independent::class)->create();
        $editedIndependent = factory(Independent::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/independents/'.$independent->id,
            $editedIndependent
        );

        $this->assertApiResponse($editedIndependent);
    }

    /**
     * @test
     */
    public function test_delete_independent()
    {
        $independent = factory(Independent::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/independents/'.$independent->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/independents/'.$independent->id
        );

        $this->response->assertStatus(404);
    }
}
