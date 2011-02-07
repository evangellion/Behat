<?php

namespace Behat\Behat\Hook\Loader;

/*
 * This file is part of the Behat.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * PHP-files hooks loader.
 *
 * @author      Konstantin Kudryashov <ever.zet@gmail.com>
 */
class PhpFileLoader implements LoaderInterface
{
    /**
     * Loaded hooks
     *
     * @var     array
     */
    protected $hooks = array();

    /**
     * {@inheritdoc}
     */
    public function load($resource)
    {
        $this->hooks = array(
            'suite.before'      => array(),
            'suite.after'       => array(),
            'feature.before'    => array(),
            'feature.after'     => array(),
            'scenario.before'   => array(),
            'scenario.after'    => array(),
            'step.before'       => array(),
            'step.after'        => array()
        );
        $hooks = $this;

        require_once $resource;

        return $this->hooks;
    }

    /**
     * Hook into "suite.before".
     *
     * @param   callback    $callback   hook callback
     */
    public function beforeSuite($callback)
    {
        $this->hooks['suite.before'][] = $callback;
    }

    /**
     * Hook into "suite.after".
     *
     * @param   callback    $callback   hook callback
     */
    public function afterSuite($callback)
    {
        $this->hooks['suite.after'][] = $callback;
    }

    /**
     * Hook into "feature.before".
     *
     * @param   string      $filter     filter string (tags or name)
     * @param   callback    $callback   hook callback
     */
    public function beforeFeature($filter, $callback)
    {
        $this->hooks['feature.before'][] = array($filter, $callback);
    }

    /**
     * Hook into "feature.after".
     *
     * @param   string      $filter     filter string (tags or name)
     * @param   callback    $callback   hook callback
     */
    public function afterFeature($filter, $callback)
    {
        $this->hooks['feature.after'][] = array($filter, $callback);
    }

    /**
     * Hook into "scenario.before" OR "outline.example.before".
     *
     * @param   string      $filter     filter string (tags or name)
     * @param   callback    $callback   hook callback
     */
    public function beforeScenario($filter, $callback)
    {
        $this->hooks['scenario.before'][] = array($filter, $callback);
    }

    /**
     * Hook into "scenario.after" OR "outline.example.after".
     *
     * @param   string      $filter     filter string (tags or name)
     * @param   callback    $callback   hook callback
     */
    public function afterScenario($filter, $callback)
    {
        $this->hooks['scenario.after'][] = array($filter, $callback);
    }

    /**
     * Hook into "step.before".
     *
     * @param   string      $filter     filter string (tags or name)
     * @param   callback    $callback   hook callback
     */
    public function beforeStep($filter, $callback)
    {
        $this->hooks['step.before'][] = array($filter, $callback);
    }

    /**
     * Hook into "step.after".
     *
     * @param   string      $filter     filter string (tags or name)
     * @param   callback    $callback   hook callback
     */
    public function afterStep($filter, $callback)
    {
        $this->hooks['step.after'][] = array($filter, $callback);
    }
}
