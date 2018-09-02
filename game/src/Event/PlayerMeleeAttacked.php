<?php

namespace lokothodida\Tournament\Event;

final class PlayerMeleeAttacked extends Event
{
	private $attackerName;
	private $opponentName;
	private $damageDealt;
	private $kiReduced;

	public function __construct(
		string $attackerName,
		string $opponentName,
		int $damageDealt,
		int $kiReduced
	) {
		$this->attackerName = $attackerName;
		$this->opponentName = $opponentName;
		$this->damageDealt = $damageDealt;
		$this->kiReduced = $kiReduced;
	}

	public function name(): string
	{
		return 'PlayerMeleeAttacked';
	}

	public function payload(): array
	{
		return [
			'attackerName' => $this->attackerName,
			'opponentName' => $this->opponentName,
			'damageDealt' => $this->damageDealt,
			'kiReduced' => $this->kiReduced,
		];
	}
}
