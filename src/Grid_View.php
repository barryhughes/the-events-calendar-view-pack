<?php
namespace Barry_Hughes\The_Events_Calendar\View_Pack;

use Tribe__Events__Main as TEC;
use Tribe__Events__Templates as Templates;
use Tribe__Events__Template__List as List_View;

class Grid_View extends List_View {
	protected $body_class = 'events-list tec-view-pack-grid';
	protected $asset_packages = array( 'ajax-list' );

	public function __construct() {
		parent::__construct();
		add_filter( 'tribe_events_current_view_template', [ $this, 'template_choice' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'assets' ] );
	}

	public function template_choice( string $template ):string {
		if ( 'grid' === TEC::instance()->displaying ) {
			return Templates::getTemplateHierarchy( 'list', array( 'disable_view_check' => true ) );
		}

		return $template;
	}

	public function assets() {
		wp_enqueue_style( 'tec-view-pack-grid-view-css', TEC_VIEW_PACK_URL . 'src/styles/grid.css' );
	}
}