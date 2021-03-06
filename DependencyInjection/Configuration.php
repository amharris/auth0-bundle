<?php

namespace Happyr\Auth0Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('happyr_auth0');
        // Keep compatibility with symfony/config < 4.2
        if (!method_exists($treeBuilder, 'getRootNode')) {
            $root = $treeBuilder->root('happyr_auth0');
        } else {
            $root = $treeBuilder->getRootNode();
        }

        $root
            ->children()
                ->scalarNode('domain')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('login_domain')->defaultNull()->info('If you configured SSO with a custom domain.')->end()
                ->scalarNode('client_id')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('client_secret')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('cache')->defaultNull()->end()
                ->scalarNode('httplug_client_service')->defaultNull()->end()
                ->scalarNode('scope')->defaultValue('')->info('Seperated with space')->end()
                ->scalarNode('audience')->defaultNull()->end()
            ->end();

        return $treeBuilder;
    }
}
