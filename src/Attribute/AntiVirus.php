<?php

declare(strict_types=1);

namespace Drupal\antivirus\Attribute;

use Drupal\Component\Plugin\Attribute\Plugin;

/**
 * Attribute to identify an AntiVirus plugin.
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class AntiVirus extends Plugin {

  /**
   * Constructs a plugin attribute object.
   *
   * @param string $id
   *   The attribute class ID.
   * @param class-string|null $deriver
   *   (optional) The deriver class.
   * @param string|null $admin_label
   *   (optional) The label displayed in administration forms.
   */
  public function __construct(
    public readonly string $id,
    public readonly ?string $deriver = NULL,
    public readonly ?string $admin_label = NULL
  ) {}

}
