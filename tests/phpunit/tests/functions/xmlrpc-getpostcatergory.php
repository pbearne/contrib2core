<?php

/**
 * Class Tests_Xmlrpc_Getpostcategory
 * test the xmlrpc_getpostcategory function
 */
class Tests_Xmlrpc_GetPostCategory extends WP_UnitTestCase {

	/**
	 * setup
	 * declare the default category needed in function
	 */
	function setup() {
		global $post_default_category;
		$post_default_category = 'post_default_category';
	}

	/**
	 * remove global
	 */
	function tearDown() {
		global $post_default_category;
		$post_default_category = null;
	}


	/**
	 * pass null
	 */
	function test_xmlrpc_getpostcategory_null() {
		$this->assertEquals( 'post_default_category' , xmlrpc_getpostcategory( null ) );
	}

	/**
	 * pass good category in test
	 */
	function test_xmlrpc_getpostcategory_good() {

		$this->assertEquals( array( 'good_category' ) , xmlrpc_getpostcategory( '<category>good_category</category>' ) );
	}


	/**
	 * pass good category in test
	 */
	function test_xmlrpc_getpostcategorys_good() {

		$this->assertEquals( array( 'good_category1', 'good_category2', 'good_category3' ), xmlrpc_getpostcategory( '<category>good_category1, good_category2, good_category3</category>' ) );
	}

	/**
	 * pass good category in test
	 */
	function test_xmlrpc_getpostcategorys_dupicate_cat() {

		$this->assertEquals( array( 0 => 'good_category1', 2 => 'good_category3' ), xmlrpc_getpostcategory( '<category>good_category1, good_category1, good_category3,</category>' ) );
	}

	/**
	 * pass good category in lot of content
	 */
	function test_xmlrpc_getpostcategory_good_in_post_tag() {

		$this->assertEquals( array( 'good_category' ) , xmlrpc_getpostcategory( '<post><category>good_category</category><cat>fsdfsfsf</cat></post>' ) );
	}
	/**
	 * missing close
	 */
	function test_xmlrpc_getpostcategory_bad() {

		$this->assertEquals( 'post_default_category', xmlrpc_getpostcategory( '<category>good_category<category>ssssss' ) );
	}

	/**
	 * category has to be something or default is returned
	 */
	function test_xmlrpc_getpostcategory_missing() {

		$this->assertEquals( 'post_default_category' , xmlrpc_getpostcategory( '<category></category>' ) );
	}

	/**
	 * return space
	 */
	function test_xmlrpc_getpostcategory_space() {

		$this->assertEquals( array( '' ) , xmlrpc_getpostcategory( '<category> </category>' ) );
	}

	/**
	 * nest categorys tern bad string
	 */
	function test_xmlrpc_getpostcategory_category() {

		$this->assertEquals( array( '<category>category' ), xmlrpc_getpostcategory( '<category> <category>category</category> </category>' ) );

	}

	/**
	 * inluded any tag in the category
	 */
	function test_xmlrpc_getpostcategory_span() {

		$this->assertEquals( array( '<span>category</span>' ), xmlrpc_getpostcategory( '<category> <span>category</span> </category>' ) );
	}


	/**
	 * bad opening tag
	 */
	function test_xmlrpc_getpostcategory_bad_open_tag() {

		$this->assertEquals( 'post_default_category' , xmlrpc_getpostcategory( '<category <span>category</span> </category>' ) );
	}

	/**
	 * bad closing tag
	 */
	function test_xmlrpc_getpostcategory_bad_close_tag() {

		$this->assertEquals( 'post_default_category' , xmlrpc_getpostcategory( '<category>category</category dddddd>' ) );
	}

	/**
	 * dosen't find category if attribute set
	 */
	function test_xmlrpc_getpostcategory_attribute_in_tag() {

		$this->assertEquals( 'post_default_category' , xmlrpc_getpostcategory( '<category id="id">category</category>' ) );
	}

	/**
	 * find just the frist category
	 */
	function test_xmlrpc_getpostcategory_2_categorys() {

		$this->assertEquals( array( 'category1' ) , xmlrpc_getpostcategory( '<category>category1</category><category>category2</category>' ) );
	}

	/**
	 * pass cdata
	 */
	function test_xmlrpc_getpostcategory_cdata() {

		$this->assertEquals( array( '<![CDATA["category"]]>' ), xmlrpc_getpostcategory( '<category><![CDATA["category"]]></category>' ) );
	}

	/**
	 * pass cdata with tag category
	 */
	function test_xmlrpc_getpostcategory_bad_cdate() {

		$this->assertEquals( array( '<![CDATA["<category>category' ) , xmlrpc_getpostcategory( '<category><![CDATA["<category>category</category>"]]></category>' ) );
	}
}
