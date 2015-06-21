<?php
    namespace BT\SickMartyr;

    use Faker;

    require_once( "app/Campaign.php" );
    require_once( "app/CampaignData.php" );
    require_once( "app/CampaignReward.php" );
    require_once( "app/FakerProviders/ProjectNameProvider.php" );

    /**
     * Class Campaign
     * @package BT\SickMartyr
     */
    class Campaign
    {
        public static $owner_type = [ "male", "female", "company" ];

        public function generateCampaign()
        {
            global $generated_seed;

            $fake = Faker\Factory::create();
            $fake->addProvider( new ProjectNameProvider( $fake ) );

            $camp = new CampaignData();

            $camp->Seed = $generated_seed;

            // Owner
            $camp->OwnerName = $camp->OwnerName = $fake->name( $camp->OwnerGender );
            $camp->OwnerType = $fake->randomElement( static::$owner_type );


            // Project
            $camp->ProjectName = $fake->projectName; // TODO: needs improvement
            $camp->ProjectType = $fake->projectType;

            $camp->NumBackers = mt_rand( 0, 1000000 );

            $camp->Goal    = ( 1 + $fake->randomNumber( 2 ) ) * 100000;
            $camp->Pledged = $camp->Goal - mt_rand( 0, $camp->Goal );

            $camp->DaysToGo = 1 + mt_rand( 0, 30 );

            // Rewards
            $camp->Rewards = $this->generateRewards( $camp );

//            print_r( $camp );
//            die;
            return $camp;
        }

        /**
         * @param $campaign
         * @return array
         */
        private function generateRewards( &$campaign )
        {
            $rewards = [ ];

            return $rewards;

        }
    }