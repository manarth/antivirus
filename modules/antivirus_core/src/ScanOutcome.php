<?php

namespace Drupal\antivirus_core;

/**
 * Outcome of an antivirus scan.
 */
enum ScanOutcome {
  case CLEAN;
  case INFECTED;
  case UNCHECKED;
  case UNKNOWN;
}
