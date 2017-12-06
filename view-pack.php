<?php
/**
 * Plugin name: View Pack for The Events Calendar
 * Description: Experiment in adding a set of additional, lightweight event views to The Events Calendar.
 * Version:     0.1
 * Author:      Barry Hughes
 * Author URI:  https://codingkills.me
 * License:     GPL 3.0 <https://www.gnu.org/licenses/gpl-3.0.en.html>
 *
 *     View Pack for The Events Calendar
 *     Copyright (C) 2018 Barry Hughes
 *
 *     This program is free software; you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation; either version 2 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License along
 *     with this program; if not, write to the Free Software Foundation, Inc.,
 *     51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace Barry_Hughes\The_Events_Calendar\View_Pack;

define( 'TEC_VIEW_PACK_DIR', __DIR__ );
define( 'TEC_VIEW_PACK_URL', plugin_dir_url( __FILE__ ) );

function main() {
	static $main;

	if ( empty( $main ) ) {
		require_once __DIR__ . '/src/Main.php';
		require_once __DIR__ . '/src/Grid_View.php';

		$main = new Main;
		$main();
	}

	return $main;
}

add_action( 'tribe_events_bound_implementations', __NAMESPACE__ . '\main' );