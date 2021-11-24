<?php

declare(strict_types=1);


namespace App\Services;

use App\Core\Database\DB;
use App\Models\City;
use http\Encoding\Stream;

class CityService
{

    protected City $model;
    protected \PDO $db;

    public function __construct()
    {
        $this->model = new City();
        $this->db = DB::getInstance();
        \App\Core\Database\DB::setCharsetEncoding();
    }

    public function getAll()
    {
        try {
            $sqlExample = 'SELECT * FROM city';
            $stm = $this->db->query($sqlExample);
            return $stm->fetchAll(\PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function getCityById(string $id)
    {
        $sql = "SELECT * FROM city WHERE id=:id LIMIT 1";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);
            //$city = $stmt->fetch();
            $city = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            print $e->getMessage();
        }

        return $city[0];
    }

    public function convertIso3ToCountryCode(string $country_iso3): ?string
    {
        $map = $this->mapCodes();
        if (!array_key_exists($country_iso3, $map)) {
            return null;
        }
        return $map[$country_iso3];
    }

    public function getCityNameFromMapById(string $id): ?string
    {
        $map = $this->mapCities();
        if (!array_key_exists($id, $map)) {
            return null;
        }
        return $map[$id];
    }

    public function mapCodes(): array
    {
        return [
            'ARG' => 'AR',
            'AUS' => 'AU',
            'BHS' => 'BS',
            'BRA' => 'BR',
            'CAN' => 'CA',
            'ESP' => 'ES',
            'GBR' => 'GB',
            'ITA' => 'IT',
            'SWE' => 'SE',
            'TUR' => 'TR',
            'USA' => 'US',
            'ZAF' => 'ZA',
        ];
    }

    public function mapCities(): array
    {
        return [
            '040efa6e-3512-4523-a4dc-33e29aece663' => 'Phoenix',
            '09f3ad25-9bf8-4d7b-9ec2-4269a0ff53a2' => 'Londonderry',
            '0aa5711e-f664-4066-800a-286dfa3f3255' => 'Columbia',
            '16e88198-bcb5-4b09-8b59-22b76bd9d981' => 'Andros Island',
            '1fac4f2b-c8db-486c-a8cd-2cadd8043d03' => 'Port Clinton',
            '229333a3-eb63-4ee6-aa6c-b6ddd822a0e9' => 'Tampa',
            '237ae277-4e70-4460-bcb8-fddee21d5d76' => 'Burlington',
            '29936786-b63d-45b2-9bda-b1c6fc6e6bb3' => 'Madrid',
            '2d433491-cef5-4988-aab5-dbf224281da1' => 'Huntsville',
            '3da6a648-a7b2-49e7-85d7-6b6b5ca84fc4' => 'Athens/Albany',
            '3ef2f49f-7543-431e-890d-fceae99c97d8' => 'Jacksonville',
            '43fde9b9-1f74-48f3-8bdf-c3d129addf1c' => 'Orlando',
            '47b90fca-4963-4320-8e24-cb8201950d41' => 'Atlanta',
            '49286a1d-9f6c-4416-a8da-394357f55c87' => 'Ankara',
            '4df26c3c-f627-4f39-b1f7-7af9438dbd54' => 'Oklahoma City',
            '53a45876-337f-42fd-9cd1-fabd2dfbf440' => 'Dallas',
            '53d7b92d-7bca-4fa3-be12-6292a4d823a0' => 'Springfield',
            '6df684b8-fcf4-420d-82e5-736b2aa093fb' => 'Murcia',
            '746bdf1d-d154-46cd-b104-9415fcc39e35' => 'Johannesburg',
            '7661247f-7520-4036-a126-aaf3872b0166' => 'Las Vegas',
            '7aaf0015-2c77-4d67-b844-965e386765ba' => 'Fort Benning(Columbus)',
            '7f608a96-3963-4e13-b56c-b87ef454da54' => 'Istanbul',
            '80defa05-74a0-4624-9d8d-d275407f6f11' => 'Buffalo',
            '8b15cf16-e49d-452b-9408-965b12304edf' => 'Stockholm',
            '980a6174-b483-401a-b8f5-9c5a667086e3' => 'İzmir',
            '9be13639-6ba5-4b51-abaf-c9b3a4488319' => 'Washington',
            '9fcdbef1-cb98-450d-931f-9da015aee3fc' => 'Melbourne',
            'a64063a0-1afe-4d75-98b3-1d4ae6b028f8' => 'Wichita',
            'ae95e35a-aca7-4130-aa8e-e5fa145cb8c9' => 'Roma',
            'aeac1535-7308-40fd-805a-0cba99ad4ce4' => 'Sacramento',
            'c1011ee2-63e7-4c03-b5da-83307196f395' => 'Daytona Beach',
            'c4d4b130-08a2-4472-8d79-742a4ed20567' => 'Rio de Janeiro',
            'cb50327d-ef3e-457e-b91a-95ce8e9244fb' => 'Miami',
            'e62d9e5d-2810-4ff7-976a-4923ce55e55f' => 'Houston',
            'e7e192cb-20fd-464a-8993-8ec4bf2ff019' => 'Buenos Aires',
            'eb56dea3-4cbe-44e7-acd1-0bc26dd8ab5b' => 'Moscow',
            'edb894fb-f557-429a-99c0-1c6790a00dfe' => 'Toronto',
            'f0b6e9d7-8fe0-45a9-9f28-b7ded8bc5247' => 'Denver',
            'fafaca34-7550-416a-b96f-c195e022936c' => 'Chicago',
        ];
    }

}
