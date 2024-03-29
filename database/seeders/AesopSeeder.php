<?php

namespace Database\Seeders;

use App\Enums\LanguageType;
use App\Models\Sentence;
use App\Models\Text;
use App\Models\TranslatedSentence;
use Illuminate\Database\Seeder;

class AesopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CRÉDITOS: https://etc.usf.edu/lit2go/35/aesops-fables/395/-the-fox-and-the-grapes/
        $this->createText(
            '51882430-4ac9-3eab-b903-f91b3bb5656e',
            'The Fox and the Grapes',
            [
                03,
                14,
                'One hot summer’s day a Fox was strolling through an orchard till he came to a bunch of Grapes just ripening on a vine which had been trained over a lofty branch.',
                'Num dia quente de verão, um raposo estava passeando por um pomar até encontrar um cacho de uvas amadurecendo em uma videira que havia sido plantada sobre um galho alto.',
            ],
            [
                15,
                17,
                '"Just the thing to quench my thirst, quyoth he."',
                '"A coisa certa para matar minha sede", disse ele.',
            ],
            [
                18,
                24,
                'Drawing back a few paces, he took a run and a jump, and just missed the bunch.',
                'Recuando alguns passos, ele correu e saltou, e por pouco errou o grupo.',
            ],
            [
                24,
                30,
                'Turning round again with a One, Two, Three, he jumped up, but with no greater success.',
                'Virando-se novamente com um um, dois, três, ele pulou, mas sem maior sucesso.',
            ],
            [
                30.2,
                39,
                'Again and again he tried after the tempting morsel, but at last had to give it up, and walked away with his nose in the air, saying:',
                'Ele tentou repetidas vezes o pedaço tentador, mas finalmente teve que desistir e foi embora com o nariz empinado, dizendo:',
            ],
            [
                40,
                41,
                '"I am sure they are sour."',
                '"Tenho certeza de que eles estão azedos".',
            ],
            [
                42,
                46,
                'It is easy to despise what you cannot get.',
                'É fácil desprezar o que você não consegue.',
                true,
            ],
        )->update(['is_demo' => true]);

        // CRÉDITOS
        $this->createText(
            'cda4f288-b5a3-43cb-8d9c-fb68a55c935a',
            'The Wolf and the Lamb',
            [
                30,
                39.5,
                'A Wolf came upon a Lamb straying from the flock, and felt some compunction about taking the life of so helpless a creature without some plausible excuse;',
                'Um lobo encontrou um cordeiro se afastando do rebanho e sentiu algum remorso por tirar a vida de uma criatura tão indefesa sem uma desculpa plausível;',
            ],
            [
                39.8,
                43,
                'so he cast about for a grievance and said at last,',
                'então ele procurou uma queixa e disse finalmente,',
            ],
            [
                43.1,
                46,
                '"Last year, sirrah, you grossly insulted me."',
                '"Ano passado, senhor, você me insultou grosseiramente."',
            ],
            [
                47.5,
                51,
                '"That is impossible, sir," bleated the Lamb, "for I wasn\'t born then."',
                '"Isso é impossível, senhor", baliu o Cordeiro, "pois eu não nasci então."',
            ],
            [
                52,
                56,
                '"Well," retorted the Wolf, "you feed in my pastures."',
                '"Bem", retorquiu o Lobo, "você se alimenta em meus pastos."',
            ],
            [
                56.4,
                62,
                '"That cannot be," replied the Lamb, "for I have never yet tasted grass."',
                '"Isso não pode ser", respondeu o Cordeiro, "pois nunca provei grama."',
            ],
            [
                63,
                66,
                '"You drink from my spring, then," continued the Wolf.',
                '"Você bebe da minha fonte, então," continuou o Lobo.',
                true,
            ],
            [
                66.5,
                72,
                '"Indeed, sir," said the poor Lamb, "I have never yet drunk anything but my mother\'s milk."',
                '"Na verdade, senhor", disse o pobre Cordeiro, "nunca bebi nada além do leite de minha mãe."',
                true,
            ],
            [
                73,
                77,
                '"Well, anyhow," said the Wolf, "I\'m not going without my dinner":',
                '"Bem, de qualquer forma", disse o Lobo, "não vou embora sem o meu jantar":',
                true,
            ],
            [
                77.5,
                82,
                'and he sprang upon the Lamb and devoured it without more ado.',
                'e ele saltou sobre o Cordeiro e o devorou sem mais delongas.',
                true,
            ],
        );
    }

    public function createText(string $id, string $title, array ...$sentences): Text
    {
        return Text::factory()
            ->afterCreating(function (Text $text) use ($sentences, $id) {
                foreach ($sentences as $sentence) {
                    $startAt = $sentence[0];
                    $endAt = $sentence[1];
                    $content = $sentence[2];
                    $translatedContent = $sentence[3];
                    $newParagraph = $sentence[4] ?? false;

                    Sentence::factory()
                        ->afterCreating(function (Sentence $originalSentence) use ($translatedContent) {
                            TranslatedSentence::factory()
                                ->create([
                                    'sentence_id' => $originalSentence->id,
                                    'language' => LanguageType::BrazilianPortuguese,
                                    'content' => $translatedContent,
                                ]);
                        })
                        ->create([
                            'text_id' => $id,
                            'start_at' => $startAt,
                            'end_at' => $endAt,
                            'content' => $content,
                            'new_paragraph' => $newParagraph,
                        ]);
                }
            })
            ->create([
                'id' => $id,
                'name' => $title,
                'is_active' => true,
                'language' => LanguageType::English,
            ]);
    }
}
