<?php
require_once('php/db_driver.php');
$driver = new DbDriver('prod');

function sections($driver)
{
    try {
        $sql = "SELECT s.number, s.section, s.section_index, SUM(d.hours) as hs FROM section as s 
                        JOIN discipline as d ON s.id = d.section_id
                        GROUP BY s.section, s.number, s.section_index
                        ORDER BY s.number ASC";

        return $driver->execute($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
}

function ratingData($driver, $sectionNumber)
{
    try {
        $sql = "SELECT * FROM discipline as d 
                JOIN index as i ON d.index_id = i.id 
                JOIN rating as r ON d.rating_id = r.id
                JOIN section as s ON d.section_id = s.id WHERE d.section_id = $sectionNumber
                ORDER BY i.index, d.index_number ASC";

        return $driver->execute($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Dulkin Studio</title>
</head>

<body>
    <header id="header" class="header flex-container row-container">
        <a href="#" class="brand">
            <img src="img/brand.svg" alt="Brand">
        </a>
        <nav id="nav" class="flex-container row-container">
            <div class="nav-link">
                <a href="#home">
                    <img src="img/home-nav.svg" alt="Home">
                    <span>Главная</span>
                </a>
            </div>
            <div class="nav-link">
                <a href="#resume">
                    <img src="img/resume-nav.svg" alt="Resume">
                    <span>Резюме</span>
                </a>
            </div>
            <div class="nav-link">
                <a href="#technologies">
                    <img src="img/technologies-nav.svg" alt="Technologies">
                    <span>Навыки</span>
                </a>
            </div>
            <div class="nav-link">
                <a href="#education">
                    <img src="img/education-nav.svg" alt="Education">
                    <span>Образование</span>
                </a>
            </div>
            <div class="nav-link">
                <a href="#projects">
                    <img src="img/projects-nav.svg" alt="Projects">
                    <span>Проекты</span>
                </a>
            </div>
            <div class="nav-link">
                <a href="#contacts">
                    <img src="img/contacts-nav.svg" alt="Contacts">
                    <span>Связаться</span>
                </a>
            </div>
        </nav>
    </header>
    <main class="container">

        <a class="anchor" id="home"></a>
        <section class="home">
            <div class="content">
                <header>
                    <h1>
                        Привет!<br>
                        Я Дмитрий,<br>
                        web-разработчик.
                    </h1>
                </header>
                <p>Front-end / Back-end разработка</p>
                <a class="btn" href="#contacts">Связаться</a>
            </div>
            <div class="letter scalable">
                <img class="sc-sm-dec" src="img/brand-angle.svg" alt="brand-angle">
            </div>
        </section>
        <hr>

        <a class="anchor" id="resume"></a>
        <section class="resume">
            <header>
                <h1>Резюме</h1>
            </header>
            <div class="content">
                <article>
                    <p>
                        Профессионально занимаюсь разработкой web-сайтов длительное время.
                        Закончил Волгоградский Технологический Колледж по специальности "Программирование в
                        компьютерных системах".
                        <br>
                        <br>
                        Знания технического английского языка на уровне С1 - Intermediate.
                        <br>
                        <br>
                        Хорошо организованная личность, которая не боится встретить трудности на своем пути.
                        <br>
                        <br>
                        Любую работу за которую берусь выполняю качественно и в назначенные сроки.
                    </p>
                    <div class="links">
                        <a href="https://github.com/AmazingSuka" target="_blank">
                            <span class="git-p-bl icon"></span>
                        </a>
                        <a href="https://vk.com/dim.dulckin" target="_blank">
                            <span class="vk-p-bl icon"></span>
                        </a>
                        <a href="https://t.me/Batya_Dulyanich" target="_blank">
                            <span class="tg-p-bl icon"></span>
                        </a>
                    </div>
                </article>
                <div class="avatar scalable">
                    <img class="sc-sm-inc" src="img/myPhoto.jpg" alt="My photo">
                </div>
        </section>
        <hr>

        <a class="anchor" id="technologies"></a>
        <section class="technologies">
            <header>
                <h1>
                    Освоенные навыки и технологии
                </h1>
            </header>
            <div class="slider tech">
                <div class="slide fade">
                    <div class="slide-image scalable">
                        <img class="sc-sm-inc" src="img/net-core.png" alt="">
                    </div>
                    <div class="slide-body">
                        <header>
                            <h2>
                                .NET Core
                            </h2>
                        </header>
                        <p>
                            .NET Core — это модульная платформа для разработки программного
                            обеспечения с открытым исходным кодом. Совместима с такими
                            операционными системами как Windows, Linux и macOS.
                        </p>
                    </div>
                </div>
                <div class="slide hide fade">
                    <div class="slide-image scalable">
                        <img class="sc-sm-inc" src="img/ef-core.png" alt="">
                    </div>
                    <div class="slide-body">
                        <header>
                            <h2>
                                Entity Framework Core
                            </h2>
                        </header>
                        <p>
                            EF Core — это кроссплатформенная
                            и расширяемая версия популярной технологии доступа к данным
                            Entity Framework с открытым исходным кодом.
                        </p>
                    </div>
                </div>
                <div class="slide hide fade">
                    <div class="slide-image scalable">
                        <img class="sc-sm-inc" src="img/asp-net.png" alt="">
                    </div>
                    <div class="slide-body">
                        <header>
                            <h2>
                                ASP.NET Core
                            </h2>
                        </header>
                        <p>
                            ASP.NET Core — свободно-распространяемый кросс-платформенный
                            фреймворк для создания веб-приложений с открытым исходным кодом.
                        </p>
                    </div>
                </div>
                <div class="slide hide fade">
                    <div class="slide-image scalable">
                        <img class="sc-sm-inc" src="img/mssql.png" alt="">
                    </div>
                    <div class="slide-body">
                        <header>
                            <h2>
                                Microsoft SQL Server
                            </h2>
                        </header>
                        <p>
                            Microsoft SQL Server — система управления реляционными базами данных,
                            разработанная корпорацией Microsoft. Основной используемый язык
                            запросов — Transact-SQL.
                        </p>
                    </div>
                </div>
                <div class="slide hide fade">
                    <div class="slide-image scalable">
                        <img class="sc-sm-inc" src="img/postgresql.png" alt="">
                    </div>
                    <div class="slide-body">
                        <header>
                            <h2>
                                PostgreSQL
                            </h2>
                        </header>
                        <p>
                            PostgreSQL — свободная объектно-реляционная система управления базами данных.
                            Существует в реализациях для множества UNIX-подобных платформ, а также для Microsoft Windows.
                        </p>
                    </div>
                </div>
                <div class="slide hide fade">
                    <div class="slide-image scalable">
                        <img class="sc-sm-inc" src="img/python.png" alt="">
                    </div>
                    <div class="slide-body">
                        <header>
                            <h2>
                                Python
                            </h2>
                        </header>
                        <p>
                            Python — высокоуровневый язык программирования,
                            ориентированный на повышение производительности
                            разработчика и читаемости кода.
                        </p>
                    </div>
                </div>
                <div class="slide hide fade">
                    <div class="slide-image scalable">
                        <img class="sc-sm-inc" src="img/elixir.png" alt="">
                    </div>
                    <div class="slide-body">
                        <header>
                            <h2>
                                Elixir
                            </h2>
                        </header>
                        <p>
                            Elixir — функциональный, распределённый язык программирования
                            общего назначения, который работает на виртуальной машине Erlang.
                        </p>
                    </div>
                </div>
                <div class="slide hide fade">
                    <div class="slide-image scalable">
                        <img class="sc-sm-inc" src="img/project-2.png" alt="">
                    </div>
                    <div class="slide-body">
                        <header>
                            <h2>
                                Phoenix Framework
                            </h2>
                        </header>
                        <p>
                            Phoenix - это фреймворк для веб-разработки,
                            написанный на языке функционального программирования Elixir.
                            Phoenix использует шаблон MVC на стороне сервера.
                        </p>
                    </div>
                </div>
                <div class="slide hide fade">
                    <div class="slide-image scalable">
                        <img class="sc-sm-inc" src="img/html.png" alt="">
                    </div>
                    <div class="slide-body">
                        <header>
                            <h2>
                                HTML5
                            </h2>
                        </header>
                        <p>
                            HTML5 — язык для структурирования и представления
                            содержимого всемирной паутины.
                        </p>
                    </div>
                </div>
                <div class="slide hide fade">
                    <div class="slide-image scalable">
                        <img class="sc-sm-inc" src="img/css3.png" alt="">
                    </div>
                    <div class="slide-body">
                        <header>
                            <h2>
                                CSS3
                            </h2>
                        </header>
                        <p>
                            CSS — формальный язык описания внешнего вида документа,
                            написанного с использованием языка разметки.
                        </p>
                    </div>
                </div>
                <div class="slide hide fade">
                    <div class="slide-image scalable">
                        <img class="sc-sm-inc" src="img/js.png" alt="">
                    </div>
                    <div class="slide-body">
                        <header>
                            <h2>
                                JavaScript
                            </h2>
                        </header>
                        <p>
                            JavaScript — мультипарадигменный язык программирования.
                            Поддерживает объектно-ориентированный, императивный и функциональный стили.
                        </p>
                    </div>
                </div>
                <a class="prev" onclick="techSlider.prevSlide()">&#10094;</a>
                <a class="next" onclick="techSlider.nextSlide()">&#10095;</a>
            </div>
            <div class="dots tech">
                <span class="dot active" onclick="techSlider.showSlide(0)"></span>
                <span class="dot" onclick="techSlider.showSlide(1)"></span>
                <span class="dot" onclick="techSlider.showSlide(2)"></span>
                <span class="dot" onclick="techSlider.showSlide(3)"></span>
                <span class="dot" onclick="techSlider.showSlide(4)"></span>
                <span class="dot" onclick="techSlider.showSlide(5)"></span>
                <span class="dot" onclick="techSlider.showSlide(6)"></span>
                <span class="dot" onclick="techSlider.showSlide(7)"></span>
                <span class="dot" onclick="techSlider.showSlide(8)"></span>
                <span class="dot" onclick="techSlider.showSlide(9)"></span>
                <span class="dot" onclick="techSlider.showSlide(10)"></span>
            </div>
        </section>
        <hr>

        <a class="anchor" id="education"></a>
        <section class="education">
            <header>
                <h1>
                    Образование
                </h1>
            </header>
            <div class="slider edu">
                <div class="slide fade">
                    <header>
                        <span class="monitor icon-lg"></span>
                        <h2>
                            ПМ.01 Разработка программных модулей
                            программного обеспечения для компьютерных систем.
                        </h2>
                    </header>
                    <div id="slide-1" class="slide-body">
                        <h3>Профессиональные компетенции</h3>
                        <ul>
                            <li>
                                <span class="title">ПК 1.1.</span>
                                Выполнять тестирование программных модулей.
                            </li>
                            <li>
                                <span class="title">ПК 1.2.</span>
                                Осуществлять оптимизацию программного кода модуля.
                            </li>
                            <li>
                                <span class="title">ПК 1.3.</span>
                                Выполнять разработку спецификаций отдельных компонент.
                            </li>
                            <span id="show-1" class="show">
                                Показать еще
                            </span>
                            <span id="more-1" class="more hide">
                                <li>
                                    <span class="title">ПК 1.4.</span>
                                    Выполнять отладку программных модулей с использованием специализированных
                                    программных средств.
                                </li>
                                <li>
                                    <span class="title">ПК 1.5.</span>
                                    Осуществлять разработку кода программного продукта на основе готовых
                                    спецификаций на уровне модуля.
                                </li>
                                <li>
                                    <span class="title">ПК 1.6.</span>
                                    Разрабатывать компоненты проектной и технической документации с
                                    использованием графических языков спецификаций.
                                </li>
                            </span>
                        </ul>
                    </div>
                </div>
                <div class="slide hide fade">
                    <header>
                        <span class="server icon-lg"></span>
                        <h2>
                            ПМ.02 Разработка и администрирование баз данных.
                        </h2>
                    </header>
                    <div class="slide-body">
                        <h3>Профессиональные компетенции</h3>
                        <ul>
                            <li>
                                <span class="title">ПК 2.1.</span>
                                Разрабатывать объекты базы данных.
                            </li>
                            <li>
                                <span class="title">ПК 2.2.</span>
                                Решать вопросы администрирования базы данных.
                            </li>
                            <li>
                                <span class="title">ПК 2.3.</span>
                                Реализовывать методы и технологии защиты информации в базах данных.
                            </li>
                            <span class="show">Показать еще</span>
                            <span class="more hide">
                                <li>
                                    <span class="title">ПК 2.4.</span>
                                    Реализовывать базу данных в конкретной системе управления базами данных.
                                </li>
                            </span>
                        </ul>
                    </div>
                </div>
                <div class="slide hide fade">
                    <header>
                        <span class="inbox icon-lg"></span>
                        <h2>
                            ПМ.03 Участие в интеграции программных модулей.
                        </h2>
                    </header>
                    <div id="slide-2" class="slide-body">
                        <h3>Профессиональные компетенции</h3>
                        <ul>
                            <li>
                                <span class="title">ПК 3.1.</span>
                                Разрабатывать технологическую документацию.
                            </li>
                            <li>
                                <span class="title">ПК 3.2.</span>
                                Выполнять интеграцию модулей в программную систему.
                            </li>
                            <li>
                                <span class="title">ПК 3.3.</span>
                                Осуществлять разработку тестовых наборов и тестовых сценариев.
                            </li>
                            <span id="show-2" class="show">Показать еще</span>
                            <span id="more-2" class="more hide">
                                <li>
                                    <span class="title">ПК 3.4.</span>
                                    Выполнять отладку программного продукта с использованием специализированных
                                    программных средств.
                                </li>
                                <li>
                                    <span class="title">ПК 3.5.</span>
                                    Производить инспектирование компонент программного продукта на предмет
                                    соответствия стандартам кодирования.
                                </li>
                                <li>
                                    <span class="title">ПК 3.6.</span>
                                    Анализировать проектную и техническую документацию на уровне взаимодействия
                                    компонент программного обеспечения.
                                </li>
                            </span>
                        </ul>
                    </div>
                </div>
                <div class="slide hide fade">
                    <header>
                        <span class="settings icon-lg"></span>
                        <h2>
                            ПМ.04 Выполнение работ по одной или нескольким профессиям рабочих, должностям служащих.
                        </h2>
                    </header>
                    <div class="slide-body">
                        <h3>Профессиональные компетенции</h3>
                        <ul>
                            <li>
                                <span class="title">ПК 4.1.</span>
                                Устанавливать и обслуживать программное обеспечение.
                            </li>
                            <li>
                                <span class="title">ПК 4.2.</span>
                                Обслуживать аппаратное обеспечение персонального компьютера.
                            </li>
                            <li>
                                <span class="title">ПК 4.3.</span>
                                Осуществлять навигацию по ресурсам, поиск, ввод и передачу данных с помощью технологий и сервисов Интернета.
                            </li>
                            <span class="show">Показать еще</span>
                            <span class="more hide">
                                <li>
                                    <span class="title">ПК 4.4.</span>
                                    Создавать и управлять на персональном компьютере текстовыми документами, таблицами, презентациями и публикациями.
                                </li>
                            </span>
                        </ul>
                    </div>
                </div>
                <div class="slide hide fade">
                    <header>
                        <span class="interface icon-lg"></span>
                        <h2>
                            ПМ.05 Разработка графических и пользовательских интерфейсов.
                        </h2>
                    </header>
                    <div id="slide-2" class="slide-body">
                        <h3>Профессиональные компетенции</h3>
                        <ul>
                            <li>
                                <span class="title">ПК 5.1.</span>
                                Производить тестирование и оптимизацию разработанного веб-приложения.
                            </li>
                            <li>
                                <span class="title">ПК 5.2.</span>
                                Размещать веб приложения в сети в соответствии с техническим заданием.
                            </li>
                            <li>
                                <span class="title">ПК 5.3.</span>
                                Разрабатывать техническое задание на веб-приложение в соответствии с требованиями заказчика.
                            </li>
                            <span id="show-2" class="show">Показать еще</span>
                            <span id="more-2" class="more hide">
                                <li>
                                    <span class="title">ПК 5.4.</span>
                                    Разрабатывать интерфейс пользователя и веб-приложение в соответствии с техническим заданием.
                                </li>
                                <li>
                                    <span class="title">ПК 5.5.</span>
                                    Разрабатывать дизайн-концепции веб-приложений в соответствии с корпоративным стилем заказчика.
                                </li>
                                <li>
                                    <span class="title">ПК 5.6.</span>
                                    Осуществлять разработку дизайна веб-приложения с учетом современных тенденций в области веб-разработки.
                                </li>
                                <li>
                                    <span class="title">ПК 5.7.</span>
                                    Формировать требования к дизайну веб-приложений на основе анализа предметной области и целевой аудитории.
                                </li>
                            </span>
                        </ul>
                    </div>
                </div>
                <a class="prev" onclick="eduSlider.prevSlide()">&#10094;</a>
                <a class="next" onclick="eduSlider.nextSlide()">&#10095;</a>
            </div>
            <div class="dots edu">
                <span class="dot active" onclick="eduSlider.showSlide(0)"></span>
                <span class="dot" onclick="eduSlider.showSlide(1)"></span>
                <span class="dot" onclick="eduSlider.showSlide(2)"></span>
                <span class="dot" onclick="eduSlider.showSlide(3)"></span>
                <span class="dot" onclick="eduSlider.showSlide(4)"></span>
            </div>
            <table>
                <caption>Таблица успеваемости</caption>
                <tr class="header-row">
                    <th>Индекс</th>
                    <th>Наименование</th>
                    <th>Учебная нагрузка</th>
                    <th class="hide-sm">Курс</th>
                    <th class="hide-sm">Симестр</th>
                    <th>Оценка</th>
                </tr>
                <?php foreach (sections($driver) as $section) : ?>
                    <tr class="header-row">
                        <th><?php echo $section['section_index'] ?></th>
                        <th><?php echo $section['section'] ?></th>
                        <th><?php echo $section['hs'] ?></th>
                        <th class="hide-sm"></th>
                        <th class="hide-sm"></th>
                        <th></th>
                    </tr>
                    <?php foreach (ratingData($driver, $section['number']) as $row) : ?>
                        <tr>
                            <td><?php echo "$row[index].$row[index_number]" ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['hours'] ?></td>
                            <td class="hide-sm"><?php echo $row['course'] ?></td>
                            <td class="hide-sm"><?php echo $row['part'] ?></td>
                            <td class="hide-md"><?php echo $row['full_name'] ?></td>
                            <td class="only-md"><?php echo $row['short_name'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </table>
        </section>
        <hr>

        <a class="anchor" id="projects"></a>
        <section class="projects">
            <header>
                <h1>Проекты</h1>
            </header>
            <div class="content">
                <a href="#" class="project" target="_blank">
                    <div class="project-image">
                        <span class="project1"></span>
                    </div>
                    <div class="project-body">
                        <header>
                            <h2>
                                Web-приложение по доставке еды 2Bro`s
                            </h2>
                        </header>
                        <article>
                            Современное web-приложение для компании 2Bro`s по доставке еды.
                            Разработано на ASP.NET Core 3.0 с использованием
                            Entity Framework Core для PostgreSQL и MediatR.
                            Проект находится на финальной стадии разработки и будет опубликован в ближайшее время.
                        </article>
                    </div>
                </a>
                <a href="https://chamber-chat.herokuapp.com" class="project" target="_blank">
                    <div class="project-image">
                        <span class="project2"></span>
                    </div>
                    <div class="project-body">
                        <header>
                            <h2>
                                Пользовательский чат в реальном времени.
                            </h2>
                        </header>
                        <article>
                            Этот проект является экземпляром чата, который обновляет историю
                            сообщений в реальном времени. Приложение написано на Elixir / Phoenix
                            с использованием каналов.
                        </article>
                    </div>
                </a>
            </div>
        </section>
        <hr>

        <a class="anchor" id="contacts"></a>
        <section class="contacts">
            <header>
                <h1>Обратная связь</h1>
            </header>
            <section>
                <div class="content">
                    <p>
                        Если у вас возникли какие либо вопросы,
                        или вы решили сотрудничать со мной, то можете
                        воспользоваться формой обратной связи или через соц-сети.
                    </p>
                    <form method="POST" action="./php/send.php">
                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Ваше имя" required>
                            <input class="form-control" type="email" name="email" placeholder="Электронная почта" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="theme" placeholder="Тема сообщения" required>
                        </div>
                        <textarea class="form-control" name="message" cols="30" rows="10" placeholder="Сообщение" required></textarea>
                        <div class="g-recaptcha" data-sitekey="6LePSuAUAAAAAHY-sa1lXwiQMyDGMAFjdbzzhHsN"></div>
                        <br />
                        <input class="btn" type="submit" value="Отправить">
                    </form>
                </div>
                <div class="social">
                    <a href="https://t.me/Batya_Dulyanich" target="_blank">
                        <span class="tg-b-bl icon"></span>
                        <p>@Batya_Dulyanich</p>
                    </a>
                    <a href="https://vk.com/dim.dulckin" target="_blank">
                        <span class="vk-b-p icon"></span>
                        <p>@dim.dulckin</p>
                    </a>
                    <a href="mailto:dulckin.dim@yandex.ru">
                        <span class="mail-b-bl icon"></span>
                        <p>dulckin.dim@yandex.ru</p>
                    </a>
                </div>
                </div>
            </section>
        </section>
        <hr>
    </main>
    <footer class="container">
        <p>Dmitriy Dulkin</p>
        <p>Все права защищены</p>
        <div class="social">
            <a href="https://vk.com/dim.dulckin" target="_blank">
                <span class="vk-b-bl icon"></span>
            </a>
            <a href="https://t.me/Batya_Dulyanich" target="_blank">
                <span class="tg-b-bl icon"></span>
            </a>
        </div>
    </footer>
</body>
<script src="ts/index.js"></script>

</html>