<div class="px-5 py-6 shadow sm:px-6" x-data="{id: null, language: null}">
    @if(filled($text->audio))
        <audio controls id="audiofile">
            <source src="{{$text->audioUrl()}}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    @endif
    <div id="subtitles">
        @foreach ($text->sentences as $i => $sentence)
            @if($sentence->new_paragraph && $i > 0)
                </p>
            @endif
            @if($sentence->new_paragraph)
                <p class="mt-2">
            @endif
            <span
                    @mouseenter="id = '{{$sentence->id}}'"
                    @mouseleave="id=null"
                    data-start="{{$sentence->start_at}}"
                    data-end="{{$sentence->end_at}}"
                    class="cursor-pointer" :class="{ 'bg-red-200': id == '{{$sentence->id}}'}">
                    {{$sentence->content}}
            </span>
        @endforeach
    </p></div>

    <hr class="my-4" />

    @php
        $transalatedSentences = $text->translatedSentencesGroupByLanguage();
        $languages = $transalatedSentences->keys();
    @endphp

    @foreach ($languages as $language)
        <label class="cursor-pointer">
            <input type="radio" value="{{$language}}" x-model="language" /> {{\App\Enums\LanguageType::tryFrom($language)->getLabel()}}
        </label>
    @endforeach

    <hr class="my-4" />

    @foreach ($transalatedSentences as $language => $translatedSentences)
        <div x-show="language = '{{$language}}'" id="legendas">
            @foreach ($translatedSentences as $i => $translatedSentence)
                @if($translatedSentence->sentence->new_paragraph && $i > 0)
                    </p>
                @endif
                @if($translatedSentence->sentence->new_paragraph)
                    <p class="mt-2">
                @endif
                <span
                      @mouseenter="id = '{{$translatedSentence->sentence->id}}'"
                      @mouseleave="id = null"
                      data-start="{{$translatedSentence->start_at}}"
                      data-end="{{$translatedSentence->end_at}}"
                      class="cursor-pointer" :class="{ 'bg-red-200': id == '{{$translatedSentence->sentence->id}}'}">
                    {{$translatedSentence->content}}
                </span>
            @endforeach
        </p></div>
    @endforeach
</div>
<script>
var audioPlayer = document.getElementById("audiofile");

const subtitles = document.getElementById("subtitles").querySelectorAll("span");
const legendas = document.getElementById("legendas").querySelectorAll("span");

const sync = [];

function handleDblClick(start) {
  if (window.getSelection) {
    window.getSelection().removeAllRanges();
  } else if (document.selection) {
    document.selection.empty();
  }

  audioPlayer.currentTime = start;
  audioPlayer.play();
}

subtitles.forEach((element) => {
  const start = element.getAttribute("data-start");
  const end = element.getAttribute("data-end");

  sync.push({ start, end });
  element.ondblclick = () => handleDblClick(start);
});

legendas.forEach((element) => {
  const start = element.getAttribute("data-start");
  element.ondblclick = () => handleDblClick(start);
});

audioPlayer.addEventListener("timeupdate", function() {
  document.querySelectorAll("span.active-caption").forEach((element) => {
    element.classList.remove("active-caption");
  });

  const i = sync.findIndex(e => audioPlayer.currentTime >= e.start && audioPlayer.currentTime <= e.end);

  try {
    subtitles[i].classList.add("active-caption");
    legendas[i].classList.add("active-caption");
  } catch { }
});
</script>
