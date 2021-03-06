<?php

namespace Folklore\GraphQL\Console;

use Illuminate\Console\GeneratorCommand;
use Config;

class InterfaceMakeCommand extends GeneratorCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'make:graphql:interface {name}';


	/**
	* The console command description.
	*
	* @var string
	*/
	protected $description = 'Create a new GraphQL interface class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Interface';


	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub() {
		return __DIR__.'/stubs/interface.stub';
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace.'\GraphQL\Interfaces';
	}

	/**
	 * Build the class with the given name.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function buildClass($name)
	{
		$stub = parent::buildClass($name);

		return $this->replaceType($stub, $name);
	}

	/**
	 * Replace the namespace for the given stub.
	 *
	 * @param  string  $stub
	 * @param  string  $name
	 * @return $this
	 */
	protected function replaceType($stub, $name)
	{
		preg_match('/([^\\\]+)$/', $name, $matches);
		$stub = str_replace(
			'DummyType',
			$matches[1],
			$stub
		);

		return $stub;
	}
}
