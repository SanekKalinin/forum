<?php
function showCategories(){
    include('dbconn.php');
    $query = "SELECT * FROM categories";
    $result=mysqli_query($connection,$query) or die("Ошибка " . mysqli_error($connection));
          
   while($category=mysqli_fetch_assoc($result)){  // создает массив массивов, как сделать 1 массив?
         echo '<ul><a href=#>'.$category['categTitle'].'</a></ul>';
        showSubCategories($category['categ_id']);
         }   
        mysqli_free_result($result); 
        }
        
function showSubCategories($parent_id) {
        include('dbconn.php');
    $query="SELECT * FROM categories as c,subcategories as s WHERE ($parent_id=c.categ_id) AND ($parent_id=s.categ_id)";
    $result=mysqli_query($connection,$query) or die("Ошибка " . mysqli_error($connection));
    while($subcategory=mysqli_fetch_assoc($result)){  
 echo '<li><a href=topics.php?categ_id='.$subcategory['categ_id'].'&subcat_id='.$subcategory['subcat_id'].
 '>'.$subcategory['subcategTitle'].' ('.topicsQuantity ($parent_id,$subcategory['subcat_id']).')</a></li>';
         }   
       mysqli_free_result($result); 
        }
 
function topicsQuantity ($categ_id,$subcateg_id){
    include('dbconn.php');
    $query="SELECT categ_id,subcat_id FROM topics WHERE ($categ_id=categ_id) AND ($subcateg_id=subcat_id)";
    $result=mysqli_query($connection,$query) or die("Ошибка " . mysqli_error($connection));
return mysqli_num_rows($result);
}    

function showTopics($categ_id,$subcateg_id){
    include('dbconn.php');
    $query="SELECT topic_id, author, title,date_posted, views,replies FROM 
    categories as c,subcategories as s,topics as t
    WHERE ($categ_id=t.categ_id) AND ($subcateg_id=t.subcat_id) AND ($categ_id=c.categ_id) AND ($subcateg_id=s.subcat_id)";
    $result=mysqli_query($connection,$query) or die("Ошибка " . mysqli_error($connection));
    if (mysqli_num_rows($result)!=0) {
    while($topic=mysqli_fetch_assoc($result)){  
          echo '<li><a href=readtopic.php?categ_id='.$categ_id.'&subcat_id='.$subcateg_id
          .'&topic_id='.$topic['topic_id'].'&author='.$topic['author']
          .'&date_posted='.$topic['date_posted'].'&views='.$topic['views']
          .'&replies='.$topic['replies'].'>'
          .$topic['title'].' Создана '.$topic['author'].' '.$topic['date_posted'].' Просмотров '.$topic['views']
          .' Ответов '.$topic['replies'].'</a></li>';
                }  
            } else {
                echo '<p>В этой категории еще нет записей </p><a href=newtopic.php?categ_id='.$categ_id
                .'&subcat_id='.$subcateg_id.'>Создать первую запись</a>';
            }
}
function showTopic ($categ_id,$subcat_id,$topic_id) {
     include('dbconn.php');
    $query="SELECT topic_id,author,title,content,date_posted
     FROM categories as c,subcategories as s,topics as t
     WHERE (c.categ_id=$categ_id) AND (s.subcat_id=$subcat_id) AND (t.topic_id=$topic_id)";
     $result=mysqli_query($connection,$query) or die("Ошибка " . mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    echo nl2br('<div class="content"><h2 class="title">'.$row['title'].'</h2><p>'.$row['author'].
    ' '.$row['date_posted'].'</div>');
    echo '<div class="content"> <p>'.$row['content'].'</p></div>';
    
}

function refreshView($categ_id,$subcat_id,$topic_id){
    include('dbconn.php');
    $query="UPDATE topics SET views=views+1 
    WHERE categ_id=$categ_id AND subcat_id=$subcat_id AND topic_id=$topic_id";
    $result=mysqli_query($connection,$query) or die("Ошибка " . mysqli_error($connection));
}

function replyLink ($categ_id,$subcat_id,$topic_id) {
echo '<p><a href=reply.php?categ_id='.$categ_id.'&subcat_id='.$subcat_id.'&topic_id='.$topic_id.'>Ответить</a></p>';
}
     
 function reply($categ_id,$subcat_id,$topic_id){
echo '<div class="content">
<form action=addreply.php?categ_id='.$categ_id.'&subcat_id='.$subcat_id.'&topic_id='.$topic_id.' method=POST>
<p>Комментарий: </p>
<textarea id="comment" name="comment"> </textarea>
<input type="submit" value="Добавить">
</form>
</div>';
 }   

function showReplies($categ_id,$subcat_id,$topic_id){
    include('dbconn.php');
    $query="SELECT r.author,comment,r.date_posted
     FROM categories as c,subcategories as s,replies as r, topics as t
     WHERE (r.categ_id=$categ_id) AND (r.subcat_id=$subcat_id) AND (r.topic_id=$topic_id)
     AND (c.categ_id=$categ_id) AND (s.subcat_id=$subcat_id) AND (t.topic_id=$topic_id) ORDER BY reply_id DESC";
     $result=mysqli_query($connection,$query) or die("Ошибка " . mysqli_error($connection));

    if (mysqli_num_rows($result) !=0) {
        echo '<div class="content">';
        while ($row=mysqli_fetch_assoc($result)) {
            echo nl2br($row['author'].' '.$row['date_posted'].' '.$row['comment']);
        }
}
}

function allReplies($categ_id,$subcat_id,$topic_id){
    include('dbconn.php');
    $query="SELECT categ_id, subcat_id,topic_id
     FROM replies
     WHERE (categ_id=$categ_id) AND (subcat_id=$subcat_id) AND (topic_id=$topic_id)";
     $result=mysqli_query($connection,$query) or die("Ошибка " . mysqli_error($connection)); 
     return mysqli_num_rows($result);
}

?>