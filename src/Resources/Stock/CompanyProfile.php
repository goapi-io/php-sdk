<?php
namespace GOAPI\IO\Resources\Stock;

class CompanyProfile {

    public function __construct(
        public $symbol, 
        public $name, 
        public $about, 
        public $logo, 
        public $npwp, 
        public $phone, 
        public $fax, 
        public $email, 
        public $sector_name, 
        public $status, 
        public $sub_industry_name, 
        public $sub_sector_name, 
        public $website, 
        public $address, 
        public $ipo_fund_raised, 
        public $ipo_listing_date, 
        public $ipo_offering_shares, 
        public $ipo_percentage, 
        public $ipo_securities_administration_bureau, 
        public $ipo_total_listed_shares, 
        public $ipo_founders_shares, 
        public $secretary, 
        public $commissioners, 
        public $directors, 
        public $shareholders
    ) {}


    public static function fromArray(array $data) {
        return new CompanyProfile(
            symbol: $data['symbol'],
            name: $data['name'],
            about: $data['about'],
            logo: $data['logo'],
            npwp: $data['npwp'],
            phone: $data['phone'],
            fax: $data['fax'],
            email: $data['email'],
            sector_name: $data['sector_name'],
            status: $data['status'],
            sub_industry_name: $data['sub_industry_name'],
            sub_sector_name: $data['sub_sector_name'],
            website: $data['website'],
            address: $data['address'],
            ipo_fund_raised: $data['ipo_fund_raised'],
            ipo_listing_date: $data['ipo_listing_date'],
            ipo_offering_shares: $data['ipo_offering_shares'],
            ipo_percentage: $data['ipo_percentage'],
            ipo_securities_administration_bureau: $data['ipo_securities_administration_bureau'],
            ipo_total_listed_shares: $data['ipo_total_listed_shares'],
            ipo_founders_shares: $data['ipo_founders_shares'],
            secretary: $data['secretary'],
            commissioners: $data['commissioners'],
            directors: $data['directors'],
            shareholders: $data['shareholders']
        );
    }
}