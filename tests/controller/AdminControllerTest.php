<?php
// tests/Controller/AdminControllerTest.php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testArticleListingApi()
    {
    	
        $client = static::createClient();
		$client->request(
	        'GET',
	        '/api/users',
	        [],
	        [],
	        [
	        	'HTTP_X-AUTH-TOKEN'=>'3d5943d78f67ffe9674b-1559208652',
	        ]
	    );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}
