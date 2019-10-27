<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DomainSearcher;
use App\Http\Requests\DomainSearchRequest;

class DomainSearchController extends Controller
{
    //
    public function getDomainRecords(DomainSearchRequest $request){

        $domainSearch = new DomainSearcher($request['domainList']);
        // dd(array_values($request['domainList']));
        $dnsRecords = $domainSearch->getDomainRecords($request['domainList']);

        return $dnsRecords;
    }
}
