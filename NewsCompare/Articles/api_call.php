<?php
session_start();

//Script receives a GET request from HTML form

//$rng used to fetch random articles from JSON request, lower than pageSize (20)
$rng = rand(0, 15);
$url = "";

function generateAPI($genre, $count, $newsList) {
  $url = "https://newsapi.org/v2/everything?q=$genre&apiKey=3a05a8f4d1854aef9dc1ad381c436a7d&sources=$newsList[$count]&pageSize=20&language=en&sortBy=relevancy";
  return file_get_contents($url);
}
//Escapes all special characters - HIGHLY NECESSARY
function esc($string)
{
    return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$string), "\0..\37'\\")));
}

//genre needs to be from options.php
$genre = $_GET['genre'];

//Five genres
$genreList = array(0 => 'politics', 1 => 'technology', 2 => 'finance', 3 => 'crime', 4 => 'opinion');
//Only query five news outlets
$newsList = array(0 => 'fox-news', 1 => 'time', 2 => 'cbs-news', 3 => 'the-washington-post', 4 => 'the-new-york-times');
//Store our results here
$stored_articles = array();

$_SESSION['usergenre'] = $genreList[$genre];

//Count corresponds to form action select values
for ($count = 0; $count < 5; $count++) {
  //Result contains entirety of response
  $result  = generateAPI($genreList[$genre], $count, $newsList);
  //Creates an associative array stored in $json
  $json = json_decode($result, true);
  //Pick a random article from the articles results
  $data = $json['articles'][$rng];

  //As the content is the most important aspect, cannot be null - pulls a new article. 
  $backup = 1;
  while ($data['content'] == null || strlen($data['content']) < 50) {
    $data = $json['articles'][$backup];
    $backup += 1;
    if ($backup == 20) {
      $backup = 1;
    }
  }

  //Get details of JSON response
  $author = $data['author'];
  $title = $data['title'];
  $content = $data['content'];
  $url = $data['url'];

  //These values may be null due to news source or API limitations
  if ($author == null) {
    $author = "Not available";
  }
  if ($title == null) {
    $title = "Not available.";
  }

  $stored_articles[$count]['author'] = esc($author);
  $stored_articles[$count]['title'] = esc($title);
  $stored_articles[$count]['content'] = esc($content);
  $stored_articles[$count]['newsoutlet'] = strtoupper(($newsList[$count]));
  $stored_articles[$count]['url'] = esc($url);
}

$_SESSION['loaded_articles'] = $stored_articles;

//print_r($_SESSION['loaded_articles']);

 header("location: genrepick.php");
?>
