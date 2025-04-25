# Speculationrules Toggle (Audit Mode Focused)

This WordPress plugin allows you to easily toggle speculationrules on or off for accurate Lighthouse audits.

 When Audit Mode is **enabled**, speculationrules are **hidden** (clean audits).  
 When Audit Mode is **disabled**, speculationrules are **visible** for real user optimization.

## Features

- One-click toggle inside WordPress Admin (Settings > Reading)
- WP-CLI Commands: 
  - `wp speculationrules enable` — Enable Audit Mode (hide speculationrules)
  - `wp speculationrules disable` — Disable Audit Mode (show speculationrules)
- No edits to `functions.php` needed
- Fully compatible with WordPress 6.8+
- Works on any theme

## Installation 

1. Upload the plugin to the `/wp-content/plugins/speculation/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Navigate to **Settings > Reading** to toggle Audit Mode.

Or use WP-CLI:

```bash
wp speculationrules enable
wp speculationrules disable
