<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InitTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIniPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // /**
    //  * A basic functional test json example.
    //  *
    //  * @return void
    //  */
    // public function testDinoRoute()
    // {
    //     $response = $this->postJson('/dino', ['name' => 'Sally']);

    //     $response
    //         //->assertStatus(201)
    //         ->assertJson([
    //             'created' => true,
    //         ]);
    // }

    /**
     * A basic functional test json example.
     *
     * @return void
     */
    public function testPostRouteExists()
    {
        $response = $this->postJson('/getDomainsRecords', [['domain' => 'chess.com']]);

        $response
            ->assertStatus(200);
    }

    /**
     * A basic functional test json example.
     *
     * @return void
     */
    public function testPostRouteReturnDomainList()
    {
        $response = $this->postJson('/getDomainsRecords',
        [
           "domains"=>[["name"=>"roravel.com"]]
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'domains' => [],
            ])
            ;
    }



}
