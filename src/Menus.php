<?php

namespace WPEssential\Library;

if ( ! \defined( 'ABSPATH' ) && ! \defined( 'WPE_REG_MENUS' ) )
{
	exit; // Exit if accessed directly.
}

final class Menus
{
	protected $add_menus    = [];
	protected $remove_menus = [];

	public function __construct () {}

	public static function make ()
	{
		return new self();
	}

	public function add ( $args = [] )
	{
		$name = $args[ 'name' ];
		if ( ! $name ) return;
		static $id = 1;
		$id              = $args[ 'id' ] ?? "{$id}_id";
		$this->add_menus = array_merge( $this->add_menus, [ $id => $name ] );

		return $this;
	}

	public function adds ( $args = [] )
	{
		$this->add_menus = array_merge( $this->add_menus, $args );

		return $this;
	}

	public function remove ( $key = '' )
	{
		$this->remove_menus = array_push( $this->remove_menus, $key );

		return $this;
	}

	public function removes ( $keyes = [] )
	{
		$this->remove_menus = array_merge( $this->remove_menus, $keyes );

		return $this;
	}

	public function init ()
	{
		$this->register();
		$this->unregister();
	}

	protected function unregister ()
	{
		$menus = apply_filters( 'wpe/library/menus_remove', array_merge( $this->remove_menus, [] ) );
		if ( ! empty( $menus ) )
		{
			foreach ( $menus as $menu )
			{
				unregister_nav_menu( $menu );
			}
		}
	}

	protected function register ()
	{
		$menus = apply_filters(
			'wpe/library/menus_add',
			array_merge( $this->add_menus, [
				'primary_menu' => esc_html__( 'Primary Menu', 'wpessential' ),
				'footer_menu'  => esc_html__( 'Footer Menu', 'wpessential' ),
			] )
		);

		if ( ! empty( $menus ) )
		{
			register_nav_menus( $menus );
		}
	}
}
