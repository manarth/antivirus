<?php

namespace Drupal\antivirus_core\PluginDefinition;

use Drupal\antivirus_core\ScannerInterface;
use Drupal\Component\Plugin\DerivativeInspectionInterface;
use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Each anti-virus plugin must implement this interface.
 */
interface AntiVirusPluginInterface extends
  ScannerInterface,
  DerivativeInspectionInterface,
  PluginInspectionInterface,
{
}
