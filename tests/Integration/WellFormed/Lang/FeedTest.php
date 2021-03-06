<?php
/**
 * Copyright (c) 2017–2019 Ryan Parman <http://ryanparman.com>.
 * Copyright (c) 2017–2019 Contributors.
 *
 * http://opensource.org/licenses/Apache2.0
 */

declare(strict_types=1);

namespace SimplePie\Test\Integration\WellFormed\Lang;

use SimplePie\Enum\Serialization;
use SimplePie\Test\Integration\AbstractTestCase;

class FeedTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        $this->simplepie = $this->getSimplePie();
    }

    public function testXmlLang(): void
    {
        $stream = $this->getFeed('/wellformed/lang/feed_xml_lang.xml');
        $parser = $this->simplepie->parseXml($stream);
        $feed   = $parser->getFeed();

        static::assertEquals('en', (string) $feed->getLang());
        static::assertEquals(Serialization::TEXT, $feed->getLang()->getSerialization());
    }

    public function testXmlLang2(): void
    {
        $stream = $this->getFeed('/wellformed/lang/feed_xml_lang_underscore.xml');
        $parser = $this->simplepie->parseXml($stream);
        $feed   = $parser->getFeed();

        static::assertEquals('en_US', (string) $feed->getLang());
        static::assertEquals(Serialization::TEXT, $feed->getLang()->getSerialization());
    }

    public function testNotXml(): void
    {
        $stream = $this->getFeed('/wellformed/lang/feed_not_xml_lang.xml');
        $parser = $this->simplepie->parseXml($stream);
        $feed   = $parser->getFeed();

        static::assertEquals('en', (string) $feed->getLang());
        static::assertEquals(Serialization::TEXT, $feed->getLang()->getSerialization());
    }

    public function testNotXml2(): void
    {
        $stream = $this->getFeed('/wellformed/lang/feed_not_xml_lang_2.xml');
        $parser = $this->simplepie->parseXml($stream);
        $feed   = $parser->getFeed();

        static::assertEquals('', (string) $feed->getLang());
        static::assertEquals(Serialization::TEXT, $feed->getLang()->getSerialization());
    }
}
