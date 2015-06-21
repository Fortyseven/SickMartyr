<?php


    define( 'TEMPLATE_PATH', __DIR__ . "/resources/templates/" );
    define( 'CACHE_PATH', __DIR__ . "/cache/" );

    define( 'ENABLE_CACHE', false );

    require_once( "vendor/autoload.php" );
    require_once( "app/Campaign.php" );

    use BT\SickMartyr;



    function make_seed()
    {
        list( $usec, $sec ) = explode( ' ', microtime() );

        return (float)$sec + ( (float)$usec * 100000 );
    }

    $generated_seed = make_seed();

    class App
    {
        /* @var Twig_Environment */
        private $_twig;

        /* @var Twig_Loader_Filesystem */
        private $_loader;


        function Init()
        {
            global $generated_seed;

            Twig_Autoloader::register();

            mt_srand( $generated_seed );

            $this->_loader = new Twig_Loader_Filesystem( TEMPLATE_PATH );
            $this->_twig   = new Twig_Environment( $this->_loader,
                                                   [ 'cache' => ENABLE_CACHE ? CACHE_PATH : null ] );
        }

        function Start()
        {
            $template = null;

            try {
                $template = $this->_twig->loadTemplate( "index.html.twig" );
                $camp     = new BT\SickMartyr\Campaign();
                echo $template->render( [ "camp" => $camp->generateCampaign() ] );
            }
            catch ( Exception $e ) {
                echo "Error doing at hing: " . $e;
            }
        }
    }

    $app = new App();
    $app->Init();
    $app->Start();
