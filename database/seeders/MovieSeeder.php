<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'title' => 'A Esmorga',
                'short_description' => 'Unha viaxe de 3 compañeiros que viven de parranda',
                'description' => 'Unha crónica tensa e intensa de 24 horas nas vidas de tres compañeiros Cibrán o Castizo, Xanciño o Bocas, e Aladio Milhomes, de festa que deixan un rastro de destrución, sexo reprimido e ambiguo, e tamén pechan portas despois de tirar as chaves, coma se buscasen deliberadamente a súa perdición.',
                'director' => 'Ignacio Vilar',
                'genre' => 'Drama',
                'duration' => 107,
                'classification' => '16',
                'language' => 'Galego',
                'release_date' => '2014-11-15',
                'rating' => 6.6,
                'poster_image' => 'movie1-poster.jpg',
                'cover_image' => 'movie1-cover.jpg',
                'cast' => json_encode(['Karra Elejalde', 'Ledicia Sola', 'Miguel de Lira', 'Antonio Durán', 'Sabela Arán']),
            ],
            [
                'title' => 'Fast & Furious 7',
                'short_description' => 'Un intento de adaptación, un inimigo máis para derrocar, e complicacións na familia de Dom',
                'description' => 'Pasou un ano dende que o equipo de Dominic Torreto e Brian puideron finalmente regresar aos Estados Unidos despois de seren indultados. Queren adaptarse a unha vida dentro da lei, pero o ambiente xa non é o mesmo. Dom intenta achegarse a Letty e Brian loita por adaptarse á vida nunha urbanización con Mia e o seu fillo. Ningún deles imaxina que un asasino británico a sangue frío, adestrado para levar a cabo operacións secretas, se cruzará nos seus camiños e se converterá no seu maior inimigo',
                'director' => 'James Wan',
                'genre' => 'Ciencia Ficción',
                'duration' => 137,
                'classification' => '12',
                'language' => 'English',
                'release_date' => '2015-04-02',
                'rating' => 5.8,
                'poster_image' => 'movie2-poster.jpg',
                'cover_image' => 'movie2-cover.jpg',
                'cast' => json_encode(['Vin Diesel', 'Paul Walker', 'Jason Statham', 'Michelle Rodriguez', 'Tyrese Gibson', 'Ludacris', 'Dwayne Johnson', 'Kurt Russell', 'Jordana Brewster', 'Elsa Pataky', 'Nathalie Emmanuel']),
            ],
            [
                'title' => 'La Viuda',
                'short_description' => 'Un thriller psicológico sobre unha adolescente que se ve envolta no trauma dunha señora psicóapata',
                'description' => 'Frances e unha doce moza que se muda a Manhattan despois da morte da sua nai. Mentres viaxa no metro, atopa un bolso perdido e decide darllo á súa lexítima propietaria, Greta, unha pianista viúva que necesita desesperadamente compañía. Co tempo fanse amigas, pero a súa amizade cambia cando descobren o que quere Greta.',
                'director' => 'Neil Jordan',
                'genre' => 'Thriller',
                'duration' => 98,
                'classification' => '12',
                'language' => 'English',
                'release_date' => '2019-03-01',
                'rating' => 5.5,
                'poster_image' => 'movie3-poster.jpg',
                'cover_image' => 'movie3-cover.jpg',
                'cast' => json_encode(['Isabelle Huppert', 'Chloë Grace Moretz', 'Maika Monroe', 'Stephen Rea', 'Colm Feore']),
            ],
            [
                'title' => 'Pretty Woman',
                'short_description' => 'Unha comedia romántica entre un rico e unha prostituta',
                'description' => 'Edward Lewis, un home de negocios guapo e rico, contrata a unha prostituta, Vivian Ward, durante unha viaxe aos Ánxeles. Despois de pasar a primeira noite con ela, Edward ofrécelle cartos a Vivian para que pase toda a semana con el e o acompañe a varios eventos sociais.',
                'director' => 'Garry Marshall',
                'genre' => 'Comedia Romántica',
                'duration' => 119,
                'classification' => '13',
                'language' => 'English',
                'release_date' => '1990-10-10',
                'rating' => 6.3,
                'poster_image' => 'movie4-poster.jpg',
                'cover_image' => 'movie4-cover.jpg',
                'cast' => json_encode(['Julia Roberts', 'Richard Gere', 'Héctor Elizondo', 'Jason Alexander', 'Ralph Bellamy', 'Laura San Giacomo']),
            ],
            [
                'title' => 'A Praia dos Afogados',
                'short_description' => 'Un épico relato histórico sobre as costas galegas',
                'description' => 'Unha mañá, a marea arrastra o corpo dun mariñeiro á costa. Se non tivese as mans atadas, Justo Castelo sería outro dos fillos do mar que atopou a súa tumba nas augas mentres pescaba. Pero o océano nunca necesitou amarras para matar. Sen testemuñas nin rastro da embarcación do falecido, o inspector Leo Caldas mergúllase na atmosfera mariñeira da vila, tratando de desentrañar o crime entre homes e mulleres que se negan a revelar as súas sospeitas e que, cando deciden falar, apuntan nunha dirección inesperada.',
                'director' => 'Gerardo Herrero',
                'genre' => 'Histórica',
                'duration' => 96,
                'classification' => '12',
                'language' => 'Galego',
                'release_date' => '2015-10-08',
                'rating' => 5.7,
                'poster_image' => 'movie5-poster.jpg',
                'cover_image' => 'movie5-cover.jpg',
                'cast' => json_encode(['Fernando Castro', 'Gonzalo Vázquez', 'Irene Souto', 'Luisa Fernández', 'Tomás Ríos']),
            ],
            [
                'title' => 'Padre no hay más que uno 4: Campanas de boda',
                'short_description' => 'Unha aventura familiar chea de risas e sucesos inesperados',
                'description' => 'Que efecto tería nos pais se, o mesmo día que a súa filla maior cumpre 18 anos, o seu mozo lle pedise matrimonio e ela aceptase inmediatamente?',
                'director' => 'Santiago Segura',
                'genre' => 'Familiar',
                'duration' => 99,
                'classification' => 'TP',
                'language' => 'Castelán',
                'release_date' => '2024-07-17',
                'rating' => 4.3,
                'poster_image' => 'movie6-poster.jpg',
                'cover_image' => 'movie6-cover.jpg',
                'cast' => json_encode(['Santiago Segura', 'Toni Acosta', 'Loles León', 'Martina DAntioquia', 'Calma Ssegura', 'Lúa Fulxencio', 'Carlos González', 'Serea Segura', 'Diego Arroba', 'Leo Harlem', 'Marta González', 'Carlos Igrexas']),
            ],
            [
                'title' => 'El exorcista',
                'short_description' => 'Un terror psicológico que traspasa os límites da realidade tal e o como a coñecemos. Adaptación da novela de William Peter Blatty que se inspirou nun exorcismo real que tivo lugar en Washington en 1949',
                'description' => 'Regan, unha nena de doce anos, sofre de fenómenos paranormais como a levitación e a manifestación de forza sobrehumana. A súa nai, aterrorizada, despois de someter a súa filla a múltiples probas médicas que non deron resultado, acode a un sacerdote licenciado en psiquiatría. El, convencido de que o mal non é físico senón espiritual, cre que se trata dun caso de posesión demoníaca e decide realizar un exorcismo.',
                'director' => 'William Friedkin',
                'genre' => 'Terror',
                'duration' => 121,
                'classification' => '18',
                'language' => 'English',
                'release_date' => '1975-09-01',
                'rating' => 7.7,
                'poster_image' => 'movie7-poster.jpg',
                'cover_image' => 'movie7-cover.jpg',
                'cast' => json_encode(['Linda Blair', 'Ellen Burstyn', 'Jason Miller', 'Max von Sydow', 'Vasiliki Maliaros', 'Jack MacGowran', 'Lee J. Cobb', 'Kitty Winn']),
            ],
            [
                'title' => 'No estás sola: La lucha contra La Manada',
                'short_description' => 'Un documental fascinante para darlle visivilidad a unha serie de agresion sexuais',
                'description' => 'Comezando coa agresión sexual sufrida por unha moza durante os Sanfermines de 2016 a mans de cinco homes que se autodenominan “La Manada”, a película entrelaza gradualmente esta e outras dúas historias, arroxando luz sobre a violencia sexual que sofren as mulleres a diario, ata chegar ao #MeToo español: o momento no que un millón de mulleres e mozas saíron ás rúas berrando “Irmá, eu si que te creo” e rompendo o silencio nas redes sociais con #TellIt.',
                'director' => ' Almudena Carracedo, Robert Bahar',
                'genre' => 'Documental',
                'duration' => 101,
                'classification' => '12',
                'language' => 'Catelán',
                'release_date' => '2024-02-23',
                'rating' => 6.7,
                'poster_image' => 'movie8-poster.jpg',
                'cover_image' => 'movie8-cover.jpg',
                'cast' => json_encode([' Natalia de Molina', 'Carolina Yuste']),
            ],
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}
