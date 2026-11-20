# Changelog

This changelog documents only the two most recent published GitHub releases. Each entry is based on the differences between that release tag and the immediately preceding published release; changes made afterward on `master` are excluded.

## 4.0.11 - 2026-11-20

### Fixed

- Repaired legacy `local_geniai_analysis` migration to `local_courseaudit_analysis`: deferred migration can resume after Course Audit is installed, and migrated records are checked before deleting the old table (#26).
- Added a scheduled retry task for installations where plugin upgrade order leaves the legacy table behind (#26).
- Avoided sending unsupported OpenAI Responses API sampling and penalty parameters to GPT-5, o-series, and unknown future models while keeping supported GPT-4 model configurations (#23).

### Changed

- Updated the plugin release from `4.0.10` to `4.0.11`, build `2026112000`.
- Added PHPUnit regression tests for migration no-op behavior and model parameter compatibility.

[Compare 4.0.10...4.0.11](https://github.com/EduardoKrausME/moodle-local_geniai/compare/4.0.10...4.0.11)

## 4.0.10 - 2026-10-15

### Changed

- Updated the plugin image at `pix/icon.png`.
- Updated the plugin release from `4.0.9` to `4.0.10` and its build number from `2026101500` to `2026101501`.

No other functional changes are present in the comparison with release `4.0.9`.

[Compare 4.0.9...4.0.10](https://github.com/EduardoKrausME/moodle-local_geniai/compare/4.0.9...4.0.10)
