<!-- Copilot / AI agent instructions for this Laravel project -->
# Copilot instructions — UASFW (Laravel)

Purpose: quickly orient AI coding agents to be immediately productive in this repository.

- Project type: Laravel (App\\ => app/). PHP ^8.2, Laravel ^12, Vite + Tailwind for front-end.
- Key packages: `maatwebsite/excel` (App\\Exports\\LaporanExport), `barryvdh/laravel-dompdf` (PDF exports).

Quick commands
- Local dev (runs server, queue, pail logger, vite): `composer run dev`
- Full setup (installs deps, creates .env, migrates, builds assets): `composer run setup`
- Run tests: `composer run test` or `php artisan test`
- Build frontend only: `npm run build` (Vite)
- Run migrations: `php artisan migrate` (see `database/migrations/`)

Architecture & important locations
- Routes: `routes/web.php` — routes are grouped by role prefixes `manager`, `staff`, `customer` and often protected by `auth` and `role:manager` middleware.
- Controllers: `app/Http/Controllers/` with subfolders `Customer`, `Manager`, `Staff`, `Auth` — follow these namespaces when editing behaviour.
- Models: `app/Models/` (lowercase filenames exist in this repo; be aware of case-sensitivity differences between Windows and Linux deployments).
- Views: `resources/views/` — role-specific folders: `customer/`, `manager/`, `staff/`.
- Frontend entry: `resources/js/` and `vite.config.js`; use `npm run dev` / `npm run build` for asset workflows.
- Exports: `app/Exports/LaporanExport.php` is used for Excel exports (route: manager/laporan/excel). PDF export endpoints use Dompdf (manager/laporan/pdf).

Conventions & repo-specific notes
- Route naming: routes often use prefixes and explicit names (e.g. `manager.produk.index`, `main.dashboard`). Use existing names when generating links.
- Controllers use explicit method names for actions (e.g. `verifikasi`, `proses`, `selesai`) rather than full resource controllers in some staff routes—match naming when adding routes.
- Composer scripts create `.env` and SQLite during project creation; setup scripts assume running from project root.
- There are migrations and seeders in `database/` — tests may rely on migrations; prefer `php artisan migrate --graceful` in CI.
- On Windows, filenames in `app/Models` are lowercase; ensure class names and namespaces match PSR-4 to avoid runtime issues on case-sensitive hosts.

Testing & debugging
- PHPUnit config exists (`phpunit.xml`) — run `composer run test` or `php artisan test`.
- For local multi-process dev, `composer run dev` uses `concurrently` to start server, queue worker and vite. If debugging one service, run the specific command: `php artisan serve` or `php artisan queue:listen`.

What to read first when making changes
- `routes/web.php` to see entrypoints and middleware.
- Matching controller in `app/Http/Controllers/<Role>/` to find business logic.
- `app/Models/` and related migration in `database/migrations/` for data shape.
- `app/Exports/LaporanExport.php` and `resources/views/manager/` for export-related changes.

When editing or generating code
- Keep namespaces consistent with `App\\` and file paths under `app/`.
- Prefer using existing route names and controller method names for consistency.
- If adding model files, ensure filename casing aligns with expected class name to avoid deployment breakage on Linux.

If anything here is unclear or you want this adapted (more examples, CI notes, or role-guides), ask and I'll iterate.
