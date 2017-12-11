<?php
/**
 * Copyright (c) 2017 Ryan Parman <http://ryanparman.com>.
 * Copyright (c) 2017 Contributors.
 *
 * http://opensource.org/licenses/Apache2.0
 */

declare(strict_types=1);

namespace SimplePie\Type;

use DOMNode;
use Psr\Log\LoggerInterface;
use SimplePie\Configuration as C;
use SimplePie\Mixin as T;

class Person extends AbstractType implements TypeInterface, C\SetLoggerInterface
{
    use T\LoggerTrait;

    /**
     * The DOMNode element to parse.
     *
     * @var DOMNode
     */
    protected $node;

    /**
     * The person's name.
     *
     * @var string
     */
    protected $name;

    /**
     * The person's URL.
     *
     * @var string
     */
    protected $uri;

    /**
     * The person's email address.
     *
     * @var string
     */
    protected $email;

    /**
     * The person's avatar.
     *
     * @var string
     */
    protected $avatar;

    /**
     * Constructs a new instance of this class.
     *
     * @param DOMNode|null    $node   The `DOMNode` element to parse.
     * @param LoggerInterface $logger The PSR-3 logger.
     */
    public function __construct(?DOMNode $node = null, LoggerInterface $logger = null)
    {
        if ($node) {
            $this->logger = $logger ?? new NullLogger();
            $this->node   = $node;
            $this->name   = new Node($this->node);

            foreach ($this->node->childNodes as $child) {
                $this->{$child->tagName} = new Node($child);
            }
        }
    }

    /**
     * Converts this object into a string representation.
     *
     * @return string
     */
    public function __toString(): string
    {
        if (null !== $this->name && null !== $this->uri) {
            return \trim(\sprintf('%s <%s>', (string) $this->name, (string) $this->uri));
        }

        if (null !== $this->name && null !== $this->email) {
            return \trim(\sprintf('%s <%s>', (string) $this->name, (string) $this->email));
        }

        if (null !== $this->name) {
            return \trim((string) $this->name);
        }

        if (null !== $this->uri) {
            return \trim((string) $this->uri);
        }

        if (null !== $this->email) {
            return \trim((string) $this->email);
        }

        return 'Unknown';
    }

    /**
     * Gets the DOMNode element.
     *
     * @return DOMNode|null
     */
    public function getNode(): ?DOMNode
    {
        return $this->node;
    }

    /**
     * Gets the person's name.
     *
     * @return Node
     */
    public function getName(): Node
    {
        return $this->name ?? new Node();
    }

    /**
     * Gets the person's URL.
     *
     * @return Node
     */
    public function getUrl(): Node
    {
        return $this->uri ?? new Node();
    }

    /**
     * Gets the person's email address.
     *
     * @return Node
     */
    public function getEmail(): Node
    {
        return $this->email ?? new Node();
    }

    /**
     * Gets the person's avatar.
     *
     * @return Node
     */
    public function getAvatar(): Node
    {
        return $this->avatar ?? new Node();
    }
}