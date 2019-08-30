<?php

namespace FigoliQuinn\SiteUp;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;

class SiteUpChecker
{
	private $client;
	private $clientConfig;
	private $upStatusCodes = [200];

	public function __construct(?Client $client = null)
	{
		$this->client = $client ?? new Client;
		$this->clientConfig = ['http_errors' => true];
	}

	public function getResponse(String $url): Response
	{
		$response = null;
		
		try {
			$response = $this->client->get($url, $this->clientConfig);
		}
		catch (RequestException $e) {
			$response = $e->getResponse();
		}

		return $response;
	}

	public function getResponseAsync(String $url)
	{
		return $this->client->getAsync($url, $this->clientConfig);
	} 

	public function getStatusCode(String $url): int
	{
		$response = $this->getResponse($url);
		return $response->getStatusCode();
	}

	public function isUp(String $url)
	{
		$response = $this->getResponse($url);
		return $this->statusCodeIsUp($response->getStatusCode());
	}

	public function isDown(String $url): bool
	{
		return !$this->isUp($url);
	}

	public function statusCodeIsUp(int $statusCode): bool
	{
		return in_array($statusCode, $this->upStatusCodes);
	}

	public function statusCodeIsDown(int $statusCode): bool
	{
		return !$this->statusCodeIsUp($statusCode);
	}
}
