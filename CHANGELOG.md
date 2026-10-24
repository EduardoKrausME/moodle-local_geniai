# Changelog

This changelog documents only the two most recent published GitHub releases. Each entry is based on the differences between that release tag and the immediately preceding published release; changes made afterward on `master` are excluded.

## 4.0.10 - 2026-10-15

### Changed

- Updated the plugin image at `pix/icon.png`.
- Updated the plugin release from `4.0.9` to `4.0.10` and its build number from `2026101500` to `2026101501`.

No other functional changes are present in the comparison with release `4.0.9`.

[Compare 4.0.9...4.0.10](https://github.com/EduardoKrausME/moodle-local_geniai/compare/4.0.9...4.0.10)

## 4.0.9 - 2026-10-15

### Changed

- Removed the legacy `local_geniai_before_footer()` callback from `lib.php`, along with its direct call to `core_hook_output::before_footer_html_generation()`.
- Raised the minimum Moodle requirement from build `2020110900` to `2024042200`.
- Updated GitHub CI database services from PostgreSQL 16 to PostgreSQL 17 and from MariaDB 10 to MariaDB 11.4, including updated MariaDB startup and health-check configuration.
- Updated the plugin release from `4.0.8` to `4.0.9` and its build number from `2026101200` to `2026101500`.

[Compare 4.0.8...4.0.9](https://github.com/EduardoKrausME/moodle-local_geniai/compare/4.0.8...4.0.9)
