<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Data;
use Grav\Common\Page\Collection;
use Grav\Common\Page\Page;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class ShoppingcartPayWhatYouWantPlugin
 * @package Grav\Plugin
 */
class ShoppingcartPayWhatYouWantPlugin extends Plugin
{
    public $features = [
        'blueprints' => 1000,
    ];

    protected $plugin_name = 'shoppingcart-pay-what-you-want';

    protected $gateway;


    /*
        TODO:
        - Implement on product variations
    */

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
            'onBlueprintCreated' => ['onBlueprintCreated', 0],
            // 'onPageInitialized' => ['onPageInitialized', 0],
            // 'onCollectionProcessed' => ['onCollectionProcessed', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
        ];
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    // /**
    //  * Add assets to the frontend
    //  */
    // public function onAssetsInitialized()
    // {
    //     if ($this->config->get('plugins.shoppingcart.ui.use_own_css')) {
    //         $this->grav['assets']->add('plugin://shoppingcart-product-variations/css/style.css');
    //     }
    // }

    /**
     */
    public function onTwigSiteVariables()
    {
        //@todo move to other place
        $this->grav['assets']->addJs('plugin://' . $this->plugin_name . '/js/script.js');
    }

    public function onPageInitialized()
    {
        // if (!$this->isAdmin()) {
        //     /** @var Page $page */
        //     $page = $this->grav['page'];

        //     if ($page->header() != null) {
        //         if (isset($page->header()->pay_what_you_want)) {
        //             $content = $this->grav['twig']->processTemplate('partials/shoppingcart-pay-what-you-want.html.twig', ['page' => $page]);
        //             $this->grav['twig']->twig_vars['shoppingcart_output_page_product_before_add_to_cart'] = $content;
        //         }
        //     }
        // }
    }

    // public function onCollectionProcessed(Event $event)
    // {
    //     /** @var Collection $collection */
    //     $collection = $event['collection'];

    //     foreach ($collection as $slug => $page) {
    //         $header = $page->header();
    //         print_r($header);
    //         if ($page->header()->pay_what_you_want) {
    //             $content = $this->grav['twig']->processTemplate('partials/shoppingcart-pay-what-you-want.html.twig', ['page' => $page]);
    //             $this->grav['twig']->twig_vars['shoppingcart_output_page_product_before_add_to_cart'] = $content;
    //         }
    //     }
    // }

    /**
     * Enable search only if url matches to the configuration.
     */
    public function onPluginsInitialized()
    {
        if (!$this->isAdmin()) {
            // Site
            // $this->config->set('plugins.shoppingcart', array_replace_recursive($this->config->get('plugins.shoppingcart'), $this->config->get('plugins.shoppingcart-product-variations')));

            $this->enable([
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
                // 'onAssetsInitialized' => ['onAssetsInitialized', 0]
            ]);
        }
    }

    /**
     * Extend page blueprints with configuration options.
     *
     * @param Event $event
     *
     * @todo only extend `product` pages
     */
    public function onBlueprintCreated(Event $event)
    {
        /** @var Data\Blueprint $blueprint */
        $blueprint = $event['blueprint'];

        if ($event['type'] !== 'shoppingcart_product') {
            return;
        }

        if ($blueprint->get('form/fields/tabs', null, '/')) {
            $blueprints = new Data\Blueprints(__DIR__ . '/blueprints/');
            $extends = $blueprints->get('pay-what-you-want');
            $blueprint->extend($extends, true);
        }
    }

}