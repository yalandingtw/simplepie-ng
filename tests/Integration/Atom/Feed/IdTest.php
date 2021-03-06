<?php
/**
 * Copyright (c) 2017–2019 Ryan Parman <http://ryanparman.com>.
 * Copyright (c) 2017–2019 Contributors.
 *
 * http://opensource.org/licenses/Apache2.0
 */

declare(strict_types=1);

namespace SimplePie\Test\Integration\Atom\Feed;

use SimplePie\Enum\Serialization;
use SimplePie\HandlerStack;
use SimplePie\Middleware\Xml\Atom;
use SimplePie\SimplePie;
use SimplePie\Test\Integration\AbstractTestCase;
use SimplePie\Type\Node;
use Skyzyx\UtilityPack\Types;

class IdTest extends AbstractTestCase
{
    // override
    public function getSimplePie(): SimplePie
    {
        return (new SimplePie())
            ->setMiddlewareStack(
                (new HandlerStack())
                    ->append(
                        (new Atom())
                            ->setCaseInsensitive()
                    )
            );
    }

    public function testId(): void
    {
        $id = $this->feed->getId();

        static::assertEquals(Node::class, Types::getClassOrType($id));
        static::assertEquals('tag:github.com,2008:https://github.com/skyzyx/signer/releases', (string) $id);
        static::assertEquals('tag:github.com,2008:https://github.com/skyzyx/signer/releases', $id->getValue());
        static::assertEquals(Serialization::TEXT, $id->getSerialization());
    }

    public function testIdAtom10(): void
    {
        $id = $this->feed->getId('atom10');

        static::assertEquals(Node::class, Types::getClassOrType($id));
        static::assertEquals('tag:github.com,2008:https://github.com/skyzyx/signer/releases', (string) $id);
        static::assertEquals('tag:github.com,2008:https://github.com/skyzyx/signer/releases', $id->getValue());
        static::assertEquals(Serialization::TEXT, $id->getSerialization());
    }
}
