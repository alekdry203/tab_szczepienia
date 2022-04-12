<?php

/**
 * Tests KO7 inflector class
 *
 * @group ko7
 * @group ko7.core
 * @group ko7.core.inflector
 *
 * @package    KO7
 * @category   Tests
 *
 * @author     Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright  (c) 2007-2016  Kohana Team
 * @copyright  (c) since 2016 Koseven Team
 * @license    https://koseven.dev/LICENSE
 */
class KO7_InflectorTest extends Unittest_TestCase
{
	/**
	 * Provides test data for test_lang()
	 *
	 * @return array
	 */
	public function provider_uncountable()
	{
		return [
			// $value, $result
			['fish', TRUE],
			['cat', FALSE],
			['deer', TRUE],
			['bison', TRUE],
			['friend', FALSE],
		];
	}

	/**
	 * Tests Inflector::uncountable
	 *
	 * @test
	 * @dataProvider provider_uncountable
	 * @param boolean $input  Input for File::mime
	 * @param boolean $expected Output for File::mime
	 */
	public function test_uncountable($input, $expected)
	{
		$this->assertSame($expected, Inflector::uncountable($input));
	}

	/**
	 * Provides test data for test_lang()
	 *
	 * @return array
	 */
	public function provider_singular()
	{
		return [
			// $value, $result
			['fish', NULL, 'fish'],
			['cats', NULL, 'cat'],
			['cats', 2, 'cats'],
			['cats', '2', 'cats'],
			['children', NULL, 'child'],
			['meters', 0.6, 'meters'],
			['meters', 1.6, 'meters'],
			['meters', 1.0, 'meter'],
			['status', NULL, 'status'],
			['statuses', NULL, 'status'],
			['heroes', NULL, 'hero'],
		];
	}

	/**
	 * Tests Inflector::singular
	 *
	 * @test
	 * @dataProvider provider_singular
	 * @param boolean $input  Input for File::mime
	 * @param boolean $expected Output for File::mime
	 */
	public function test_singular($input, $count, $expected)
	{
		$this->assertSame($expected, Inflector::singular($input, $count));
	}

	/**
	 * Provides test data for test_lang()
	 *
	 * @return array
	 */
	public function provider_plural()
	{
		return [
			// $value, $result
			['fish', NULL, 'fish'],
			['cat', NULL, 'cats'],
			['cats', 1, 'cats'],
			['cats', '1', 'cats'],
			['movie', NULL, 'movies'],
			['meter', 0.6, 'meters'],
			['meter', 1.6, 'meters'],
			['meter', 1.0, 'meter'],
			['hero', NULL, 'heroes'],
			['Dog', NULL, 'Dogs'], // Titlecase
			['DOG', NULL, 'DOGS'], // Uppercase
		];
	}

	/**
	 * Tests Inflector::plural
	 *
	 * @test
	 * @dataProvider provider_plural
	 * @param boolean $input  Input for File::mime
	 * @param boolean $expected Output for File::mime
	 */
	public function test_plural($input, $count, $expected)
	{
		$this->assertSame($expected, Inflector::plural($input, $count));
	}

	/**
	 * Provides test data for test_camelize()
	 *
	 * @return array
	 */
	public function provider_camelize()
	{
		return [
			// $value, $result
			['mother cat', 'camelize', 'motherCat'],
			['kittens in bed', 'camelize', 'kittensInBed'],
			['mother cat', 'underscore', 'mother_cat'],
			['kittens in bed', 'underscore', 'kittens_in_bed'],
			['kittens-are-cats', 'humanize', 'kittens are cats'],
			['dogs_as_well', 'humanize', 'dogs as well'],
		];
	}

	/**
	 * Tests Inflector::camelize
	 *
	 * @test
	 * @dataProvider provider_camelize
	 * @param boolean $input  Input for File::mime
	 * @param boolean $expected Output for File::mime
	 */
	public function test_camelize($input, $method, $expected)
	{
		$this->assertSame($expected, Inflector::$method($input));
	}

	/**
	 * Provides data for test_decamelize()
	 *
	 * @return array
	 */
	public function provider_decamelize()
	{
		return [
			['getText', '_', 'get_text'],
			['getJSON', '_', 'get_json'],
			['getLongText', '_', 'get_long_text'],
			['getI18N', '_', 'get_i18n'],
			['getL10n', '_', 'get_l10n'],
			['getTe5t1ng', '_', 'get_te5t1ng'],
			['OpenFile', '_', 'open_file'],
			['CloseIoSocket', '_', 'close_io_socket'],
			['fooBar', ' ', 'foo bar'],
			['camelCase', '+', 'camel+case'],
		];
	}

	/**
	 * Tests Inflector::decamelize()
	 *
	 * @test
	 * @dataProvider provider_decamelize
	 * @param string $input Camelized string
	 * @param string $glue Glue
	 * @param string $expected Expected string
	 */
	public function test_decamelize($input, $glue, $expected)
	{
		$this->assertSame($expected, Inflector::decamelize($input, $glue));
	}
}