<?php
/**
 * Copyright (c) 2017–2019 Ryan Parman <http://ryanparman.com>.
 * Copyright (c) 2017–2019 Contributors.
 *
 * http://opensource.org/licenses/Apache2.0
 */

declare(strict_types=1);

namespace SimplePie\Test\Integration\WellFormed\Atom;

use SimplePie\Test\Integration\AbstractTestCase;

class FeedContributorTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        $this->simplepie = $this->getSimplePie();
    }

    public function testEmail(): void
    {
        $stream      = $this->getFeed('/wellformed/atom10/feed_contributor_email.xml');
        $parser      = $this->simplepie->parseXml($stream);
        $feed        = $parser->getFeed();
        $contributor = $feed->getContributors()[0];

        static::assertEquals('me@example.com', (string) $contributor->getEmail());
    }

    public function testEmails(): void
    {
        $stream       = $this->getFeed('/wellformed/atom10/feed_contributor_multiple.xml');
        $parser       = $this->simplepie->parseXml($stream);
        $feed         = $parser->getFeed();
        $contributors = $feed->getContributors();

        static::assertEquals('me@example.com', (string) $contributors[0]->getEmail());
        static::assertEquals('you@example.com', (string) $contributors[1]->getEmail());
    }

    public function testName(): void
    {
        $stream      = $this->getFeed('/wellformed/atom10/feed_contributor_name.xml');
        $parser      = $this->simplepie->parseXml($stream);
        $feed        = $parser->getFeed();
        $contributor = $feed->getContributors()[0];

        static::assertEquals('Example contributor', (string) $contributor->getName());
    }

    public function testNames(): void
    {
        $stream       = $this->getFeed('/wellformed/atom10/feed_contributor_multiple.xml');
        $parser       = $this->simplepie->parseXml($stream);
        $feed         = $parser->getFeed();
        $contributors = $feed->getContributors();

        static::assertEquals('Contributor 1', (string) $contributors[0]->getName());
        static::assertEquals('Contributor 2', (string) $contributors[1]->getName());
    }

    public function testUri(): void
    {
        $stream      = $this->getFeed('/wellformed/atom10/feed_contributor_uri.xml');
        $parser      = $this->simplepie->parseXml($stream);
        $feed        = $parser->getFeed();
        $contributor = $feed->getContributors()[0];

        static::assertEquals('http://example.com/', (string) $contributor->getUri());
    }

    public function testUris(): void
    {
        $stream       = $this->getFeed('/wellformed/atom10/feed_contributor_multiple.xml');
        $parser       = $this->simplepie->parseXml($stream);
        $feed         = $parser->getFeed();
        $contributors = $feed->getContributors();

        static::assertEquals('http://example.com/', (string) $contributors[0]->getUri());
        static::assertEquals('http://two.example.com/', (string) $contributors[1]->getUri());
    }

    public function testUrl(): void
    {
        $stream      = $this->getFeed('/wellformed/atom10/feed_contributor_url.xml');
        $parser      = $this->simplepie->parseXml($stream);
        $feed        = $parser->getFeed();
        $contributor = $feed->getContributors()[0];

        static::assertEquals('http://example.com/', (string) $contributor->getUrl());
    }

    public function testUrls(): void
    {
        $stream       = $this->getFeed('/wellformed/atom10/feed_contributor_multiple.xml');
        $parser       = $this->simplepie->parseXml($stream);
        $feed         = $parser->getFeed();
        $contributors = $feed->getContributors();

        static::assertEquals('http://example.com/', (string) $contributors[0]->getUrl());
        static::assertEquals('http://two.example.com/', (string) $contributors[1]->getUrl());
    }
}
