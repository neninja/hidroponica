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
        $this->createText(
            'The Fox and the Grapes',
            [
                20,
                30,
                'A hungry Fox saw some fine bunches of Grapes hanging from a vine that was trained along a high trellis,',
                'Um faminto Raposo viu alguns cachos de uvas pendurados em uma videira que estava treinada ao longo de uma treliça alta,',
            ],
            [
                30,
                40,
                'and did his best to reach them by jumping as high as he could into the air.',
                'e fez o seu melhor para alcançá-los pulando o mais alto que podia no ar.',
            ],
            [
                40,
                45,
                'But it was all in vain,',
                'Mas foi tudo em vão,',
            ],
            [
                45,
                50,
                'for they were just out of reach:',
                'pois eles estavam fora de alcance:',
            ],
            [
                50,
                55,
                'so he gave up trying,',
                'então ele desistiu de tentar,',
            ],
            [
                55,
                65,
                'and walked away with an air of dignity and unconcern, remarking,',
                'e afastou-se com um ar de dignidade e indiferença, observando,',
            ],
            [
                65,
                70,
                '"I thought those Grapes were ripe,',
                '"Eu pensei que aquelas uvas estavam maduras,',
            ],
            [
                70,
                75,
                'but I see now they are quite sour."',
                'mas agora vejo que estão bem azedas."',
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
                'language' => LanguageType::English,
            ]);

        return $this;
    }
}
