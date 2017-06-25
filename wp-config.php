<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'nana');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');
define('WPLANG', 'he_IL');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define( 'ALLOW_UNFILTERED_UPLOADS', true );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/Q3efI5J`9*c-j]_VCN:o&w3T;ol&*{fEL_i<K3#/wt(V-WNsTbSiZ1{vf*&)e}v');
define('SECURE_AUTH_KEY',  'I+I39`h(O`Yr2Nx6brUOazWRrc]jXOf |6,^-h_Pr[s[:o=3/g)--BL{&f;U_me|');
define('LOGGED_IN_KEY',    '}b.M,s&C,k(DWVeC4+FE{8mIb()e{slSr7>PU/jJkF,nv.@*HxGq5fwc16/(5LLW');
define('NONCE_KEY',        '((,$-NO#(e2wy=G*D;w^ gON^/$<xXD^_d);/mCr.&auoS`?k8}>ZZ[Sv!E5x~A:');
define('AUTH_SALT',        '?tZ6?rRswf>f+LZ3c%C(n/sN~1MA/T]lcT%nW?:jP9ziCNo-X6&]T@2@YiP.;u6l');
define('SECURE_AUTH_SALT', 'dUPui`wjW]R@qR:K>BlvzhGF20$#UWCqir4T%)[stalh&,3usMmYY.qMDLA_P)<K');
define('LOGGED_IN_SALT',   '0~?>E[L^aVLbWQ(d6yNZ`2<4[8gYX^n28Av)IQG:hFDWmv;jadg.K~)=q8,=mC9[');
define('NONCE_SALT',       'y3Fb6PzJVStHW1ry-anukVx#[9SZHt?[k7# mm*F$wrl)*>ZPp1xI5r,JO|YkSLj');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'nana_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
