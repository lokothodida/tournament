<?php

namespace lokothodida\Tournament\Cli;

interface IoChannel
{
	public function prompt(string $withMessage): string;
	public function write(string $message): void;
	public function writeLine(string $message): void;
}
