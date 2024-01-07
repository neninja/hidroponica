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
        );
    }

    public function createText(string $title, array ...$sentences): self
    {
        Text::factory()
            ->afterCreating(function (Text $text) use ($sentences) {
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
                            'text_id' => $text->id,
                            'start_at' => $startAt,
                            'end_at' => $endAt,
                            'content' => $content,
                            'new_paragraph' => $newParagraph,
                        ]);
                }
            })
            ->create([
                'name' => $title,
                'is_active' => true,
                'language' => LanguageType::English,
            ]);

        return $this;
    }
}
