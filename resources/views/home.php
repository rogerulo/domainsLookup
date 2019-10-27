<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <title>- Domain Searching</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">


    <!-- @stack('styles') -->

    <!-- development version, includes helpful console warnings -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


</head>

<body>

<div id="main-wrapper">

    <div class="page-wrapper">
        <div class="container-fluid">
            <section class="domainapp" >
                <header class="header">
                    <h1>Write yor domain</h1>
                    <input class="new-domain"
                    autofocus autocomplete="off"
                    placeholder="Write your domain?"
                    v-model="newDomain"
                    dusk="new-domain"
                    @keyup.enter="addDomain">
                </header>
                <section class="main" v-show="Domains.length" v-cloak>
                    <ul class="domain-list" dusk="vue-contains-test">
                        <li v-for="domain in Domains"
                            class="domain">
                            <div class="view">
                            <label>{{ domain.domain }}</label>
                            <button class="destroy" @click="removeDomain(domain)"></button>
                            </div>
                        </li>
                    </ul>
                </section>
                <footer class="footer" v-show="Domains.length" v-cloak>
                    <button dusk="vue-search-btn" type="button" @click="searchDomains" class="btn btn-primary">Search Domains</button>
                </footer>

                <section class="main" v-show="DomainRecords.length" v-cloak>
                        <div v-for="domainRecord in DomainRecords"
                            class="domain">
                                <div class="dr_domain" style="font-weight:bold"><span>{{ domainRecord.domain }}</span></div>
                                <div v-for="dnsRecords in domainRecord" class="dr_record">
                                    <!-- <div v-for="entry in dnsRecords" class="dr_record"> -->
                                        {{ dnsRecords }}
                                    <!-- </div> -->
                                </div>
                        </div>
                </section>

            </section>
        </div>
    </div>
</div>



<script type="text/javascript" src="js/domainSearch.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</body>

</html>
