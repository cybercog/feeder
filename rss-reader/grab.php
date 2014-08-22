<?php

    // Трансляция новостей с 3DNews.ru
    // http://www.3dnews.ru/news/rss/
    class Grab
    {
        private $showCount = 3;
    
        public function __construct()
        {
            // Имя файла для хранения RSS на локальном сервере
            $filename = 'rss/3dnews.xml';
            // URL RSS потока
            $rss_url = 'http://www.3dnews.ru/news/rss/';
            
            // Закачка файлов XML
            // Произвести проверку на то, что файл уже закачен
            if (!file_exists($filename)) {
                // Закачать и сохранить
                $this->download($rss_url, $filename);
            }
            
            /*
            // Создание объекта SIMPLEXML и загрузка документа
            $xml = simplexml_load_file($filename);
            
            $i = 1;
            foreach ($xml->channel->item as $item) {
                $title = $item->title;
                $description = $item->description;
                $link = $item->link;
                // echo '<h3>' , iconv("UTF-8","windows-1251", $title) , '</h3>'; // with codepage encoding
                echo '<h3>' , iconv("UTF-8","UTF-8", $title) , '</h3>';
                echo '<p>' , iconv("UTF-8","UTF-8", $description) , ' <a href="' , $link , '">' . 'продолжение</a>...</p>';
                $i++;
                if ($i > $this->showCount) break; // Не более 5 анонсов новостей
            }
            */
            
            // Проверка на то, что если файл устарел более, чем на 12 часов - качать и сохранить новый
            if (time() > filemtime($filename) + 60*60*12) {
                print "Проверка &ldquo;свежести&rdquo; файла...</br /></br />";
                // Закачать и сохранить
                $this->download($rss_url, $filename);
            }
        }
        
        private function download($url, $filename) {
            // Закачать файл с указанного URL и сохранить с определенным именем
            $file = file_get_contents($url);
            if ($file) {
                file_put_contents($filename, $file);
                print "XML поток был загружен</br /></br />";
            }
        }
    }
?>