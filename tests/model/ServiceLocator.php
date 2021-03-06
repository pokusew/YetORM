<?php


class ServiceLocator
{

	/** @var Nette\Caching\Storages\FileStorage */
	private static $cacheStorage = NULL;

	/** @var Nette\Database\Context */
	private static $dbContext = NULL;

	/** @var Model\Repositories\BookRepository */
	private static $bookRepository = NULL;

	/** @var Model\Repositories\AuthorRepository */
	private static $authorRepository = NULL;

	/** @var Model\Services\BookService */
	private static $bookService = NULL;


	/** @return Nette\Caching\Storages\FileStorage */
	static function getCacheStorage()
	{
		if (self::$cacheStorage === NULL) {
			self::$cacheStorage = new Nette\Caching\Storages\FileStorage(__DIR__ . '/../temp');
		}

		return self::$cacheStorage;
	}


	/** @return Nette\Database\Context */
	static function getDbContext()
	{
		if (self::$dbContext === NULL) {
			self::$dbContext = new Nette\Database\Context(
					$connection = new Nette\Database\Connection('mysql:host=localhost;dbname=yetorm_test', 'root', ''),
					new Nette\Database\Reflection\DiscoveredReflection($connection, self::getCacheStorage()),
					self::getCacheStorage()
			);

			Nette\Database\Helpers::loadFromFile($connection, __DIR__ . '/db.sql');
		}

		return self::$dbContext;
	}


	/** @return Model\Repositories\BookRepository */
	static function getBookRepository()
	{
		if (self::$bookRepository === NULL) {
			self::$bookRepository = new Model\Repositories\BookRepository(self::getDbContext(), __DIR__ . '/books');
		}

		return self::$bookRepository;
	}


	/** @return Model\Repositories\AuthorRepository */
	static function getAuthorRepository()
	{
		if (self::$authorRepository === NULL) {
			self::$authorRepository = new Model\Repositories\AuthorRepository(self::getDbContext());
		}

		return self::$authorRepository;
	}


	/** @return Model\Services\BookService */
	static function getBookFacade()
	{
		if (self::$bookService === NULL) {
			self::$bookService = new Model\Services\BookService(self::getBookRepository());
		}

		return self::$bookService;
	}

}
