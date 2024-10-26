<?php

declare(strict_types=1);

namespace Drupal\antivirus\Plugin\Validation\Constraint;

use Drupal\Core\StringTranslation\TranslatableMarkup;
use Symfony\Component\Validator\Constraint;

/**
 * Constraint for scanning files with an antivirus scanner.
 */
#[Constraint(
  id: "FileIsScanned",
  label: new TranslatableMarkup("File has been scanned", [], ['context' => 'Validation']),
  type: 'file',
)]
class FileIsScannedConstraint extends Constraint {
}
