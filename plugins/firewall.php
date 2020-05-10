
add_action('plugins_loaded', 'fixer9_firewall', 10, 0);

function fixer9_firewall() {

  $status = 0;

  if (empty($_SERVER['REQUEST_URI']) == false) {
        $hostile = implode('|', apply_filters('fixer9_firewall_request_uri_filter', array(
            '@eval',
            'eval\(',
            'UNION(.*)SELECT',
            '\(null\)',
            'base64_',
            '\/localhost',
            '\%2Flocalhost',
            '\/pingserver',
            'wp-config\.php',
            '\/config\.',
            '\/wwwroot',
            '\/makefile',
            'crossdomain\.',
            'proc\/self\/environ',
            'usr\/bin\/perl',
            'var\/lib\/php',
            'etc\/passwd',
            '\/https\:',
            '\/http\:',
            '\/ftp\:',
            '\/file\:',
            '\/php\:',
            '\/cgi\/',
            '\.cgi',
            '\.cmd',
            '\.bat',
            '\.exe',
            '\.sql',
            '\.ini',
            '\.dll',
            '\.htacc',
            '\.htpas',
            '\.pass',
            '\.asp',
            '\.jsp',
            '\.bash',
            '\/\.git',
            '\/\.svn',
            ' ',
            '\<',
            '\>',
            '\/\=',
            '\.\.\.',
            '\+\+\+',
            '@@',
            '\/&&',
            '\/Nt\.',
            '\;Nt\.',
            '\=Nt\.',
            '\,Nt\.',
            '\.exec\(',
            '\)\.html\(',
            '\{x\.html\(',
            '\(function\(',
            '\.php\([0-9]+\)',
            '(benchmark|sleep)(\s|%20)*\(',
            'indoxploi',
            'xrumer'
        )));

        if (empty($hostile) == false) {
            if (preg_match(sprintf('#%s#i', $hostile), $_SERVER['REQUEST_URI']) == 1) {
                $status = $status + 1;
            }
        }
    }

    if (empty($_SERVER['QUERY_STRING']) == false) {
        $hostile = implode('|', apply_filters('fixer9_firewall_query_string_filter', array(
            '@@',
            '\(0x',
            '0x3c62723e',
            '\;\!--\=',
            '\(\)\}',
            '\:\;\}\;',
            '\.\.\/',
            '127\.0\.0\.1',
            'UNION(.*)SELECT',
            '@eval',
            'eval\(',
            'base64_',
            'localhost',
            'loopback',
            '\%0A',
            '\%0D',
            '\%00',
            '\%2e\%2e',
            'allow_url_include',
            'auto_prepend_file',
            'disable_functions',
            'input_file',
            'execute',
            'file_get_contents',
            'mosconfig',
            'open_basedir',
            '(benchmark|sleep)(\s|%20)*\(',
            'phpinfo\(',
            'shell_exec\(',
            '\/wwwroot',
            '\/makefile',
            'path\=\.',
            'mod\=\.',
            'wp-config\.php',
            '\/config\.',
            '\$_SESSION',
            '\$_REQUEST',
            '\$_ENV',
            '\$_SERVER',
            '\$_POST',
            '\$_GET',
            'indoxploi',
            'xrumer'
        )));

        if (empty($hostile) == false) {
            if (preg_match(sprintf('#%s#i', $hostile), $_SERVER['QUERY_STRING']) == 1) {
                $status = $status + 2;
            }
        }
    }

    if (empty($_SERVER['HTTP_USER_AGENT']) == false) {
        $hostile = implode('|', apply_filters('fixer9_firewall_user_agent_filter', array(
           'MJ12bot',
           'Mb2345Browser',
           'zh-CN',
           'Language\.zh_CN',
           'LieBaoFast',
            'acapbot',
            '\/bin\/bash',
            'binlar',
            'casper',
            'cmswor',
            'diavol',
            'dotbot',
            'finder',
            'flicky',
            'genieo',
            'grapeshot',
            'md5sum',
            'morfeus',
            'nutch',
            'paperlibot',
            'planet',
            'purebot',
            'pycurl',
            'semalt',
            'seznam',
            'shellshock',
            'skygrid',
            'snoopy',
            'sucker',
            'turnit',
            'vikspi',
            'zmeu'
        )));

        if (empty($hostile) == false) {
            if (preg_match(sprintf('#%s#i', $hostile), $_SERVER['HTTP_USER_AGENT']) == 1) {
                $status = $status + 4;
            }
        }
    }


  if(! is_user_logged_in()) {
    if (empty($_SERVER['REQUEST_URI']) == false) {
        $lhostile = implode('|', apply_filters('fixer9_firewall_request_uri_filter', array(
            'wp-json\/wp\/v[0-9]\/users'
        )));

        if (empty($lhostile) == false) {
            if (preg_match(sprintf('#%s#i', $lhostile), $_SERVER['REQUEST_URI']) == 1) {
                $status = $status + 8;
            }
        }
      }
    }



    if ($status > 0) {
        do_action('fixer9_firewall_403', $status);
        header('HTTP/1.1 403 Forbidden');
        header('Status: 403 Forbidden');
        header('Connection: Close');
        exit();
    }
}

