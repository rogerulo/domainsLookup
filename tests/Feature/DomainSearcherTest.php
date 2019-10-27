<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\DomainSearcher;


class DomainSearcherTest extends TestCase
{
    use RefreshDatabase; //reset your database after each test

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEmptyDomainList()
    {
        $domainSearcher = new DomainSearcher();
        $this->assertSame(0,count($domainSearcher->getDomainList()));
        $this->assertTrue(true);
    }

    /**
     * DomainSearcher class relies on php function dns_get_record
     *
     * @return void
     */
    public function testGetDnsRecordFunctionExists(){
        $this->assertTrue(function_exists('dns_get_record'));
    }

    /**
     * @dataProvider invalidDomainsProvider
     */
    public function testValidDomainList($domainName,$isValidDomain){
        $domainSearcher = new DomainSearcher();
        $this->assertSame($isValidDomain,$domainSearcher->isValidDomain($domainName));
    }

    /**
     *
     * Test cases...
     * see.. https://www.whogohost.com/host/knowledgebase/308/Valid-Domain-Name-Characters.html#targetText=A%20valid%20domain%20name%20character,a%20maximum%20of%2063%20characters.
     */
    public function invalidDomainsProvider(){
        return [
            ["12",false], //less than 3 characters
            [".notBeginningWithLetterOrNumber",false], //begin with a letter or a number and end with a letter or a number
            ["#numberSymbol",false], //use the English character set and may contain letters (i.e., a-z, A-Z), numbers (i.e. 0-9) and dashes (-) or a combination of these;
            ["-neverBegingNorEndWith-",false], //neither begin with nor end with a dash (-)
            ["www.ab- -cd.com",false], //not contain a dash in the third and fourth positions
            ["www.ab cd.com",false], //not include a space
            ["www.ab_cd.com",false], //not include underscore
            ["google.com",true]
        ];
    }

    /**
     *
     */
//    public function testDatabase()
//    {
//        $this->assertDatabaseHas('users', [
//            'email' => 'sally@example.com',
//        ]);
//    }

    /**
     *
     */
//    public function testgetDBEntryIfExists(){
//        $starterDomains = [
//            'domain'=>'google.com',
//            'domain'=>'chess.com',
//            'domain'=>'laravel.com'
//        ];
//
//        //newDomains contains all the starterDomains repeated
//        $newDomains = array_merge(array_values($starterDomains),["newDomain1.com","newDomain2.com"]);
//
//        DB::table('dnsRecords')->insert($starterDomains);
//
//        $domainSearcher = new DomainSearcher(array_values($newDomains));
//
//
//    }




}
