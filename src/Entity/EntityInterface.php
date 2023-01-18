<?php

declare(strict_types=1);

namespace DevBase\Bundle\UserBundle\Entity;

interface EntityInterface
{
	public function getId(): ?int;

	public function setId(?int $id): self;
}
