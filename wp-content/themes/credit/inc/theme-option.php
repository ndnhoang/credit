<?php
if ( ! class_exists( 'blog_options' ) ) {
	class blog_options {
		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;
		/* Load Redux Framework */
		public function __construct() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return;
			}
			if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
				$this->initSettings();
			} else {
				add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
			}
		}
		public function initSettings() {
    		// Set the default arguments
			$this->setArguments();

		    // Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

		    // Create the sections and fields
			$this->setSections();

		    if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
		    	return;
		    }

		    $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
		}
		//setup theme option
		public function setArguments() {
			$theme = wp_get_theme();
			$this->args = array(
				'opt_name'  => 'blog_option',
				'display_name' => $theme->get( 'Name' ),
				'menu_type'          => 'menu',
				'allow_sub_menu'     => true,
				'menu_title'         => __( 'Blog Options', 'blog' ),
				'page_title'         => __( 'Blog Options', 'blog' ),
				'dev_mode' => false,
				'customizer' => true,
				'menu_icon' => '',
				'hints'              => array(
					'icon'          => 'icon-question-sign',
					'icon_position' => 'right',
					'icon_color'    => 'lightgray',
					'icon_size'     => 'normal',
					'tip_style'     => array(
						'color'   => 'light',
						'shadow'  => true,
						'rounded' => false,
						'style'   => '',
						),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
						),
					'tip_effect'    => array(
						'show' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'mouseover',
							),
						'hide' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'click mouseleave',
							),
						),
		        ) // end Hints
				);
		}
		//setup helper tab
		public function setHelpTabs() {
			$this->args['help_tabs'][] = array(
				'id'      => 'redux-help-tab-1',
				'title'   => __( 'Theme Information 1', 'blog' ),
				'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'blog' )
				);

			$this->args['help_tabs'][] = array(
				'id'      => 'redux-help-tab-2',
				'title'   => __( 'Theme Information 2', 'blog' ),
				'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'blog' )
				);
			$this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'blog' );
		}
		//setup area
		public function setSections() {
	    	// Header Section
			$this->sections[] = array(
				'title'  => __( 'Header', 'blog' ),
				'desc'   => __( 'All of settings for header on this theme.', 'blog' ),
				'icon'   => 'el-icon-home',
				'fields' => array(
					array(
						'id'       => 'logo-image',
						'type'     => 'media',
						'title'    => __( 'Logo image', 'blog' ),
						'desc'     => __( 'Image that you want to use as logo', 'blog' ),
					),
					array(
						'id'       => 'favicon',
						'type'     => 'media',
						'title'    => __( 'Favicon image', 'blog' ),
						'desc'     => __( 'Image that you want to use as favicon', 'blog' ),
					),
					array(
						'id'       => 'lang_name',
						'type'     => 'text',
						'title'    => __( 'global Name', 'blog' ),
						'desc'     => __( 'The name use to translate language', 'blog' ),
					)
				)
	    	);
	    	// Infor Section
			$this->sections[] = array(
				'title'  => __( 'Information', 'blog' ),
				'desc'   => __( 'All of settings for information on this theme.', 'blog' ),
				'icon'   => 'el-icon-home',
				'fields' => array(
					array(
						'id'       => 'fax',
						'type'     => 'text',
						'title'    => __( 'Fax', 'blog' ),
						'desc'     => __( 'Fax company', 'blog' ),
					),array(
						'id'       => 'phone',
						'type'     => 'text',
						'title'    => __( 'Phone', 'blog' ),
						'desc'     => __( 'Phone company', 'blog' ),
					),
					array(
						'id'       => 'address',
						'type'     => 'text',
						'title'    => __( 'Address', 'blog' ),
						'desc'     => __( 'Address company', 'blog' ),
					),
					array(
						'id'       => 'email',
						'type'     => 'text',
						'title'    => __( 'Email', 'blog' ),
						'desc'     => __( 'Email company', 'blog' ),
					),
				)
	    	);
	    	//socail links
	    	$this->sections[] = array(
				'title'  => __( 'Socical Links', 'blog' ),
				'desc'   => __( '', 'blog' ),
				'icon'   => 'el-icon-share-alt',
				'fields' => array(
					array(
						'id'       => 'facebook',
						'type'     => 'text',
						'title'    => __( 'Facebook', 'blog' ),
					),
                    array(
						'id'       => 'instagram',
						'type'     => 'text',
						'title'    => __( 'Instagram', 'blog' ),
                    ),
                    array(
						'id'       => 'twitter',
						'type'     => 'text',
						'title'    => __( 'Twitter', 'blog' ),
                    )
				)
	    	);
			//Footer
	    	$this->sections[] = array(
				'title'  => __( 'Footer', 'blog' ),
				'desc'   => __( '', 'blog' ),
				'icon'   => 'el-icon-website',
				'fields' => array(
					array(
						'id'       => 'copyright',
						'type'     => 'textarea',
						'title'    => __( 'Copyright', 'blog' ),
						'hint'     => array(
		                    'content' => 'This is a <b>hint</b> tool-tip for the text field.<br/><br/>Add any HTML based text you like here.',
		                )
					)
				)
	    	);
		}
	}
	global $reduxConfig;
	$reduxConfig = new blog_options();
}