<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EvotorExchange</title>
    <meta name="description" content="EvotorExchange">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="alert">
    </div>

    <header class="header">
        <div class="container">
            <div class="wrapper header__wrapper">
                <nav class="nav header__nav">
                    <button name="page" value="change" class="btn btn_purple tab_btn">Обмен через файл</button>
                    <button name="page" value="management" class="btn btn_purple tab_btn">Управление товарами</button>
                    <button name="page" value="documents" class="btn btn_purple tab_btn">Документы</button>
                    <button name="page" value="support" class="btn btn_purple tab_btn">Тех.Поддержка</button>
                </nav>
            </div>
        </div>
    </header>

    <nav class="nav store">
        <div class="container">
            <label><span>Магазин</span>
                <select id="store" name="currentStore" size="1">
                    <?php foreach ($user->stores as $key => $store) : ?>
                        <option value="<?= $key ?>" <?= ($key == $user->currentStore) ? 'selected' : null ?>>
                            <?= "{$store['name']}, {$store['address']}" ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
    </nav>

    <main class="main">
        <div class="container">
            <div class="wrapper main__wrapper">

                <div id="intro" class="main__intro tab_content tab_content_active">
                    <h2>Внимание!!!</h2>
                    <p>Приложение не является товароучетной системой!</p>
                    <p>Чтобы исключить некорректные остатки по товарным позициям</p>
                    <p>перед началом работы выгрузите данные со смарт-терминала в облако Эвотор</p>
                    <p>...Ещё == Обмен == Выгрузить</p>
                    <p>Чтобы в кассе были правильные остатки:</p>
                    <p>1. На терминале выгрузите данные.</p>
                    <p>2. На компьютере загрузите остатки в систему товароучета, проведите документ продажи, затем отправьте обновленные данные обратно в Эвотор.</p>
                    <p>3. На терминале загрузите данные.</p>
                </div> <!-- #intro -->

                <div id="change" class="main__change tab_content">
                    <h2>Обмен через файл</h2>
                    <div class="main__change_wrapper">

                        <section>
                            <h3>Отправить в облако Эвотор</h3>
                            <form enctype="multipart/form-data">
                                <label title="Поле 'uuid' товара должно быть пустым">
                                    <input name="operation" value="add" type="radio" checked>Добавить товары</label><br>
                                <label title="Поле 'uuid' товара должно быть заполнено">
                                    <input name="operation" value="update" type="radio">Обновить товары</label><br>
                                <label title="Поле 'uuid' товара должно быть заполнено">
                                    <input name="operation" value="delete" type="radio">Удалить товары</label><br>
                                <!-- <input name="MAX_FILE_SIZE" value="500000" type="hidden"> -->
                                <label><input name="file" type="file" accept=".xlsx,.xls,.csv"></label><br>
                                <input name="request" value="productsUpload" type="hidden">
                                <button name="form" class="btn btn_purple">Отправить в облако Эвотор</button><br>
                            </form>
                            <!--
                        <button class="btn btn_purple" name="tpl" value="xlsx">Образец.XLSX</button>
                        <button class="btn btn_purple" name="tpl" value="csv">Образец.CSV</button>
                        -->
                        </section>

                        <section>
                            <h3>Загрузить из облака Эвотор</h3>
                            <form name="productsDownload" enctype="multipart/form-data" title="Выберите формат документа">
                                <label><input name="format" value="xlsx" type="radio" checked>.XLSX</label>
                                <label><input name="format" value="xls" type="radio">.XLS</label>
                                <label><input name="format" value="csv" type="radio">.CSV</label><br>
                                <input type="hidden" name="request" value="productsDownload">
                                <button name="form" class="btn btn_purple">Загрузить Товары из облака Эвотор</button>
                            </form>
                        </section>

                    </div> <!-- main__change_wrapper -->
                </div> <!-- #change -->

                <div id="management" class="main tab_content">
                    <h2>Упраление товарами</h2>
                    <button name="mgmt" value="newGrop" class="btn btn_purple">Новая группа</button>
                    <button name="mgmt" value="newProd" class="btn btn_purple">Новый товар</button>
                    <button name="mgmt" value="newServ" class="btn btn_purple">Новая услуга</button>
                    <button name="mgmt" value="toFile" class="btn btn_purple">Выгрузить в файл</button>
                    <button name="mgmt" value="delAll" class="btn btn_red">Удалить все товары</button>
                    <button name="mgmt" value="upload" class="btn btn_purple">Отправить в облако Эвотор</button>
                    <button name="mgmt" value="download" class="btn btn_purple">Загрузить из облака Эвотор</button>

                    <div id="dir"></div>
                    <div id="product"></div>
                </div> <!-- #management -->

                <div id="documents" class="main tab_content">
                    <h2>Документы</h2>
                    <form name="documentsDownload" enctype="multipart/form-data" title="Выберите документы">
                        <label><span>Касса</span>
                            <select id="device" name="deviceUuid">
                                <?php foreach ($user->devices as $key => $device) : ?>
                                    <option value="<?= $device['uuid'] ?>"><?= $device['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <br>
                        <label>
                            <input id="yesterday" type="radio" name="fixedRange" value="yesterday">Вчера
                        </label>
                        <label>
                            <input id="today" type="radio" name="fixedRange" value="today">Сегодня
                        </label>
                        <label>
                            <input id="sevenDays" type="radio" name="fixedRange" value="sevenDays">7 дней
                        </label>
                        <label>
                            <input id="week" type="radio" name="fixedRange" value="week">Неделя
                        </label>
                        <label>
                            <input id="month" type="radio" name="fixedRange" value="month">31 день
                        </label>
                        <br>
                        <label>Начало периода
                            <input id="gtCloseDate" type="date" value="" min="" max="">
                        </label>
                        <label>Конец периода
                            <input id="ltCloseDate" type="date" value="" min="" max="">
                        </label>
                        <br>
                        <!-- <span>Кассовые документы:</span> -->
                        <br>
                        <label><input name="types[]" value="SELL" type="checkbox">Продажа</label>
                        <br>
                        <label><input name="types[]" value="CASH_INCOME" type="checkbox">Внесение наличных</label>
                        <br>
                        <label><input name="types[]" value="CASH_OUTCOME" type="checkbox">Изъятие наличных</label>
                        <br>
                        <label><input name="types[]" value="PAYBACK" type="checkbox">Возврат денег</label>
                        <br>
                        <label><input name="types[]" value="OPEN_SESSION" type="checkbox">Открытие смены смарт-терминала</label>
                        <br>
                        <label><input name="types[]" value="CLOSE_SESSION" type="checkbox">Закрытие смены смарт-терминала</label>
                        <br>
                        <label><input name="types[]" value="FPRINT" type="checkbox">FPRINT</label>
                        <br>
                        <label><input name="types[]" value="X_REPORT" type="checkbox">Печать X-отчёта</label>
                        <br>
                        <label><input name="types[]" value="Z_REPORT" type="checkbox">Печать Z-отчёта</label>
                        <br>
                        <label><input name="types[]" value="ACCEPT" type="checkbox">Приемка товара</label>
                        <br>
                        <label><input name="types[]" value="INVENTORY" type="checkbox">Инвентаризация</label>
                        <br>
                        <label><input name="types[]" value="RETURN" type="checkbox">Возврат товара поставщику</label>
                        <br>
                        <label><input name="types[]" value="WRITE_OFF" type="checkbox">Списание товара</label>
                        <br>
                        <label><input name="types[]" value="REVALUATION" type="checkbox">Переоценка товара</label>
                        <br>
                        <label><input name="types[]" value="OPEN_TARE" type="checkbox">Вскрытие тары алкогольной продукции</label>
                        <br>
                        <label><input name="types[]" value="BUY" type="checkbox">Выкуп товара у клиента с увеличением остатка</label>
                        <br>
                        <label><input name="types[]" value="BUYBACK" type="checkbox">Выкуп товара клиентом, с уменьшением остатка</label>
                        <br>
                        <!--
                    <label><input name="doc" value="period" type="radio" checked>За период</label>
                    <label><input name="doc" value="z" type="radio">По Z-отчетам</label>
                    <label><input name="doc" value="smena" type="radio">По закрытию смен</label>-->
                        <br>
                        <input name="request" value="documentsDownload" type="hidden">
                        <button name="form" class="btn btn_purple">Загрузить Документы из облака Эвотор</button>
                    </form>
                    <button id="testButton" name="testButton" class="btn btn_purple">TestButton</button>
                </div> <!-- #documents -->

                <div id="support" class="main tab_content">
                    <p>Поддержка</p>
                    <p>Поддержка</p>
                    <p>Поддержка</p>
                    <p>Поддержка</p>
                    <p>Поддержка</p>
                    <p>Поддержка</p>
                </div> <!-- #support -->
            </div> <!-- main__wrapper -->
        </div> <!-- container -->
    </main>

    <footer>
        <div id="divFrame" class="divFrame"></div>
        <iframe id="iframe" class="iframe" name="iframe" src="about:blank" frameborder="0"></iframe>
    </footer>

    <script>
        const User = <?= json_encode($user) ?>;
    </script>

    <script src="script.js"></script>

</body>

</html>
