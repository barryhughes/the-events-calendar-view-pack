<?php
namespace Barry_Hughes\The_Events_Calendar\View_Pack;

use Tribe__Events__Main as TEC;
use Tribe__Events__Rewrite as Router;

class Main {
	protected $views = [];

	public function __construct() {
		$this->views = [
			apply_filters( 'tec.view-pack.slug', 'grid' ) => __( 'Grid', 'the-events-calendar-view-pack' )
		];
	}

	public function __invoke() {
		add_filter( 'tribe_events_rewrite_base_slugs', [ $this, 'register_slugs' ] );
		add_filter( 'tribe_events_get_link', [ $this, 'view_links' ], 10, 2 );
		add_filter( 'tribe-events-bar-views', [ $this, 'register_views' ] );
		add_filter( 'tribe_events_current_template_class', [ $this, 'template_class' ] );
		add_action( 'tribe_events_pre_rewrite', [ $this, 'register_routes' ] );
	}

	public function register_views( array $registered_views ): array {
		foreach ( $this->views as $slug => $name ) {
			$registered_views[] = [
				'anchor'         => $name,
				'displaying'     => $slug,
				'event_bar_hook' => 'tribe_events_before_template',
				'url'            => TEC::instance()->getLink( $slug )
			];
		}

		return $registered_views;
	}

	/**
	 * @todo move out to a class dedicated to route registration
	 */
	public function register_routes( Router $router) {
		foreach ( $this->views as $slug => $name ) {
			$base = "{{ $slug }}";

			$router->archive( [ $base, '{{ page }}', '(\d+)' ], [ 'eventDisplay' => $slug, 'paged' => '%1' ] );
			$router->archive( [ $base, '{{ featured }}', '{{ page }}', '(\d+)' ], [ 'eventDisplay' => $slug, 'featured' => true, 'paged' => '%1' ] );
			$router->archive( [ $base, '{{ featured }}' ], [ 'eventDisplay' => $slug, 'featured' => true ] );
			$router->archive( [ $base ], [ 'eventDisplay' => $slug ] );

			$router->tax( [ $base, '{{ page }}', '(\d+)' ], [ 'eventDisplay' => $slug, 'paged' => '%2' ] );
			$router->tax( [ $base, '{{ featured }}', '{{ page }}', '(\d+)' ], [ 'eventDisplay' => $slug, 'featured' => true, 'paged' => '%2' ] );
			$router->tax( [ $base, '{{ featured }}' ], [ 'eventDisplay' => $slug, 'featured' => true ] );
			$router->tax( [ $base ], [ 'eventDisplay' => 'grid' ] );

			$router->tag( [ $base, '{{ page }}', '(\d+)' ], [ 'eventDisplay' => $slug, 'paged' => '%2' ] );
			$router->tag( [ $base, '{{ featured }}', '{{ page }}', '(\d+)' ], [ 'eventDisplay' => $slug, 'featured' => true, 'paged' => '%2' ] );
			$router->tag( [ $base, '{{ featured }}' ], [ 'eventDisplay' => $slug, 'featured' => true ] );
			$router->tag( [ $base ], [ 'eventDisplay' => $slug ] );
		}

	}

	public function register_slugs( array $bases ): array {
		foreach ( $this->views as $slug => $name ) {
			$bases[ $slug ] = [ $slug, apply_filters( "tec.view-pack.alt-slug.$slug", $slug ) ];
		}

		return $bases;
	}

	public function view_links( string $url, string $type ): string {
		if ( isset( $this->views[ $type ] ) ) {
			return trailingslashit( $url ) . $type . '/';
		}

		return $url;
	}

	public function template_class( string $class ): string {
		if ( ! empty( $class ) ) {
			return $class;
		}

		$requested_view = TEC::instance()->displaying;

		if ( ! isset( $this->views[ $requested_view ] ) ) {
			return $class;
		}

		$view_class = strtoupper( $requested_view ) . '_View';
		return __NAMESPACE__ . '\\' . $view_class;
	}
}