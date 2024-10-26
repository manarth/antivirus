<?php

declare(strict_types=1);

namespace Drupal\antivirus\Plugin\Validation\Constraint;

/**
 * Messages to use when reporting antivirus constraints.
 */
abstract class AntiVirusConstraintMessages {

  /**
   * The file is infected.
   */
  public const FILE_IS_INFECTED = 'File is infected with the virus %virus';

  /**
   * The file has not been checked.
   */
  public const FILE_IS_UNCHECKED = 'Files must be successfully scanned by an AntiVirus scanner.';

  /**
   * The scan outcome was not recognised.
   */
  public const FILE_SCAN_OUTCOME_IS_UNKNOWN = 'The outcome of an AntiVirus scan was undetermined.';

}
