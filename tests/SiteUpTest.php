<?php

use FigoliQuinn\SiteUp\SiteUpChecker;
use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;


class SiteUpCheckerTest extends TestCase 
{
	private $url = 'https://www.figoliquinn.com';

	public function test200Response()
	{
		$this->responseTesterSetup(200, true);
	}

	public function test500Response()
	{
		$this->responseTesterSetup(500, false);
	}

	public function test400Response()
	{
		$this->responseTesterSetup(400, false);
	}

	public function test503Response()
	{
		$this->responseTesterSetup(503, false);
	}

	private function responseTesterSetup($statusCode, $expectedUp)
	{
		$siteUpChecker = $this->mockSiteUpChecker(new Response($statusCode));
		$this->assertEquals($statusCode, $siteUpChecker->getStatusCode($this->url));

		$siteUpChecker = $this->mockSiteUpChecker(new Response($statusCode));
		$this->assertEquals($statusCode, $siteUpChecker->getResponse($this->url)->getStatusCode());

		$siteUpChecker = $this->mockSiteUpChecker(new Response($statusCode));
		$this->assertEquals($expectedUp, $siteUpChecker->isUp($this->url));
		$this->assertEquals($expectedUp, $siteUpChecker->statusCodeIsUp($statusCode));
	
		
	    $siteUpChecker = $this->mockSiteUpChecker(new Response($statusCode));	
		$this->assertEquals(!$expectedUp, $siteUpChecker->statusCodeIsDown($statusCode));
		$this->assertEquals(!$expectedUp, $siteUpChecker->isDown($this->url));
	}

	private function mockSiteUpChecker($handlerStep)
	{
		$mock = new MockHandler([$handlerStep]);
		$handler = HandlerStack::create($mock);
		$client = new Client(['handler' => $handler, 'http_errors' => true]);

		return new SiteUpChecker($client);
	}


}
