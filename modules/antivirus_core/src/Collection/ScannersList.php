<?php

namespace Drupal\antivirus_core\Collection;

use Drupal\antivirus_core\Entity\AntiVirusScannerInterface;
use Iterator;
use IteratorAggregate;

/**
 * Collection of Scanner entities.
 */
class ScannersList implements ScannersListInterface, Iterator
{

    /**
     * Collection of scanner entities.
     *
     * @var \Drupal\antivirus_core\Entity\AntiVirusScannerInterface[]
     */
    protected array $scanners;

    /**
     * Position when iterating.
     * 
     * @var int
     */
    protected int $position = 0;

    /**
     * Constructor.
     */
    public function __construct(array $scanners)
    {
        $this->addAll($scanners);
    }

    /**
     * {@inheritdoc}
     */
    public function add(AntiVirusScannerInterface $scanner)
    {
        $this->scanners[$scanner->id()] = $scanner;
    }

    /**
     * {@inheritdoc}
     */
    public function addAll(array $scanners)
    {
        foreach ($scanners as $scanner) {
            $this->add($scanner);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get(int|string $offset): AntiVirusScannerInterface
    {
        if (!isset($this->scanners[$offset])) {
            throw new \OutOfBoundsException(sprintf('The offset "%s" does not exist.', $offset));
        }

        return $this->scanners[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function has(int|string $offset): bool
    {
        return isset($this->scanners[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function set(int|string $offset, AntiVirusScannerInterface $scanner)
    {
        $this->scanners[$offset] = $scanner;
    }

    /**
     * {@inheritdoc}
     */
    public function remove(int|string $offset)
    {
        unset($this->scanners[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->scanners);
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return \count($this->scanners);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet(mixed $offset): AntiVirusScannerInterface
    {
        return $this->get($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet(mixed $offset, mixed $scanner): void
    {
        // The offset must match the ID of the scanner.
        if ($offset != $scanner->id()) {
            throw new \Exception('Invalid offset.');
        }
        $this->add($scanner);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function current(): mixed
    {
        return $this->scanners[$this->key()];
    }

    /**
     * {@inheritdoc}
     */
    public function key(): mixed
    {
        return array_keys($this->scanners)[$this->position];
    }

    /**
     * {@inheritdoc}
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function valid(): bool
    {
        return !empty($this->scanners) && $this->position >= 0 && $this->position <= (count($this->scanners) - 1);
    }

}
