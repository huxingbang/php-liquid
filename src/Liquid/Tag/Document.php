<?php

namespace Liquid\Tag;

use Liquid\BlankFileSystem;

/**
 * This class represents the entire template document.
 */
class Document extends AbstractBlock
{
	/**
	 * Constructor.
	 *
	 * @param array $tokens
	 * @param BlankFileSystem $fileSystem
	 *
	 * todo: reference?
	 */
	public function __construct(array $tokens, &$fileSystem) {
		$this->fileSystem = $fileSystem;
		$this->parse($tokens);
	}

	/**
	 * Check for cached includes
	 *
	 * @return string
	 */
	public function checkIncludes() {
		// todo: isObject

		foreach ($this->nodelist as $token) {
			if (is_object($token)) {
				if ($token instanceof TagInclude || $token instanceof TagExtends) {
					/** @var TagInclude|TagExtends $token */
					if ($token->checkIncludes() == true) {
						return true;
					}
				}
			}
		}

		return false;
	}

	/**
	 * There isn't a real delimiter
	 *
	 * @return string
	 *
	 * todo: need?
	 */
	protected function blockDelimiter() {
		return '';
	}

	/**
	 * Document blocks don't need to be terminated since they are not actually opened
	 *
	 * todo: need?
	 */
	protected function assertMissingDelimitation() {
	}
}
