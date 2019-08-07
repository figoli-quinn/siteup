# Site up
This package provides an easy way to check if a particular url is “up” and the response / status codes for it. It’s essentially a wrapper for guzzle functionality. 

## Installation
1. Add the GitHub repository to the root of your composer.json file

```
"repositories": [
{
	"type": "vcs",
	"url": "https://github.com/figoli-quinn/siteup.git"
}
],
```

2. Next, add the following to the requires entry in your composer.json file
`"figoli-quinn/siteup": "^1"`

3. Run `composer update`


## Usage
This package provides the facade SiteUpChecker for use with Laravel. After adding `use FigoliQuinn\SiteUp\Facades\SiteUpChecker;` to your file, you can use the facade with the following methods:

**SiteUpChecker::getResponse(String $url)**
This takes a url and returns a guzzle response from trying to run a get request on it. 

**SiteUpChecker::getStatusCode(String $url)**
This takes a url and returns the http status code for a get request to it. 

**SiteUpChecker::isUp(String $url)**
This is a basic method that performs a get request on the url and returns if the site is “up” as a Boolean. 

**SiteUpChecker::isDown(String $url)**
This is a basic method that performs a get request on the url and returns if the site is “down” as a Boolean. 

## Support
If you have any questions of would like to see any changes, feel free to create an issue. 
