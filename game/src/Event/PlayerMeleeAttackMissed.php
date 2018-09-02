<?php

namespace lokothodida\Tournament\Event;

final class PlayerMeleeAttackMissed extends Event
{
	private $attackerName;
	private $targetQuadrant;

	public function __construct(string $attackerName, int $targetQuadrant)
	{
		$this->attackerName = $attackerName;
		$this->targetQuadrant = $targetQuadrant;
	}

	public function name(): string
	{
		return 'PlayerMeleeAttackMissed';
	}

	public function payload(): array
	{
		return [
			'attackerName' => $this->attackerName,
			'targetQuadrant' => $this->targetQuadrant,
		];
	}
}
