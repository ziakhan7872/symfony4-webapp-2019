<?php
// tests/Controller/ArticleControllerTest.php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testArticleListingApi()
    {
    	
        $client = static::createClient();
		$client->request(
	        'GET',
	        '/api/articles',
	        [],
	        [],
	        [
	        	'HTTP_X-AUTH-TOKEN'=>'3d5943d78f67ffe9674b-1559208652',
	        ]
	    );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }



    public function testAddContent()
    {
        $client = static::createClient();
		$client->request(
	        'POST',
	        '/api/articles',
	        [],
	        [],
	        [
	        	'CONTENT_TYPE' => 'application/json',
	            'HTTP_X-AUTH-TOKEN' => '3d5943d78f67ffe9674b-1559208652',
	        ],
	        '{
			  "category_id":5,
			  "title":"testing TextController",
			  "description":"testing",
			  "tag":"testing tag",
			  "image":"https://via.placeholder.com/500x300.png"
			}'
	    );
		
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}