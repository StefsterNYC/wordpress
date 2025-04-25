<?php
/*
Plugin Name: Speculationrules Toggle (Audit Mode Focused)
Description: Simple plugin to disable or enable speculationrules output for accurate Lighthouse audits. Note:do not leave this on or you will ruin your Core Web Vitals. Thank you.
Version: 1.0
Author: by Serafin Tech
**
**
-------- CLI Commands ---------
  
#Enable Rules (checkbox is checked)
wp speculationrules enable


# Then open the browser in Incognito
# Run Lighthouse

# Restore life back to an optimized site (checkbox is unchecked)
wp speculationrules disable

------------------------------
**
*/





// Add the admin checkbox
add_action('admin_init', function() {
    add_settings_field(
        'speculationrules_audit_mode',
        'Enable Audit Mode (Hide speculationrules)',
        function() {
            $value = get_option('speculationrules_audit_mode', 'no');
            echo '<input type="checkbox" name="speculationrules_audit_mode" value="yes" ' . checked('yes', $value, false) . '> Enable Audit Mode (hide speculationrules)';
        },
        'reading'
    );

    register_setting('reading', 'speculationrules_audit_mode');
});

// Apply the logic
add_action('init', function() {
    if (get_option('speculationrules_audit_mode') === 'yes') {
        // Audit Mode is ENABLED -> hide speculationrules
        add_filter('wp_speculative_loading_enabled', '__return_false');
        remove_action('wp_head', 'wp_output_speculationrules_script');

        add_action('template_redirect', function () {
            ob_start(function ($html) {
                return preg_replace('/<script type="speculationrules".*?<\\/script>/is', '', $html);
            });
        });
    }
});

// CLI commands to match
if (defined('WP_CLI') && WP_CLI) {
    WP_CLI::add_command('speculationrules', new class {
        public function enable() {
            update_option('speculationrules_audit_mode', 'yes');
            WP_CLI::success('Audit Mode ENABLED. Speculationrules are now hidden.');
        }
        public function disable() {
            update_option('speculationrules_audit_mode', 'no');
            WP_CLI::success('Audit Mode DISABLED. Speculationrules are now visible.');
        }
    });
}

