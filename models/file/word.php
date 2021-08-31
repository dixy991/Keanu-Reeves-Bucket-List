<?php
    if(isset($_POST["dugmeWord"])){
        // $word_file = new COM("word.application") or die("Cannot create Word object");
        // $word_file -> Visible = true;
        // $word_file -> Documents -> Add();
        // $word_file -> Selection -> TypeText("Hi! It's me again... \n");
        // $word_file -> Selection -> TypeText("Hi! My name is...Hi! My name is...*chicka,chicka* Dixy Lazic \n");
        // $word_file -> Selection -> TypeText("My index numero:19/18");
        // $word_file -> Documents[1] -> SaveAs("me.docx");
        // $word_file -> Quit();
        // $word_file = null;
        // header("Location: ../../index.php");

        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=autor.doc");
        echo "<html>";
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows1252\">";
        echo "<body>";
        echo "<b>The author</b>";
        echo "<p>Well hello! Didn't see you there...Wanna know something about me, huh? Why? Are you working for the police? If not, nice to meet you, my name is Dijana, I'm 20 years old and I live in a house. In Belgrade.</p>";
        echo "<p>After successfully finishing both kindergarten and elementary school, I decided to continue my education at the Philological High School because I really liked learning about languages. I was so good that I managed to master six of them ( English, French, Latin, Serbian, Bosnian and Montenegrin), but I realized I needed a new challenge...I always wanted to talk to the machines and the best way to do that is by learning computer languages. I will be able to speak to my laptop, right?</p>";
        echo "</body>";
        echo "</html>";
       
    }
    else{
        header("Location: ../../index.php?page=author");
    }
?>