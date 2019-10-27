<?php

namespace App;
use Illuminate\Support\Facades\DB;
class DomainSearcher
{
    protected $domainList;

    public function __construct($domainList=[])
    {
        $this->domainList = $domainList;
    }

    public function getDomainList(){
        return $this->domainList;
    }

    /*
    *
    * From .. https://gist.github.com/neo22s/8b55ee8f869b49fe8d2f
    */
    public static function isValidDomain($domainName){
        //FILTER_VALIDATE_URL checks length but..why not? so we dont move forward with more expensive operations
        $domain_len = strlen($domainName);
        if ($domain_len < 3 OR $domain_len > 253)
            return FALSE;
        //getting rid of HTTP/S just in case was passed.
        if(stripos($domainName, 'http://') === 0)
            $domainName = substr($domainName, 7);
        elseif(stripos($domainName, 'https://') === 0)
            $domainName = substr($domainName, 8);

        //we dont need the www either
        if(stripos($domainName, 'www.') === 0)
            $domainName = substr($domainName, 4);
        //Checking for a '.' at least, not in the beginning nor end, since http://.abcd. is reported valid
        if(strpos($domainName, '.') === FALSE OR $domainName[strlen($domainName)-1]=='.' OR $domainName[0]=='.')
            return FALSE;

        //now we use the FILTER_VALIDATE_URL, concatenating http so we can use it, and return BOOL
        return (filter_var ('http://' . $domainName, FILTER_VALIDATE_URL)===FALSE)? FALSE:TRUE;
    }

    public function getValidDomainList(){
        $domainList = $this->domainList;
        return array_filter($domainList,[$this,'isValidDomain']);
    }

    public function getDbDomainRecord($domainName){
        $domainRecord = DB::table('dnsRecords')->where('domain', $domainName)->first();
        return $domainRecord;
    }

    public function getDomainRecords(){
        $validDomainList = $this->getValidDomainList();
        $domainRecordsList = [];

        foreach($validDomainList as $domainName){
            $domainRecord = $this->getDbDomainRecord($domainName);
            if(is_null($domainRecord)){
                $dnsRecord = dns_get_record($domainName);
                $domainRecord = ['domain'=>$domainName,'records'=>$dnsRecord];
                $domainRecordJson = ['domain'=>$domainName,'records'=>json_encode($dnsRecord)];
                DB::table('dnsRecords')->insert($domainRecordJson);
            }else{
                $domainRecord = [
                    'domain' => $domainRecord->domain,
                    'dnsRecords' => json_decode($domainRecord->records)
                ];
            }
            array_push($domainRecordsList,$domainRecord);
        }

        return json_encode(["success"=>true,"DomainRecords"=>$domainRecordsList]);
    }


}
