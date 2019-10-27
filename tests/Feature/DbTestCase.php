<?php
namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use Tests\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class DbTestCase extends BaseTestCase
{
    use DatabaseTransactions;

    public function testEmpty()
    {
        $this->assertTrue(true);
    }

    public function testDatabase()
    {
        // Make call to application...
        // $this->assertDatabaseHas('users', [
        //     'email' => 'sally@example.com',
        // ]);

        $users = DB::select('select * from dnsRecords');

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
          );


    }
}
