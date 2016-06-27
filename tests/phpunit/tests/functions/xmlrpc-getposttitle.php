<?php

/**
 * Class Tests_Xmlrpc_Getposttitle
 * test the xmlrpc_getposttitle function
 */
class Tests_Xmlrpc_Getposttitle extends WP_UnitTestCase {

	/**
	 * setup
	 * declare the default title needed in function
	 */
	function setup() {
		global $post_default_title;
		$post_default_title = 'post_default_title';
	}

	/**
	 * remove global
	 */
	function tearDown() {
		global $post_default_title;
		$post_default_title = null;
	}


	/**
	 * pass null
	 */
	function test_xmlrpc_getposttitle_null() {
		$this->assertEquals( 'post_default_title' , xmlrpc_getposttitle( null ) );
	}

	/**
	 * pass good title in test
	 */
	function test_xmlrpc_getposttitle_good() {

		$this->assertEquals( 'good_title' , xmlrpc_getposttitle( '<title>good_title</title>' ) );
	}
	/**
	 * pass good title in lot of content
	 */
	function test_xmlrpc_getposttitle_good_in_post_tag() {

		$this->assertEquals( 'good_title' , xmlrpc_getposttitle( '<post><title>good_title</title><cat>fsdfsfsf</cat></post>' ) );
	}
	/**
	 * missing close
	 */
	function test_xmlrpc_getposttitle_bad() {

		$this->assertEquals( 'post_default_title', xmlrpc_getposttitle( '<title>good_title<title>ssssss' ) );
	}

	/**
	 * title has to be something or default is returned
	 */
	function test_xmlrpc_getposttitle_missing() {

		$this->assertEquals( 'post_default_title' , xmlrpc_getposttitle( '<title></title>' ) );
	}

	/**
	 * return space
	 */
	function test_xmlrpc_getposttitle_space() {

		$this->assertEquals( '' , xmlrpc_getposttitle( '<title> </title>' ) );
	}

	/**
	 * nest titles tern bad string
	 */
	function test_xmlrpc_getposttitle_title() {

		$this->assertEquals( ' <title>title' , xmlrpc_getposttitle( '<title> <title>title</title> </title>' ) );

	}

	/**
	 * inluded any tag in the title
	 */
	function test_xmlrpc_getposttitle_span() {

		$this->assertEquals( ' <span>title</span> ' , xmlrpc_getposttitle( '<title> <span>title</span> </title>' ) );
	}


	/**
	 * bad opening tag
	 */
	function test_xmlrpc_getposttitle_bad_open_tag() {

		$this->assertEquals( 'post_default_title' , xmlrpc_getposttitle( '<title <span>title</span> </title>' ) );
	}

	/**
	 * bad closing tag
	 */
	function test_xmlrpc_getposttitle_bad_close_tag() {

		$this->assertEquals( 'post_default_title' , xmlrpc_getposttitle( '<title>title</title dddddd>' ) );
	}


	/**
	 * dosen't find title if attribute set
	 */
	function test_xmlrpc_getposttitle_attribute_in_tag() {

		$this->assertEquals( 'post_default_title' , xmlrpc_getposttitle( '<title id="id">title</title>' ) );
	}

	/**
	 * find just the frist title
	 */
	function test_xmlrpc_getposttitle_2_titles() {

		$this->assertEquals( 'title1' , xmlrpc_getposttitle( '<title>title1</title><title>title2</title>' ) );
	}

	/**
	 * pass cdata
	 */
	function test_xmlrpc_getposttitle_cdata() {

		$this->assertEquals( '<![CDATA["title"]]>' , xmlrpc_getposttitle( '<title><![CDATA["title"]]></title>' ) );
	}

	/**
	 * pass cdata with tag title
	 */
	function test_xmlrpc_getposttitle_bad_cdate() {

		$this->assertEquals( '<![CDATA["<title>title' , xmlrpc_getposttitle( '<title><![CDATA["<title>title</title>"]]></title>' ) );
	}
}
