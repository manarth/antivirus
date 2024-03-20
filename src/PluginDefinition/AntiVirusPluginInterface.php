<?php

namespace Drupal\antivirus\PluginDefinition;

use Drupal\antivirus\ScannerInterface;
use Drupal\Component\Plugin\DerivativeInspectionInterface;
use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Each anti-virus plugin must implement this interface.
 */
interface AntiVirusPluginInterface extends
  ScannerInterface,
  DerivativeInspectionInterface,
  PluginInspectionInterface {
}
