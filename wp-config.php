<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'KG}v_Ut%vbp39QlFhb4qsttfip]?.@F~^-JA2WSE0A,ZQL2/ 1DfM=kbZMOd?XFk' );
define( 'SECURE_AUTH_KEY',  'agn)J!MCJ7*f$-$#vfGvtWebW^|VWZ}{CUGN#OqWX<nR0q >:ywu]rQWP&N,XXxb' );
define( 'LOGGED_IN_KEY',    '~>xVYX@p{?b->.OQ=qJU:J0ql/*IRAmjNi~8HxbCll6s}:b]6%_0a9@Plj~]*{ha' );
define( 'NONCE_KEY',        '%pkR4EGerC,];*e&VRk:Vz1?N3gj,)bb~C@7J@7?MQx Y=]e]c1M##5#.@@d?P D' );
define( 'AUTH_SALT',        '<+rrP8sbuS)yJC{wB5aKg#J+a-P3X)^`~ mX!n~)7ygS71T,K=vZG7Gy|Ay_}D(/' );
define( 'SECURE_AUTH_SALT', '$}?4i^@GSwV0a)-[wMu?(>%oEwL@-[:yJC`HoW7kaP|V#Uld=A;iK)kM0p%+>Tg6' );
define( 'LOGGED_IN_SALT',   '4sfpJlV5D[SQ;L ;9Cw6R[0Kxkq|McZ,!l}aYy %=::2hUKQEN CbYzIfbwX@Ls@' );
define( 'NONCE_SALT',       '@IPxSWg!vK(ABJLOzjV6>|[dK_3`Q`*Y+KPta{9`V?_<Q=b|E6a1c=846bf&Ss)&' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
