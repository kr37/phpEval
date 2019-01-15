<?php
/**
 * PHP Eval plugin for Craft CMS 3.x
 *
 * 1. Adds a twig filter to allow arbitrary PHP in Twig
2. Adds a twig function to allow arbitrary PHP in Twig
There are reasons why the authors of Craft and Twig have prevented this, but who doesn't love PHP Eval? Just be careful not to wipe your system.
 *
 * @link      https://github.com/kr37/phpEval
 * @copyright Copyright (c) 2019 KR37
 */

namespace kr37\phpeval\twigextensions;

use kr37\phpeval\PhpEval;

use Craft;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    KR37
 * @package   PhpEval
 * @since     0.0.1
 */
class PhpEvalTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'PhpEval';
    }

    /**
     * Returns an array of Twig filters, used in Twig templates via:
     *
     *      {{ 'echo "Hello World!";' | php }}
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('php', [$this, 'phpEvalFunction']),
        ];
    }

    /**
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% set this = php('something') %}
     *
    * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('php', [$this, 'phpEvalFunction']),
        ];
    }

    /**
     * Our function called via Twig; it can do anything you want
     *
     * @param null $text
     *
     * @return string
     */
    public function phpEvalFunction($text = null)
    {
        return eval($text);
    }
}
