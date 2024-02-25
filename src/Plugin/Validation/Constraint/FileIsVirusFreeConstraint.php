<?php

declare(strict_types=1);

namespace Drupal\antivirus\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint for scanning files with an antivirus scanner.
 *
 * @Constraint(
 *   id = "FileIsVirusFree",
 *   label = @Translation("File is virus free", context = "Validation"),
 *   type = "file"
 * )
 */
class FileIsVirusFreeConstraint extends Constraint {

  /**
   * The file is infected with a virus.
   *
   * @var string
   */
  public string $fileIsInfected = 'Files infected with a virus cannot be uploaded.';

  /**
   * The file has not been checked.
   *
   * @var string
   */
  public string $fileIsUnchecked = 'Files must be successfully scanned by an AntiVirus scanner.';

  /**
   * The scan outcome was not recognised.
   *
   * @var string
   */
  public string $fileScanOutcomeIsUnknown = 'The outcome of an antivirus scan was undetermined.';

}
