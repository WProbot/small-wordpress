# Plugin updates
wp plugin update --all
wp plugin update --all --skip-plugins --skip-themes

# Theme updates
wp theme update --all
wp theme update --all --skip-plugins --skip-themes

# Core updates
wp core update
wp core update-db

# Core updates on multisite network
if $( wp core is-installed --network ); then 
    wp core update-db --network
fi

# Handle WooCommerce database updates if installed
if $( wp plugin is-installed woocommerce ); then 
    wp wc update
fi

# Handle WooCommerce database updates on multisite if installed
if $( wp plugin is-installed woocommerce ) && $( wp core is-installed --network ); then 
    for site_id in $( wp site list --field=blog_id ); do
        site_url=$( wp site list --field=url --blog_id=${site_id} )
        if $( wp plugin is-active woocommerce --url=$site_url ); then
            wp wc update --url=${site_url}
        fi
    done
fi

# Handle Elementor database updates if installed
if $( wp plugin is-installed elementor ); then 
    wp elementor update db
    # Handle Elementor database updates on multisite
    if $( wp core is-installed --network ); then 
        wp elementor update db --network
    fi
fi

# Handle redirection database updates if installed
if $( wp plugin is-installed redirection ); then 
    wp redirection database upgrade
fi
