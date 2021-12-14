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
define( 'DB_NAME', 'aavad_data' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '}s_{Q4Ae@@].M%!.nWN#$=bcl&;J(#R!=;?g/+Di<Z1<@&G )0z]{nP9=zp7+6yY' );
define( 'SECURE_AUTH_KEY',  'G)r+7$rpTL6#3LLQx,j=dQM1_Pw^Sk8#WJ<Ev-/w.zBQ[xK*jf%6FM88{PegF{Wl' );
define( 'LOGGED_IN_KEY',    'T .@5P7]K565pI1UheU?tswiR4 :HG[;p)i0H: X<9y:%,13MRmVV;[t{c,6#bnc' );
define( 'NONCE_KEY',        's~AZYK)3!o#=%e*Zrvun>vDw6y>;`qEpi&<i vP&<gAj&G`>wk(/7ruBiwf}-q1I' );
define( 'AUTH_SALT',        'G dGY>I2&i+ox*Qp{z9}{,DQrlu>L44M=mz_g#_L@Qp%vcSomvc+aU{$nmvHNT+N' );
define( 'SECURE_AUTH_SALT', '[WJc=/{miLdLYot?]x&.ypIjr;8N4YY_=ky3Q.]__#0O{l}fJ$!u@6=.fMza#;Q7' );
define( 'LOGGED_IN_SALT',   '#t`w%6,^4<dmx.T7sV1SA #M@km1OQI->Lg+qu*q@2cT6!+;2A]O!g@|>Ps^:_j2' );
define( 'NONCE_SALT',       'U@i+=,^}@ ,_m)Fb!@}SZimW:X9P$ymN#],g;S.T- Mh`!r|w:C`KMJkx$TOcB&E' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
