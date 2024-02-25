<?php

declare(strict_types=1);

namespace Drupal\antivirus\Attribute;

use Attribute;
use Drupal\Component\Plugin\Attribute\Plugin;

#[Attribute(Attribute::TARGET_CLASS)]
class AntiVirus extends Plugin {
}
