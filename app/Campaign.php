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
        public function generateCampaign()
        {
            $fake = Faker\Factory::create();
            $fake->addProvider( new ProjectNameProvider( $fake ) );

            $camp = new CampaignData();

            // Owner
            $camp->OwnerGender = ( rand( 0, 1 ) ? "male" : "female" );
            $camp->OwnerName   = $fake->name( $camp->OwnerGender );

            // Project
            $camp->ProjectName = $fake->projectName; // TODO: needs improvement
            $camp->ProjectType = $fake->projectType;

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