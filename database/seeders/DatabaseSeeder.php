<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'first_name' => 'Kacper',
            'last_name' => 'Wyczawski',
            'name' => 'kacwyc',
            'password' => Hash::make('admin'),
            'job_title' => 'Dyrektor',
            'is_executor' => true,
        ]);

        DB::table('users')->insert([
            [
                'first_name' => 'Sebastian',
                'last_name' => 'Boczkaj',
                'name' => 'sebboc',
                'password' => Hash::make('1234'),
                'job_title' => 'Kierownik',
            ],
            [
                'first_name' => 'Justyna',
                'last_name' => 'Białek',
                'name' => 'jusbia',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Joanna',
                'last_name' => 'Białogłowska',
                'name' => 'joabia',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Robert',
                'last_name' => 'Białogłowski',
                'name' => 'robbia',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Beata',
                'last_name' => 'Bieńko',
                'name' => 'beabie',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Ewelina',
                'last_name' => 'Błońska-Rybarczyk',
                'name' => 'eweblo',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Grzegorz',
                'last_name' => 'Bojarski',
                'name' => 'grzboj',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Mariusz',
                'last_name' => 'Bożacki',
                'name' => 'marboz',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Barbara',
                'last_name' => 'Bryś-Marszałek',
                'name' => 'barbry',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Grzegorz',
                'last_name' => 'Ciasnocha',
                'name' => 'grzcia',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Wojciech',
                'last_name' => 'Chmiel',
                'name' => 'wojchm',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Elżbieta',
                'last_name' => 'Czech',
                'name' => 'elzcze',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Mieczysław',
                'last_name' => 'Czyż',
                'name' => 'mieczy',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Artur',
                'last_name' => 'Danczak',
                'name' => 'artdan',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Piotr',
                'last_name' => 'Dąbrowski',
                'name' => 'piodab',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Lucyna',
                'last_name' => 'Drążek',
                'name' => 'lucdra',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Edward',
                'last_name' => 'Dudziak',
                'name' => 'edwdud',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Iwona',
                'last_name' => 'Dyderska',
                'name' => 'iwodyd',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Katarzyna',
                'last_name' => 'Dymura',
                'name' => 'katdym',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Danuta',
                'last_name' => 'Faluszczak',
                'name' => 'danfal',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Sławomir',
                'last_name' => 'Fornal',
                'name' => 'slafor',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Alina',
                'last_name' => 'Głowacka',
                'name' => 'aliglo',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Paweł',
                'last_name' => 'Głowacki',
                'name' => 'pawglo',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Sławomir',
                'last_name' => 'Gołąb',
                'name' => 'slagol',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Agnieszka',
                'last_name' => 'Gonet-Czechowicz',
                'name' => 'agncon',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Wojciech',
                'last_name' => 'Gotkowski',
                'name' => 'wojgot',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Janusz',
                'last_name' => 'Gudyka',
                'name' => 'jangud',
                'password' => Hash::make('1234'),
                'job_title' => 'Dyrektor',
            ],
            [
                'first_name' => 'Monika',
                'last_name' => 'Halicka',
                'name' => 'monhal',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Grzegorz',
                'last_name' => 'Izowit',
                'name' => 'grzizo',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Monika',
                'last_name' => 'Jaszek',
                'name' => 'monjas',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Aneta',
                'last_name' => 'Kamińska',
                'name' => 'anetka',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Gabriela',
                'last_name' => 'Kamińska',
                'name' => 'gabka',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Izabela',
                'last_name' => 'Kaniuch',
                'name' => 'izakan',
                'password' => Hash::make('1234'),
                'job_title' => 'Dyrektor',
            ],
            [
                'first_name' => 'Robert',
                'last_name' => 'Kasza',
                'name' => 'robkas',
                'password' => Hash::make('1234'),
                'job_title' => 'Dyrektor',
            ],
            [
                'first_name' => 'Artur',
                'last_name' => 'Kieć',
                'name' => 'artkie',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Agnieszka',
                'last_name' => 'Kinczel',
                'name' => 'agnkin',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Katarzyna',
                'last_name' => 'Kochmańska-Kurasz',
                'name' => 'katkoc',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Justyna',
                'last_name' => 'Kłodowska',
                'name' => 'jusklo',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Beata',
                'last_name' => 'Kotelnicka',
                'name' => 'beakot',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Agnieszka',
                'last_name' => 'Kozyra',
                'name' => 'agnkoz',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Paweł',
                'last_name' => 'Krasny',
                'name' => 'pawkra',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Zbigniew',
                'last_name' => 'Król',
                'name' => 'zbigro',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Agata',
                'last_name' => 'Kubiak',
                'name' => 'agakub',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Antoni',
                'last_name' => 'Kuźniar',
                'name' => 'antkuz',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Halina',
                'last_name' => 'Kuźniar',
                'name' => 'halkuz',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Maciej',
                'last_name' => 'Leś',
                'name' => 'macles',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Łukasz',
                'last_name' => 'Lew',
                'name' => 'luklew',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Piotr',
                'last_name' => 'Lipka',
                'name' => 'piolip',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Bernadetta',
                'last_name' => 'Littak-Wdowiak',
                'name' => 'berlit',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Witold',
                'last_name' => 'Liszcz',
                'name' => 'witlis',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Adam',
                'last_name' => 'Mandzelowski',
                'name' => 'adaman',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Agnieszka',
                'last_name' => 'Marć',
                'name' => 'agnmar',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Tomasz',
                'last_name' => 'Maś',
                'name' => 'tommas',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Daria',
                'last_name' => 'Matlosz',
                'name' => 'darmat',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Łukasz',
                'last_name' => 'Medrygał',
                'name' => 'lukmed',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Lesław',
                'last_name' => 'Mical',
                'name' => 'lesmic',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Andrzej',
                'last_name' => 'Mioduski',
                'name' => 'andmio',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Katarzyna',
                'last_name' => 'Mista',
                'name' => 'katmis',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Zbigniew',
                'last_name' => 'Niedbała',
                'name' => 'zbinie',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Anita',
                'last_name' => 'Niedziałek',
                'name' => 'ananie',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Małgorzata',
                'last_name' => 'Nowosielska',
                'name' => 'malnow',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Natalia',
                'last_name' => 'Pacześniak',
                'name' => 'natpac',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Anita',
                'last_name' => 'Paczkowska-Kowalik',
                'name' => 'anapac',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Anna',
                'last_name' => 'Pękała',
                'name' => 'annpeka',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Maciej',
                'last_name' => 'Pieprzycki',
                'name' => 'macpie',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Marek',
                'last_name' => 'Piś',
                'name' => 'marpis',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Agnieszka',
                'last_name' => 'Rokita',
                'name' => 'agnrok',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Monika',
                'last_name' => 'Rozak',
                'name' => 'monroz',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Paweł',
                'last_name' => 'Sitek',
                'name' => 'pawsit',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Krzysztof',
                'last_name' => 'Smalara',
                'name' => 'krzsma',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Maksymilian',
                'last_name' => 'Sobczak',
                'name' => 'maksob',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Wiesław',
                'last_name' => 'Soja',
                'name' => 'wiesso',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Krzysztof',
                'last_name' => 'Stec',
                'name' => 'krzste',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Jacek',
                'last_name' => 'Szydełko',
                'name' => 'jacszy',
                'password' => Hash::make('1234'),
                'job_title' => 'Dyrektor',
            ],
            [
                'first_name' => 'Katarzyna',
                'last_name' => 'Szydełko',
                'name' => 'katszy',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Anna',
                'last_name' => 'Świerk',
                'name' => 'annswi',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Leszek',
                'last_name' => 'Świerk',
                'name' => 'lesswi',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Artur',
                'last_name' => 'Świst',
                'name' => 'artswi',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Aneta',
                'last_name' => 'Tyczyńska',
                'name' => 'anetyc',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Monika',
                'last_name' => 'Walat',
                'name' => 'monwal',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Maciej',
                'last_name' => 'Wilczek',
                'name' => 'macwil',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Maria',
                'last_name' => 'Wilk',
                'name' => 'marwil',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Ineza',
                'last_name' => 'Wilusz',
                'name' => 'inewil',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Grzegorz',
                'last_name' => 'Wójcik',
                'name' => 'grzwoj',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Bogusław',
                'last_name' => 'Zagólski',
                'name' => 'bogzag',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Piotr',
                'last_name' => 'Ziemiński',
                'name' => 'piozie',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Edyta',
                'last_name' => 'Chorzepa',
                'name' => 'edychor',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Magdalena',
                'last_name' => 'Dusza',
                'name' => 'magdus',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Marzena',
                'last_name' => 'Kochman',
                'name' => 'markoc',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Bernadeta',
                'last_name' => 'Duda',
                'name' => 'berdud',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Aneta',
                'last_name' => 'Solecka',
                'name' => 'anesol',
                'password' => Hash::make('1234'),
            ],
            [
                'first_name' => 'Elżbieta',
                'last_name' => 'Magierska',
                'name' => 'elzmag',
                'password' => Hash::make('1234'),
            ],
        ]);

        DB::table('rooms')->insert([
            [
                'name' => '0.3',
                'description' => null
            ],
            [
                'name' => '0.5',
                'description' => 'Sala religii',
            ],
            [
                'name' => '0.8',
                'description' => 'Sala przedsiębiorczości',
            ],
            [
                'name' => '1',
                'description' => 'Sala matematyki',
            ],
            [
                'name' => '2',
                'description' => 'Sala automatyki',
            ],
            [
                'name' => '3',
                'description' => 'Sala elektroniki',
            ],
            [
                'name' => '203',
                'description' => 'Sala chemii',
            ],
            [
                'name' => '204',
                'description' => 'Sala historii',
            ],
            [
                'name' => '205',
                'description' => 'Sala fizyki',
            ],
            [
                'name' => '206',
                'description' => 'Sala fizyki',
            ],
            [
                'name' => '208',
                'description' => 'Sala j.polskiego',
            ],
            [
                'name' => '209',
                'description' => 'Sala j.polskiego',
            ],
            [
                'name' => '210',
                'description' => 'Sala geografii i historii',
            ],
            [
                'name' => '211',
                'description' => 'Sala matematyki',
            ],
            [
                'name' => '212',
                'description' => 'Sala matematyki',
            ],
            [
                'name' => '213',
                'description' => 'Sala j.polskiego',
            ],
            [
                'name' => '110h',
                'description' => 'Sala historii',
            ],
            [
                'name' => '4',
                'description' => 'Pracownia informatyczna',
            ],
            [
                'name' => '4a',
                'description' => 'Pracownia oprogramowania',
            ],
            [
                'name' => '12',
                'description' => 'Sala biologii',
            ],
            [
                'name' => '18',
                'description' => 'Pracownia informatyczna',
            ],
            [
                'name' => '19',
                'description' => 'Pracownia informatyczna',
            ],
            [
                'name' => '104',
                'description' => 'Pracownia informatyczna',
            ],
            [
                'name' => '105',
                'description' => 'Pracownia informatyczna',
            ],
            [
                'name' => '110',
                'description' => 'Pracownia systemów operacyjnych',
            ],
            [
                'name' => '112',
                'description' => 'Pracownia informatyczna',
            ],
            [
                'name' => '113',
                'description' => 'Pracownia informatyczna',
            ],
            [
                'name' => '113a',
                'description' => 'Pracownia informatyczna',
            ],
            [
                'name' => '102h',
                'description' => 'Sala językowa',
            ],
            [
                'name' => '112h',
                'description' => 'Sala językowa',
            ],
            [
                'name' => '110a',
                'description' => 'Sala językowa',
            ],
            [
                'name' => '207',
                'description' => 'Sala językowa',
            ],
            [
                'name' => '4c',
                'description' => 'Pracownia urządzeń elektronicznych',
            ],
            [
                'name' => '4d',
                'description' => 'Pracownia urządzeń elektronicznych',
            ],
            [
                'name' => '107',
                'description' => 'Pracownia automatyki',
            ],
            [
                'name' => '106',
                'description' => 'Pracownia automatyki',
            ],
            [
                'name' => '111',
                'description' => 'Pracownia elektryczna',
            ],
            [
                'name' => 'hala',
                'description' => null,
            ],
            [
                'name' => 'stara hala',
                'description' => null,
            ],
            [
                'name' => 'aula',
                'description' => null,
            ],
            [
                'name' => 'czytelnia',
                'description' => 'Biblioteka',
            ],
            [
                'name' => 'siłownia',
                'description' => null,
            ],
        ]);
    }
}
