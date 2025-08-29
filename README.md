# Trading WordPress Starter (GitHub-first)

This repo lets you build a **trading-focused WordPress site** entirely in the cloud (e.g., GitHub Codespaces) and deploy your **theme & plugins** to your host via GitHub Actions.

## What’s inside
- `docker-compose.yml` + `nginx.conf` → run WordPress locally in the cloud (Codespaces) at http://localhost:8080
- `wp-content/themes/kadence-child` → Kadence child theme with dark (Bloomberg-style) CSS
- `wp-content/plugins/tradingview-shortcode` → Shortcode `[tv symbol="NSE:NIFTY" interval="15"]`
- `.github/workflows/deploy.yml` → Sample SFTP deploy of **themes & plugins** on push to `main`
- `.gitignore` → avoids committing WordPress core and local volumes

## Quick start (GitHub Codespaces)
1. Create a repo and push these files.
2. Open **Codespaces** → start a terminal.
3. Run: `docker compose up -d`
4. Open forwarded port **8080** → run the WordPress setup wizard.
5. In WP Admin, install **Kadence** (parent theme), then **activate Kadence Child**.
6. Activate **TradingView Shortcode** plugin.
7. (Optional) Install plugins: ACF, CPT UI, Rank Math, TablePress, UpdraftPlus.
8. Add a post/page and test: `[tv symbol="NSE:BANKNIFTY" interval="15"]`

## Deploy (themes/plugins only)
1. On your live server, note the WordPress path (e.g., `/var/www/html/wp-content/`).
2. In GitHub repo → Settings → Secrets and variables → Actions → **New repository secrets**:
   - `SFTP_HOST`, `SFTP_USER`, `SFTP_PASS`
3. Push to `main` → Action uploads `wp-content/themes/*` and `wp-content/plugins/*` to your host.

> WordPress core & database are **not** deployed via this Action. Use a migration plugin (e.g., Duplicator/WP Migrate) for full-site moves. Version your **ACF** Field Groups via JSON export (place under your theme).

## Notes
- GitHub Pages **cannot** run WordPress (PHP). Use a PHP host (shared/VPS/cloud).
- Timezone defaults to **Asia/Kolkata** in the TradingView shortcode. Adjust via shortcode attribute `timezone` if needed.
