<?php

/**
 * This file is part of the YetORM library
 *
 * Copyright (c) 2013, 2014 Petr Kessler (http://kesspess.1991.cz)
 *
 * @license  MIT
 * @link     https://github.com/uestla/YetORM
 */

namespace YetORM\Reflection;

class MethodProperty extends EntityProperty
{

	/** @var string */
	private $getterName;

	/** @var string */
	private $setterName;

	public function __construct(EntityType $reflection, $name, $readonly, $type, $getter, $setter)
	{
		parent::__construct($reflection, $name, $readonly, $type);

		$this->getterName = $getter;
		$this->setterName = $setter;
	}

	public function getGetterName()
	{
		return $this->getterName;
	}

	public function getSetterName()
	{
		return $this->setterName;
	}

	public function setGetterName($getterName)
	{
		$this->getterName = $getterName;
	}

	public function setSetterName($setterName)
	{
		$this->setterName = $setterName;
	}

}
