<?php
/*
Template Name: specialization
Template Post Type: specialization
*/
?>

<?php

get_header('main');
?>


<!-- Фильтр контента по категориям на чистом Javascript -->
<div class="container header">
  <div class="filter">
    <button class="button button_type_all" data-filter="all">Все</button>
    <button class="button button_type_fonts" data-filter="fonts">Шрифты</button>
    <button class="button button_type_icons" data-filter="icons">Иконки</button>
    <button class="button button_type_images" data-filter="images">Изображения</button>
    <button class="button button_type_codes" data-filter="code">Редакторы</button>
    <button class="button button_type_sand" data-filter="sand">Песочницы</button>
  </div>
</div>

    <main>
        <div class="container links">
          <div class="row">
            <div class="col-lg-3 card fonts">
              <a href="http://fonts.google.com/">Google Fonts</a>
              <p>Веб-шрифты от Google</p>
            </div>
            <div class="col-lg-3 card code">
              <a href="https://code.visualstudio.com/">VS Code</a>
              <p>мощный редактор (IDE)</p>
            </div>
            <div class="col-lg-3 card icons">
              <a href="https://www.flaticon.com/">Flaticons</a>
              <p>Бесплатные векторные иконки</p>
            </div>
            <div class="col-lg-3 card sand">
              <a href="https://jsfiddle.net/">JS fiddle</a>
              <p>Песочница для JavaScript</p>
            </div>
            <div class="col-lg-3 card icons">
              <a href="https://seeklogo.com/">Seeklogo</a>
              <p>Векторные логотипы компаний</p>
            </div>
            <div class="col-lg-3 card fonts">
              <a href="https://fontstorage.com/tools/">FontStorage</a>
              <p>Плагин, простой способ подключить шрифт</p>
            </div>
            <div class="col-lg-3 card images">
              <a href="https://compressor.io/">Сompressor</a>
              <p>Сжимает JPG и PNG</p>
            </div>
            <div class="col-lg-3 card fonts">
              <a href="https://app.typeanything.io/">Type Anything</a>
              <p>Калькулятор параметров текста + генератор CSS-кода</p>
            </div>
            <div class="col-lg-3 card icons">
              <a href="https://svgporn.com/">SVG Porn</a>
              <p>Векторные логотипы</p>
            </div>
            <div class="col-lg-3 card fonts">
              <a href="https://transfonter.org/">Transfonter</a>
              <p>Конвертер веб-шрифтов</p>
            </div>
            <div class="col-lg-3 card images">
              <a href="https://tinypng.com/">Tinypng</a>
              <p>Сжимает изображения (eсть API)</p>
            </div>
            <div class="col-lg-3 card fonts">
              <a href="http://fonts4web.ru/">Fonts4web</a>
              <p>Шрифты для сайтов</p>
            </div>
            <div class="col-lg-3 card images">
              <a href="https://www.vectorizer.io/">Vectorizer</a>
              <p>Из растрового в векторное изображение</p>
            </div>
            <div class="col-lg-3 card icons">
              <a href="http://toplogos.ru/">TOP Logos</a>
              <p>Логотипы компаний</p>
            </div>
            <div class="col-lg-3 card fonts">
              <a href="http://www.fontov.net/">Фонтов.нет</a>
              <p>Подбор шрифта по фразе</p>
            </div>
            <div class="col-lg-3 card images">
              <a href="https://www.online-convert.com/">Online-Convert</a>
              <p>Бесплатный конвертер из растрового в векторное изображение</p>
            </div>
            <div class="col-lg-3 card icons">
              <a href="http://fontawesome.com/">Font Awesome</a>
              <p>Иконочный шрифт + SVG</p>
            </div>
            <div class="col-lg-3 card code">
              <a href="http://brackets.io/">Brackets</a>
              <p>редактор для начинающих</p>
            </div>
            <div class="col-lg-3 card icons">
              <a href="https://utf8-icons.com/">UTF-8 Icons</a>
              <p>Иконки на utf-8</p>
            </div>
            <div class="col-lg-3 card code">
              <a href="https://atom.io/">Atom</a>
              <p>крутой редактор от GitHub</p>
            </div>
            <div class="col-lg-3 card icons">
              <a href="https://fontello.com/">Fontello</a>
              <p>Шрифтовые иконки. Шрифты генерируются на ходу из выбранных иконок</p>
            </div>
            <div class="col-lg-3 card sand">
              <a href="http://www.codepen.io/">CodePen</a>
              <p>Песочница для HTML, CSS о JS</p>
            </div>
            <div class="col-lg-3 card code">
              <a href="https://notepad-plus-plus.org/">Notepad ++</a>
              <p>легендарный редактор</p>
            </div>
            <div class="col-lg-3 card icons">
              <a href="https://iconmonstr.com/">IconMonster</a>
              <p>Бесплатные векторные иконки</p>
            </div>
            <div class="col-lg-3 card code">
              <a href="https://code.visualstudio.com/">Sublime text 3</a>
              <p>удобный и быстрый редактор кода</p>
            </div>
            <div class="col-lg-3 card sand">
              <a href="https://jsbin.com/">JS Bin</a>
              <p>Песочница с выводом в консолью</p>
            </div>
            <div class="col-lg-3 card icons">
              <a href="https://iconmonstr.com/">IcoMoon</a>
              <p>Векторные иконки</p>
            </div>
          </div>

        </div>
    </main>


<?php

get_footer();
