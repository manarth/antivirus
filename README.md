# Antivirus

The Antivirus module is a pluggable scanner for validating files, which can be
extended to support different antivirus service providers and processes.

## Scanning steps

Each scan compromises three steps:

- Determine whether a file should be scanned.
- Scan a file and report an outcome.
- Populate any constraints based on the results of the scan.
