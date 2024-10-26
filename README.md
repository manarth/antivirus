# Antivirus

The Antivirus module is a pluggable scanner for validating files, which can be
extended to support different antivirus service providers and processes.

## Architecture

- `antivirus_core`:
  A config entity to describe each registered scanner.
  A plugin mechanism for antivirus scanner engines to be defined.

- `antivirus_ui`:
  Forms, controllers, and routes to manage the services using the admin pages.

- `antivirus`
  Integration with the file validation systems and rules to govern the scanning
  behaviour and responses.
