<?php

namespace WPEssential\Library;

if ( ! \defined( 'ABSPATH' ) && ! \defined( 'WPE_REG_MENUS' ) )
{
	exit; // Exit if accessed directly.
}

final class Menus
{
	private $add_menus    = [];
	private $remove_menus = [];

	public function __construct () {}

	public static function make ()
	{
		return new static();
	}

	public function add ( $args = [] )
	{
		$name = $args[ 'name' ];
		if ( ! $name ) return;
		static $id = 1;
		$id                     = $args[ 'id' ] ?? "{$id}_id";
		$this->add_menus[ $id ] = $name;

		return $this;
	}

	public function adds ( $args = [] )
	{
		foreach ( $args as $id => $arg )
		{
			$this->add_menus[ $id ] = $arg;
		}

		return $this;
	}

	public function remove ( $key = '' )
	{
		$this->remove_menus[] = $key;

		return $this;
	}

	public function removes ( $keyes = [] )
	{
		foreach ( $keyes as $key )
		{
			$this->remove_menus[] = $key;
		}

		return $this;
	}

	public function init ()
	{
		$this->register();
		$this->unregister();
	}

	private function unregister ()
	{
		$menus = apply_filters( 'wpe/library/menus_remove', $this->remove_menus );
		if ( ! empty( $menus ) )
		{
			foreach ( $menus as $menu )
			{
				unregister_nav_menu( $menu );
			}
		}
	}

	private function register ()
	{
		$this->add_menus[ 'primary_menu' ] = esc_html__( 'Primary Menu', 'TEXT_DOMAIN' );
		$menus                             = apply_filters( 'wpe/library/menus_add', $this->add_menus );

		if ( ! empty( $menus ) )
		{
			register_nav_menus( $menus );
		}
	}
}
